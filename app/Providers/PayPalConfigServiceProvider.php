<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\paymentSettings;

class PayPalConfigServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     * @return void
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     * @return void
     */
    public function boot(): void
    {
        //
         // Fetch PayPal settings from the database
         $paymentSettings = paymentSettings::getSingle();

         // Dynamically set the PayPal configuration
         config([
             'paypal.mode' => $paymentSettings->paypal_status,
             'paypal.sandbox.client_id' => $paymentSettings->paypal_id,
             'paypal.sandbox.client_secret' => $paymentSettings->paypal_sk,
             'paypal.sandbox.app_id' => 'APP-80W284485P519543T', // Sandbox app ID
             'paypal.live.client_id' => $paymentSettings->paypal_id,
             'paypal.live.client_secret' => $paymentSettings->paypal_sk,
             'paypal.live.app_id' => $paymentSettings->live_app_id ?? '',
         ]);
    }
}
