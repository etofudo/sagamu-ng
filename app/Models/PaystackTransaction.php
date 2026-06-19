<?php

namespace App\Models;

use App\Services\PaystackService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PaystackTransaction extends Model
{
    protected $fillable = [
        'type',
        'listing_id',
        'reference',
        'email',
        'amount_kobo',      // integer, always in kobo — never naira
        'status',
        'paid_at',
        'gateway_response',
        'paystack_data',
    ];

    protected $casts = [
        'amount_kobo'   => 'integer',   // enforce integer, never float
        'paid_at'       => 'datetime',
        'paystack_data' => 'array',
    ];

    // -----------------------------------------------------------------------
    // Relationships
    // -----------------------------------------------------------------------

    public function listing(): BelongsTo
    {
        return $this->belongsTo(Listing::class);
    }

    // -----------------------------------------------------------------------
    // Accessors
    // -----------------------------------------------------------------------

    /**
     * Human-readable amount string (e.g. "₦5,000.00").
     * Derived from kobo integer — no floating-point division used in display.
     */
    public function getAmountFormattedAttribute(): string
    {
        return PaystackService::formatKobo($this->amount_kobo);
    }

    // -----------------------------------------------------------------------
    // Scopes
    // -----------------------------------------------------------------------

    public function scopeSuccessful($query)
    {
        return $query->where('status', 'success');
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }
}
