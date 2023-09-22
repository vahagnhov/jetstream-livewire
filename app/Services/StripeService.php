<?php

namespace App\Services;

use App\Constants\SubscriptionOptions;
use Illuminate\Support\Facades\Auth;
use Stripe\Stripe;
use Stripe\StripeClient;

class StripeService
{
    protected $stripe;

    public function __construct()
    {
        $this->stripe = new Stripe();
        $this->stripe->setApiKey(config('services.stripe.key'));
        $this->stripe->setApiKey(config('services.stripe.secret'));
    }

    public function cancelPurchase($subscriptionId)
    {
        Auth::user()->subscription(SubscriptionOptions::DEFAULT)->cancel();
        $stripe = new StripeClient(config('services.stripe.secret'));
        $stripe->subscriptions->cancel($subscriptionId, []);
    }
}
