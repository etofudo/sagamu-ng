<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use RuntimeException;

/**
 * Thin wrapper around the Paystack REST API.
 *
 * MONEY RULE: Every amount that crosses this class boundary is in KOBO
 * (the smallest Nigerian currency unit: 100 kobo = ₦1).
 * We never store, pass, or return naira floats. This eliminates all
 * floating-point rounding issues (0.1 + 0.1 ≠ 0.2 in IEEE 754).
 *
 * Examples:
 *   ₦5,000  →  500_000 kobo  (int)
 *   ₦500    →   50_000 kobo  (int)
 *   ₦1      →      100 kobo  (int)
 */
class PaystackService
{
    private const BASE = 'https://api.paystack.co';

    // -------------------------------------------------------------------------
    // Transaction — initialize
    // -------------------------------------------------------------------------

    /**
     * Initialize a Paystack transaction and return the authorization URL
     * the user should be redirected to.
     *
     * @param  int    $amountKobo   Amount in kobo (integer). e.g. 500000 = ₦5,000
     * @param  string $email        Payer email
     * @param  string $reference    Unique reference string (max 100 chars)
     * @param  array  $metadata     Arbitrary key-value pairs (displayed in dashboard)
     * @param  string $callbackUrl  Where Paystack redirects the user after payment
     * @return string               The Paystack-hosted payment page URL
     *
     * @throws RuntimeException if Paystack API returns an error
     */
    public function initializeTransaction(
        int    $amountKobo,
        string $email,
        string $reference,
        array  $metadata    = [],
        string $callbackUrl = '',
    ): string {
        $response = Http::withToken($this->secret())
            ->post(self::BASE . '/transaction/initialize', [
                'amount'       => $amountKobo,   // Paystack expects kobo for NGN
                'email'        => $email,
                'reference'    => $reference,
                'callback_url' => $callbackUrl,
                'metadata'     => array_merge($metadata, ['source' => 'sagamu.ng']),
                'currency'     => 'NGN',
            ]);

        if (! $response->successful() || ! $response->json('status')) {
            throw new RuntimeException(
                'Paystack initialize failed: ' . $response->json('message', 'Unknown error')
            );
        }

        return $response->json('data.authorization_url');
    }

    // -------------------------------------------------------------------------
    // Transaction — verify
    // -------------------------------------------------------------------------

    /**
     * Verify a transaction by reference after the user returns from Paystack.
     *
     * Returns Paystack's raw data array. Always check ['status'] === 'success'
     * AND ['amount'] === your expected amount (in kobo) before fulfilling.
     *
     * @param  string $reference
     * @return array  Paystack data payload
     *
     * @throws RuntimeException if the HTTP request fails
     */
    public function verifyTransaction(string $reference): array
    {
        $response = Http::withToken($this->secret())
            ->get(self::BASE . '/transaction/verify/' . urlencode($reference));

        if (! $response->successful()) {
            throw new RuntimeException(
                'Paystack verify failed: ' . $response->json('message', 'Unknown error')
            );
        }

        return $response->json('data');
    }

    // -------------------------------------------------------------------------
    // Helpers
    // -------------------------------------------------------------------------

    /**
     * Generate a unique, URL-safe payment reference.
     *
     * Format: {PREFIX}{UNIQID}{TIMESTAMP}
     * Example: FEAT65E4A1B2C3D4E5F61748777600
     */
    public function generateReference(string $prefix = 'SAG'): string
    {
        return strtoupper($prefix) . strtoupper(uniqid()) . time();
    }

    /**
     * Convert a naira integer (whole naira, no decimals allowed in input)
     * to kobo safely using integer arithmetic only — no floating-point involved.
     *
     * @param  int $naira   Whole naira amount (e.g. 5000 for ₦5,000)
     * @return int          Kobo amount (e.g. 500000)
     */
    public static function nairaToKobo(int $naira): int
    {
        return $naira * 100;
    }

    /**
     * Format a kobo integer as a human-readable naira string.
     *
     * @param  int    $kobo   e.g. 500000
     * @return string         e.g. "₦5,000.00"
     */
    public static function formatKobo(int $kobo): string
    {
        // Integer division for naira part, modulo for kobo remainder — no floats
        $naira = intdiv($kobo, 100);
        $koboRemainder = $kobo % 100;

        return '₦' . number_format($naira) . '.' . str_pad((string) $koboRemainder, 2, '0', STR_PAD_LEFT);
    }

    private function secret(): string
    {
        return config('services.paystack.secret');
    }
}
