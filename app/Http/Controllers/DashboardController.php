<?php

namespace App\Http\Controllers;

use App\Constants\Permission;
use App\Constants\Roles;
use App\Services\StripeService;
use Illuminate\Support\Facades\Auth;
use Stripe\Invoice;

class DashboardController extends Controller
{
    protected $stripe;

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

        $subscriptions = $user->subscriptions()->get();
        $subscribed = $subscriptions[0]->ends_at;

        if ($user->hasRole(Roles::B2C_CUSTOMER) && $lastFourDigits) {
            $purchaseDetails = "$lastFourDigitsOfText B2C $cardNumberText: $lastFourDigits";
        } elseif ($user->hasRole(Roles::B2B_CUSTOMER) && $lastFourDigits) {
            $purchaseDetails = "$lastFourDigitsOfText B2B $cardNumberText: $lastFourDigits";
        } else {
            $purchaseDetails = trans('dashboard/messages.no_purchase');
        }

        $canCancelPurchase = $user->can(Permission::CANCEL_PURCHASE) && !$subscribed;
        return view('dashboard.index', compact('user', 'purchaseDetails', 'canCancelPurchase'));
    }

    public function cancelPurchase()
    {
        $user = Auth::user();

        if ($user->can(Permission::CANCEL_PURCHASE)) {

            $invoices = Auth::user()->invoices();
            foreach ($invoices as $invoice) {
                $invoiceId = $invoice->id;
                // Access the subscription ID associated with the invoice
                $stripeInvoice = Invoice::retrieve($invoiceId);
                $subscriptionId = $stripeInvoice->subscription;
                try {
                    $this->stripe->cancelPurchase($subscriptionId);
                    return redirect()->back()->with('success', trans('dashboard/messages.purchase_canceled'));
                } catch (\Throwable $e) {
                    return redirect()->back()->with('error', trans('dashboard/messages.cancellation_failed'));
                }
            }
        } else {
            abort(403, trans('dashboard/messages.unauthorized'));
        }
    }
}
