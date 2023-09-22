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
use Illuminate\Support\Facades\Artisan;

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

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'role:' . Roles::B2B_CUSTOMER . '|' . Roles::B2C_CUSTOMER])->group(function () {
    Route::get('products', [ProductController::class, 'index'])->name('products.index');
    Route::get('products/{product}', [ProductController::class, 'show'])->name('products.show');
    Route::post('purchase', [ProductController::class, 'purchase'])->name('purchase.create');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');//// .index
    Route::post('/cancel-purchase', [DashboardController::class, 'cancelPurchase'])->name('cancel-purchase');
});

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/stripe/portal', [StripeController::class, 'portal'])->name('stripe.portal');
});

/*Route::post(
    '/stripe/webhook',
    [WebhookController::class, 'handleWebhook']
);*/

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/billing', [BillingController::class, 'index'])->name('billing');
});

Route::get('/clear', function () {
    Artisan::call('optimize');
    Artisan::call('cache:clear');
    Artisan::call('route:clear');
    Artisan::call('config:clear');
    Artisan::call('view:clear');
    return 'Cache Successfully Cleared';
});
