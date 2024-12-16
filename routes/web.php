<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
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
    // Route::get('/dashboard', function () {
    //     return view('dashboard');
    // })->name('dashboard');

    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
    Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
    Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');
    Route::get('/cart/confirmation', [CartController::class, 'confirmation'])->name('cart.confirmation');
    // Route::get('/checkout', [CheckoutController::class, 'show'])->name('checkout.show');
    // Route::post('/checkout', [CheckoutController::class, 'process'])->name('checkout.process');
    // Route::get('/checkout/success', [CheckoutController::class, 'success'])->name('checkout.success');
    Route::get('/checkout', [CheckoutController::class, 'show'])->name('checkout.show');
    Route::post('/checkout/process', [CheckoutController::class, 'process'])->name('checkout.process');
    Route::get('/checkout/success', [CheckoutController::class, 'success'])->name('checkout.success');

    // Profile
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.user');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.user.update');
    Route::put('/profile/address/update', [ProfileController::class, 'updateAddress'])->name('profile.address.update');
});

Route::get('/', [CakeController::class, 'index'])->name('cakes.index');
Route::get('/dashboard', [CakeController::class, 'index'])->name('dashboard');
Route::get('/product', [CakeController::class, 'product'])->name('cakes.product');
Route::get('/cakes/{id}', [CakeController::class, 'show'])->name('cakes.show');
Route::get('/about', [CakeController::class, 'about'])->name('cakes.about');
