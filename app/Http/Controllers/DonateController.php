<?php

namespace App\Http\Controllers;

use App\Models\PaystackTransaction;
use App\Services\PaystackService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DonateController extends Controller
{
    // Donation limits in whole naira (converted to kobo using integer multiplication)
    private const MIN_NAIRA = 100;    // ₦100 minimum
    private const MAX_NAIRA = 100000; // ₦100,000 maximum

    // -----------------------------------------------------------------------
    // Donation page
    // -----------------------------------------------------------------------

    public function show()
    {
        return view('pages.donate', [
            'presets' => [500, 1000, 2500, 5000],   // naira preset buttons
            'minNaira' => self::MIN_NAIRA,
            'maxNaira' => self::MAX_NAIRA,
        ]);
    }

    // -----------------------------------------------------------------------
    // Initiate donation → redirect to Paystack
    // -----------------------------------------------------------------------

    public function initiate(Request $request, PaystackService $paystack)
    {
        $validated = $request->validate([
            /*
             * Amount validation is in WHOLE NAIRA (integer) — no decimals allowed.
             * We multiply by 100 using integer arithmetic to get kobo.
             * This completely avoids floating-point issues.
             */
            'amount' => [
                'required',
                'integer',
                'min:' . self::MIN_NAIRA,
                'max:' . self::MAX_NAIRA,
            ],
            'email' => ['required', 'email', 'max:200'],
        ]);

        // Safe: integer * integer = integer. No float division possible.
        $amountKobo = (int) $validated['amount'] * 100;

        $reference = $paystack->generateReference('DON');

        PaystackTransaction::create([
            'type'        => 'donation',
            'listing_id'  => null,
            'reference'   => $reference,
            'email'       => $validated['email'],
            'amount_kobo' => $amountKobo,
            'status'      => 'pending',
        ]);

        try {
            $authUrl = $paystack->initializeTransaction(
                amountKobo:  $amountKobo,
                email:       $validated['email'],
                reference:   $reference,
                metadata:    ['type' => 'donation'],
                callbackUrl: route('donate.callback'),
            );
        } catch (\Exception $e) {
            Log::error('Paystack donation init failed', [
                'reference' => $reference,
                'error'     => $e->getMessage(),
            ]);

            PaystackTransaction::where('reference', $reference)
                ->update(['status' => 'failed']);

            return back()->withInput()->withErrors([
                'amount' => 'Payment provider unavailable. Please try again.',
            ]);
        }

        return redirect()->away($authUrl);
    }

    // -----------------------------------------------------------------------
    // Callback from Paystack
    // -----------------------------------------------------------------------

    public function callback(Request $request, PaystackService $paystack)
    {
        $reference = $request->query('reference');

        if (! $reference) {
            return redirect()->route('donate')->withErrors(['amount' => 'No payment reference found.']);
        }

        $txn = PaystackTransaction::where('reference', $reference)
            ->where('type', 'donation')
            ->firstOrFail();

        // Idempotent
        if ($txn->status === 'success') {
            return view('pages.donate-thanks', compact('txn'));
        }

        if ($txn->status === 'failed') {
            return redirect()->route('donate')
                ->withErrors(['amount' => 'Payment was not successful. Please try again.']);
        }

        try {
            $data = $paystack->verifyTransaction($reference);
        } catch (\Exception $e) {
            Log::error('Paystack donation verify failed', ['reference' => $reference]);
            return redirect()->route('donate')
                ->withErrors(['amount' => 'Could not verify your payment. If you were charged, please contact us.']);
        }

        DB::transaction(function () use ($txn, $data) {
            $paystackSaysSuccess = ($data['status'] ?? '') === 'success';

            // Integer kobo comparison — same pattern as ListingUpgradeController
            $amountVerified = ((int) ($data['amount'] ?? 0)) === ((int) $txn->amount_kobo);

            $success = $paystackSaysSuccess && $amountVerified;

            $txn->update([
                'status'           => $success ? 'success' : 'failed',
                'paid_at'          => $success ? now() : null,
                'gateway_response' => $data['gateway_response'] ?? null,
                'paystack_data'    => $data,
            ]);
        });

        $txn->refresh();

        if ($txn->status === 'success') {
            return view('pages.donate-thanks', compact('txn'));
        }

        return redirect()->route('donate')
            ->withErrors(['amount' => 'Payment was not completed successfully. Please try again.']);
    }
}
