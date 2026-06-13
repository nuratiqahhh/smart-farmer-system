<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\FarmerController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\HarvestRecordController;
use App\Http\Controllers\ReportController;
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

    $user = auth()->user();

    if ($user->role === 'admin') {

        return redirect('/admin/dashboard');

    }

    if ($user->role === 'farmer') {

        return redirect('/farmer/dashboard');

    }

    return redirect('/shop');

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

    Route::get('/admin/products', [ProductController::class, 'adminIndex'])
        ->name('admin.products');

    Route::get('/admin/orders', [OrderController::class, 'adminOrders'])
    ->name('admin.orders');

    Route::get('/admin/users', [UserController::class, 'index'])
    ->name('admin.users');

    Route::delete('/admin/users/{id}', [UserController::class, 'destroy'])
    ->name('admin.users.delete');
});

/*
|--------------------------------------------------------------------------
| FARMER DASHBOARD
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    Route::get('/farmer/dashboard',
        [FarmerController::class, 'dashboard'])
        ->name('farmer.dashboard');

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
| FARMER PRODUCTS
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    Route::resource('farmer-products', ProductController::class);

});

/*
|--------------------------------------------------------------------------
| HARVEST RECORDS
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    Route::resource(
        'harvest-records',
        HarvestRecordController::class
    );

});

/*
|--------------------------------------------------------------------------
| REPORTS
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    Route::get(
        '/reports',
        [ReportController::class, 'index']
    )->name('reports.index');

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

    Route::get('/orders', [OrderController::class, 'index'])
        ->name('orders.index');

    Route::get('/my-orders', [OrderController::class, 'myOrders'])
        ->name('orders.history');

    Route::post('/buy/{id}', [OrderController::class, 'buy'])
        ->name('orders.buy');

    Route::put('/orders/{id}/complete',
        [OrderController::class, 'complete'])
        ->name('orders.complete');

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