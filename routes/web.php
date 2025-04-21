<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ItemCategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'home'])->name('home');

Route::middleware('guestOnly')->group(function () {
    Route::get('/login', [AuthController::class, 'loginForm'])->name('login-form');
    Route::get('/register', [AuthController::class, 'registerForm'])->name('register-form');
});
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::resource('/products', ProductController::class);

    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart', [CartController::class, 'store'])->name('cart.store');
    Route::put('/cart/{id}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/{id}', [CartController::class, 'destroy'])->name('cart.destroy');
    Route::get('/buy/{id}', [OrderController::class, 'buy'])->name('order.buy');
    Route::get('/checkout', [OrderController::class, 'showCheckoutForm'])->name('checkout.form');
    Route::post('/checkout', [OrderController::class, 'checkout'])->name('checkout');
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{id}', [OrderController::class, 'show'])->name('orders.show');
    Route::get('/orders/{id}/export-pdf', [OrderController::class, 'exportPdf'])->name('orders.exportPdf');


    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

    Route::get('/feedback/{id}/create', [FeedbackController::class, 'create'])->name('feedback.create');
    Route::post('/feedback/{id}', [FeedbackController::class, 'store'])->name('feedback.store');
    Route::middleware('admin')->group(function () {
        Route::resource('products', ProductController::class)->except(['index', 'show']);
        Route::resource('/item-categories', ItemCategoryController::class);

        Route::get('/admin/products', [ProductController::class, 'getProducts'])->name('admin.products.index');
        Route::get('/admin/orders', [OrderController::class, 'getOrderAdmin'])->name('admin.orders.index');
        Route::patch('/orders/{id}/status', [OrderController::class, 'updateStatus'])->name('admin.orders.updateStatus');
        Route::resource('/admin/users', UserController::class);

        Route::get('/feedbacks', [FeedbackController::class, 'index'])->name('admin.feedback.index');

    });
});
