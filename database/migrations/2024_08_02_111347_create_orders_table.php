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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->string('firstName')->nullable();
            $table->string('lastName')->nullable();
            $table->string('country')->nullable();
            $table->string('address1')->nullable();
            $table->string('address2')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('postcode')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->text('notes')->nullable();
            $table->string('couponCode')->nullable();
            $table->string('couponCode_amount')->nullable();
            $table->integer('shipping_id')->nullable();
            $table->string('shipping_amount')->default(0);;
            $table->string('total_amount')->default(0);
            $table->string('payment_method')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->tinyInteger('isdelete')->default(0);
            $table->tinyInteger('isPayment')->default(0);
            $table->text('payment_data')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
