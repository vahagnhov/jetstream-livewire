<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class BillingController extends Controller
{
    public function index() {
       /* $checkoutPlan1 = Auth::user()->checkout('price_1NrPXxDUVMiVujlGms5UmR01', [
            'success_url' => route('dashboard'),
            'cancel_url' => route('dashboard'),
            'mode' => 'subscription'
        ]);


        $checkoutPlan2 = Auth::user()->checkout('price_1NrPZLDUVMiVujlG5FrfZbSS', [
            'success_url' => route('dashboard'),
            'cancel_url' => route('dashboard'),
            'mode' => 'subscription'
        ]);*/

        return view('billing', ['checkout1' => []/*$checkoutPlan1*/, 'checkout2' => []/*$checkoutPlan2*/]);
    }
}
