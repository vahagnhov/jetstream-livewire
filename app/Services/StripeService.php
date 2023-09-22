<?php

namespace App\Services;

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
        $stripe = new StripeClient(config('services.stripe.secret'));
        $stripe->subscriptions->cancel($subscriptionId, []);
    }
}
