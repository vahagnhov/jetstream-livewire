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
        $this->stripe->setApiKey(config('cashier.key'));
        $this->stripe->setApiKey(config('cashier.secret'));
    }

    public function cancelPurchase($subscriptionId)
    {
        $stripe = new StripeClient(config('cashier.secret'));
        $stripe->subscriptions->cancel($subscriptionId, []);
    }
}
