<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CakeController;
use Illuminate\Support\Facades\Route;


// Route::get('/', function () {
//     return view('cakes.index');
// });

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
    Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
    Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');
    Route::get('/cakes/search', [CakeController::class, 'search'])->name('cakes.search');

    // Checkout
    Route::get('/checkout', [CheckoutController::class, 'show'])->name('checkout.show');
    Route::post('/checkout/process', [CheckoutController::class, 'process'])->name('checkout.process');
    Route::get('/checkout/success', [CheckoutController::class, 'success'])->name('checkout.success');

    // Profile
    Route::get('/profile/history', [ProfileController::class, 'history'])->name('profile.history');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.user');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.user.update');
    Route::put('/profile/address/update', [ProfileController::class, 'updateAddress'])->name('profile.address.update');
    // Route untuk riwayat pesanan (history)
    Route::get('/orders/history', [CheckoutController::class, 'history'])->name('orders.history');

    // Route untuk menampilkan invoice berdasarkan ID pesanan
    Route::get('/orders/invoice/{orderId}', [CheckoutController::class, 'invoice'])->name('invoice.show');
    Route::get('/payment/status/{orderId}', [PaymentController::class, 'checkPaymentStatus'])->name('payment.status');

});
Route::get('/', [CakeController::class, 'index'])->name('cakes.index');
Route::get('/dashboard', [CakeController::class, 'index'])->name('dashboard');
Route::get('/product', [CakeController::class, 'product'])->name('cakes.product');
Route::get('/cakes/{id}', [CakeController::class, 'show'])->name('cakes.show');
Route::get('/about', [CakeController::class, 'about'])->name('cakes.about');
