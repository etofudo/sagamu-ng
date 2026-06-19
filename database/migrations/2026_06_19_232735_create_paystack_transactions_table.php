<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('paystack_transactions', function (Blueprint $table) {
            $table->id();

            $table->enum('type', ['featured_listing', 'donation']);

            // Nullable so a donation row has no listing
            $table->foreignId('listing_id')
                  ->nullable()
                  ->constrained()
                  ->nullOnDelete();

            // Our reference — what we send TO Paystack and use to verify
            $table->string('reference', 100)->unique();

            $table->string('email', 200);

            /*
             * MONEY STORAGE — integer kobo, never decimal/float.
             *
             * Why unsignedBigInteger:
             *   INT unsigned max ≈ ₦42 million — fine for now
             *   BIGINT unsigned max ≈ ₦92 trillion — future-proof
             *   DECIMAL/FLOAT intentionally avoided: 0.1 + 0.1 ≠ 0.2 in IEEE 754
             *
             * 100 kobo = ₦1  |  ₦5,000 = 500,000 kobo
             */
            $table->unsignedBigInteger('amount_kobo');

            $table->enum('status', ['pending', 'success', 'failed'])->default('pending');

            // Populated from Paystack verification response
            $table->timestamp('paid_at')->nullable();
            $table->string('gateway_response', 200)->nullable();

            // Full Paystack verify payload for audit / manual reconciliation
            $table->json('paystack_data')->nullable();

            $table->timestamps();

            $table->index(['status', 'type']);
            $table->index('listing_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('paystack_transactions');
    }
};
