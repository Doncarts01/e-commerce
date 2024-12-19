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
        Schema::create('payment_settings', function (Blueprint $table) {
            $table->id();
            $table->string('paypal_id')->nullable();
            $table->string('paypal_sk')->nullable();
            $table->string('paypal_status')->default('sandbox');
            $table->string('stripe_pk')->nullable();
            $table->string('stripe_sk')->nullable();
            $table->string('paystack_pk')->nullable();
            $table->string('paystack_sk')->nullable();
            $table->string('merchant_email')->nullable();
            $table->tinyInteger('is_cash')->default(1);
            $table->tinyInteger('is_paypal')->default(1);
            $table->tinyInteger('is_stripe')->default(1);
            $table->tinyInteger('is_paystack')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_settings');
    }
};
