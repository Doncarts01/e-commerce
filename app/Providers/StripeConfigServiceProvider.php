<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\paymentSettings;


class StripeConfigServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *  @return void
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     *  @return void
     */
    public function boot(): void
    {
        //
        // Fetch Stripe settings from the database
        $paymentSettings = PaymentSettings::getSingle();

        // Dynamically set the Stripe configuration
        config([
            'stripe.stripe_pk' => $paymentSettings->stripe_pk,
            'stripe.stripe_sk' => $paymentSettings->stripe_sk,
        ]);
    }
}
