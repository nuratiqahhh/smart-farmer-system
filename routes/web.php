<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| DASHBOARD
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

/*
|--------------------------------------------------------------------------
| ADMIN DASHBOARD
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

});

/*
|--------------------------------------------------------------------------
| ADMIN PRODUCTS
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    Route::get('/admin/products', [ProductController::class, 'adminIndex'])
        ->name('admin.products');

});

/*
|--------------------------------------------------------------------------
| FARMER DASHBOARD
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    Route::get('/farmer/dashboard', function () {
        return view('farmer.dashboard');
    })->name('farmer.dashboard');

});

/*
|--------------------------------------------------------------------------
| FARMER PROFILE
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    Route::get('/farmer/profile', function () {
        return view('farmer.profile');
    })->name('farmer.profile');

});

/*
|--------------------------------------------------------------------------
| PRODUCTS
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    Route::resource('products', ProductController::class);

});

/*
|--------------------------------------------------------------------------
| SHOP
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    Route::get('/shop', [ProductController::class, 'shop'])
        ->name('shop');

});

/*
|--------------------------------------------------------------------------
| CART
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    Route::get('/cart', [CartController::class, 'index'])
        ->name('cart.index');

    Route::post('/cart/add/{id}', [CartController::class, 'add'])
        ->name('cart.add');

    Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])
        ->name('cart.remove');

});

/*
|--------------------------------------------------------------------------
| CHECKOUT
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    Route::get('/checkout', [CheckoutController::class, 'index'])
        ->name('checkout.index');

    Route::post('/checkout/store', [CheckoutController::class, 'store'])
        ->name('checkout.store');

});

/*
|--------------------------------------------------------------------------
| PAYMENT SUCCESS
|--------------------------------------------------------------------------
*/

Route::get('/payment-success', function () {
    return view('checkout.success');
})->middleware(['auth']);

/*
|--------------------------------------------------------------------------
| ORDERS
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    // Farmer View Orders
    Route::get('/orders', [OrderController::class, 'index'])
        ->name('orders.index');

    // Customer Order History
    Route::get('/my-orders', [OrderController::class, 'history'])
        ->name('orders.history');

    // Buy Product
    Route::post('/buy/{id}', [OrderController::class, 'buy'])
        ->name('orders.buy');

});

/*
|--------------------------------------------------------------------------
| PROFILE DEFAULT BREEZE
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');

});

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/

require __DIR__.'/auth.php';