<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Webhook;

class StripeWebhookController extends Controller
{
    public function handleWebhook(Request $request)
    {
        // Verify the webhook signature for security.
        $event = Webhook::constructEvent(
            $request->getContent(),
            $request->header('stripe-signature'),
            config('cashier.webhook.secret')
        );

        // Handle the specific event types.
        switch ($event->type) {
            case 'charge.dispute.created':
                // A dispute has been created. Handle it as needed.
                break;
            case 'charge.dispute.updated':
                // The dispute status has been updated. Handle it as needed.
                break;
            // Handle other events as necessary.
        }

        return response()->json(['message' => 'Webhook received']);
    }
}
