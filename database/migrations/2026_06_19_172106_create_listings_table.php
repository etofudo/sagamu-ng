<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('listings', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->foreignId('category_id')->constrained()->restrictOnDelete();
            $table->foreignId('neighbourhood_id')->nullable()->constrained()->nullOnDelete();
            $table->text('description')->nullable();
            $table->string('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('opening_hours')->nullable();
            $table->enum('price_range', ['budget', 'mid', 'premium', 'na'])->nullable();
            $table->string('website')->nullable();
            $table->string('hero_image')->nullable();
            $table->json('gallery')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_published')->default(false);
            $table->enum('status', ['pending', 'active', 'inactive'])->default('pending');
            $table->string('contact_name')->nullable();
            $table->string('contact_email')->nullable();
            $table->timestamps();

            $table->index(['status', 'is_published']);
            $table->index(['category_id', 'is_published']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('listings');
    }
};
