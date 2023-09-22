<?php

namespace App\Http\Controllers;

use App\Constants\Permission;
use App\Constants\Roles;
use App\Constants\SubscriptionOptions;
use App\Services\StripeService;
use Illuminate\Support\Facades\Auth;
use Stripe\Invoice;

class DashboardController extends Controller
{
    protected $stripe;

    /**
     * @param StripeService $stripe
     */
    public function __construct(StripeService $stripe)
    {
        $this->stripe = $stripe;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        $lastFourDigits = $user->pm_last_four;
        $lastFourDigitsOfText = trans('dashboard/messages.last_four_digits_of');
        $cardNumberText = trans('dashboard/messages.card_number');

        // Check if the subscription is canceled
        $canceled = $user->subscription(SubscriptionOptions::DEFAULT)->canceled();

        // Determine the purchase details
        $hasCard = false; // Assume the user doesn't have a card by default

        if ($user->hasRole(Roles::B2C_CUSTOMER) && $lastFourDigits) {
            $purchaseDetails = "$lastFourDigitsOfText B2C $cardNumberText: $lastFourDigits";
            $hasCard = true; // The user has a card
        } elseif ($user->hasRole(Roles::B2B_CUSTOMER) && $lastFourDigits) {
            $purchaseDetails = "$lastFourDigitsOfText B2B $cardNumberText: $lastFourDigits";
            $hasCard = true; // The user has a card
        } else {
            $purchaseDetails = trans('dashboard/messages.no_purchase');
        }

        // Check if the user can cancel the purchase
        $canCancelPurchase = $user->can(Permission::CANCEL_PURCHASE) && $hasCard && !$canceled;

        return view('dashboard.index', compact('user', 'purchaseDetails', 'canCancelPurchase'));
    }


    public function cancelPurchase()
    {
        $user = Auth::user();

        // Check if the user has permission to cancel the purchase
        if ($user->can(Permission::CANCEL_PURCHASE)) {
            $invoices = Auth::user()->invoices();
            foreach ($invoices as $invoice) {
                $invoiceId = $invoice->id;
                // Access the subscription ID associated with the invoice
                $stripeInvoice = Invoice::retrieve($invoiceId);
                $subscriptionId = $stripeInvoice->subscription;
                try {
                    $this->stripe->cancelPurchase($subscriptionId);
                    // Redirect back with success message upon successful cancellation
                    return redirect()->back()->with('success', trans('dashboard/messages.purchase_canceled'));
                } catch (\Throwable $e) {
                    // Redirect back with error message if cancellation fails
                    return redirect()->back()->with('error', trans('dashboard/messages.cancellation_failed'));
                }
            }
        } else {
            // User is not authorized to cancel the purchase, so return a 403 Forbidden response
            abort(403, trans('dashboard/messages.unauthorized'));
        }
    }
}
