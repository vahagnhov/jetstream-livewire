<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Laravel\Cashier\Http\Controllers\WebhookController as CashierController;

class WebhookController extends CashierController
{
    public function handleCheckoutSessionCompleted(array $payload)
    {
        $data = $payload['data']['object'];
        $user = User::findOrFail($data['client_reference_id']);

        DB::transaction(function () use ($data, $user) {
            $user->update(['stripe_id' => $data['customer']]);

            $user->subscriptions()->create([
                'name' => 'default',
                'stripe_id' => $data['subscription'],
                'stripe_status' => 'active'
            ]);
        });

        return $this->successMethod();
    }
}
