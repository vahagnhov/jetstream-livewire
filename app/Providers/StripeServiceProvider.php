<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Stripe\Stripe;

class StripeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton('stripe', function () {
            Stripe::setApiKey(config('services.stripe.key'));
            return new Stripe();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Stripe::setApiKey(config('services.stripe.secret'));
    }
}
