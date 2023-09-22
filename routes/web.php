<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\WebhookController;
use App\Http\Controllers\BillingController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StripeWebhookController;
use App\Constants\Roles;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


//Route::get('/', [IndexController::class, 'index'])->name('home');
Route::get('/', function () {
    return view('welcome');
});
Route::post('/stripe/webhook', [StripeWebhookController::class, 'handleWebhook'])->name('stripe.webhook');

Route::middleware(['auth', 'role:' . Roles::B2B_CUSTOMER . '|' . Roles::B2C_CUSTOMER])->group(function () {
    Route::get('products', [ProductController::class, 'index']);
    Route::get('products/{product}', [ProductController::class, 'show'])->name("products.show");
    Route::post('purchase', [ProductController::class, 'purchase'])->name("purchase.create");
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/cancel-purchase', [DashboardController::class, 'cancelPurchase'])->name('cancel-purchase');
});






Route::get('/clear', function () {
    \Illuminate\Support\Facades\Artisan::call('optimize');
    \Illuminate\Support\Facades\Artisan::call('cache:clear');
    \Illuminate\Support\Facades\Artisan::call('route:clear');
    \Illuminate\Support\Facades\Artisan::call('config:clear');
    \Illuminate\Support\Facades\Artisan::call('view:clear');
});


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/stripe/portal', [StripeController::class, 'portal'])->name('stripe.portal');
});

Route::post(
    '/stripe/webhook',
    [WebhookController::class, 'handleWebhook']
);

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/billing', [BillingController::class, 'index'])->name('billing');
});
