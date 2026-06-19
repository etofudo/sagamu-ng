<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\PaystackTransaction;
use App\Services\PaystackService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ListingUpgradeController extends Controller
{
    // -----------------------------------------------------------------------
    // Show the "Feature this listing" page
    // -----------------------------------------------------------------------

    public function show(Listing $listing)
    {
        abort_unless($listing->is_published && $listing->status === 'active', 404);

        if ($listing->is_featured) {
            return redirect()->route('listing.show', $listing->slug)
                ->with('info', 'This listing is already featured.');
        }

        $priceKobo = config('services.paystack.featured_price_kobo');

        return view('pages.listing.upgrade', [
            'listing'          => $listing,
            'priceKobo'        => $priceKobo,
            'priceFormatted'   => PaystackService::formatKobo($priceKobo),
            'paystackPublicKey' => config('services.paystack.public'),
        ]);
    }

    // -----------------------------------------------------------------------
    // Initiate payment → redirect to Paystack
    // -----------------------------------------------------------------------

    public function initiate(Request $request, Listing $listing, PaystackService $paystack)
    {
        abort_unless($listing->is_published && $listing->status === 'active', 404);

        if ($listing->is_featured) {
            return redirect()->route('listing.show', $listing->slug);
        }

        $validated = $request->validate([
            'email' => ['required', 'email', 'max:200'],
        ]);

        $priceKobo = config('services.paystack.featured_price_kobo');
        $reference = $paystack->generateReference('FEAT');

        // Create pending transaction BEFORE calling Paystack
        // (so we have a record even if the redirect never returns)
        PaystackTransaction::create([
            'type'        => 'featured_listing',
            'listing_id'  => $listing->id,
            'reference'   => $reference,
            'email'       => $validated['email'],
            'amount_kobo' => $priceKobo,   // integer kobo — no floats
            'status'      => 'pending',
        ]);

        try {
            $authUrl = $paystack->initializeTransaction(
                amountKobo:  $priceKobo,
                email:       $validated['email'],
                reference:   $reference,
                metadata:    [
                    'listing_id'   => $listing->id,
                    'listing_name' => $listing->name,
                    'listing_slug' => $listing->slug,
                    'type'         => 'featured_listing',
                ],
                callbackUrl: route('listing.upgrade.callback', $listing->slug),
            );
        } catch (\Exception $e) {
            Log::error('Paystack init failed', [
                'reference' => $reference,
                'error'     => $e->getMessage(),
            ]);

            // Mark the pending record as failed so admin can see it
            PaystackTransaction::where('reference', $reference)
                ->update(['status' => 'failed']);

            return back()->withErrors([
                'email' => 'Payment provider unavailable. Please try again in a moment.',
            ]);
        }

        return redirect()->away($authUrl);
    }

    // -----------------------------------------------------------------------
    // Callback from Paystack after payment
    // -----------------------------------------------------------------------

    public function callback(Request $request, Listing $listing, PaystackService $paystack)
    {
        $reference = $request->query('reference');

        if (! $reference) {
            return redirect()->route('listing.upgrade', $listing->slug)
                ->withErrors(['email' => 'Payment reference missing. Please try again.']);
        }

        $txn = PaystackTransaction::where('reference', $reference)
            ->where('listing_id', $listing->id)
            ->where('type', 'featured_listing')
            ->firstOrFail();

        // Idempotency — if we already processed this, just return the result page
        if ($txn->status === 'success') {
            return view('pages.listing.upgrade-success', compact('listing', 'txn'));
        }

        if ($txn->status === 'failed') {
            return view('pages.listing.upgrade-failed', compact('listing', 'txn'));
        }

        // Verify with Paystack
        try {
            $data = $paystack->verifyTransaction($reference);
        } catch (\Exception $e) {
            Log::error('Paystack verify failed', [
                'reference' => $reference,
                'error'     => $e->getMessage(),
            ]);

            return view('pages.listing.upgrade-failed', compact('listing', 'txn'));
        }

        // Process atomically — listing update and transaction update together
        DB::transaction(function () use ($txn, $listing, $data) {
            $paystackSaysSuccess = ($data['status'] ?? '') === 'success';

            /*
             * CRITICAL AMOUNT CHECK — integer kobo comparison only.
             *
             * Paystack returns amount in kobo. We compare it to what we stored
             * in our DB (also kobo). Both are cast to int — no float involved.
             * This prevents someone paying ₦1 to feature a ₦5,000 listing.
             */
            $amountVerified = ((int) ($data['amount'] ?? 0)) === ((int) $txn->amount_kobo);

            $success = $paystackSaysSuccess && $amountVerified;

            $txn->update([
                'status'           => $success ? 'success' : 'failed',
                'paid_at'          => $success ? now() : null,
                'gateway_response' => $data['gateway_response'] ?? null,
                'paystack_data'    => $data,   // full payload stored for audit
            ]);

            if ($success) {
                $listing->update(['is_featured' => true]);

                Log::info('Listing featured via payment', [
                    'listing_id' => $listing->id,
                    'reference'  => $txn->reference,
                    'amount_kobo'=> $txn->amount_kobo,
                ]);
            } else {
                Log::warning('Payment verification mismatch', [
                    'reference'      => $txn->reference,
                    'paystack_status'=> $data['status'] ?? 'unknown',
                    'expected_kobo'  => $txn->amount_kobo,
                    'received_kobo'  => (int) ($data['amount'] ?? 0),
                ]);
            }
        });

        $txn->refresh();

        if ($txn->status === 'success') {
            return view('pages.listing.upgrade-success', compact('listing', 'txn'));
        }

        return view('pages.listing.upgrade-failed', compact('listing', 'txn'));
    }
}
