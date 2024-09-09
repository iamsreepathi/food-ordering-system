<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MenuCategoryController;
use App\Http\Controllers\MenuItemController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;


Route::middleware(['guest'])->group(function () {
    Route::get('login', [AuthController::class, 'loginForm'])->name('login');
    Route::post('login', [AuthController::class, 'login']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/', [HomeController::class, 'home'])->name('app.home');
Route::get('/about', [HomeController::class, 'about'])->name('app.about');
Route::get('/logs', [HomeController::class, 'log'])->name('app.logs');
Route::post('/newsletter/subscription', [HomeController::class, 'newsletter'])->name('app.newsletter');
Route::get('/menu', [MenuCategoryController::class, 'index'])->name('menu.categories');

Route::resource('menu-item', MenuItemController::class)->only(['show']);
Route::resource('cart', CartController::class)->only(['index', 'update', 'destroy']);
Route::post('cart/{id}/add', [CartController::class, 'add'])->name('cart.add');
Route::get('/checkout/success', [CheckoutController::class, 'success'])->name('checkout.success');
Route::get('/checkout/cancel', [CheckoutController::class, 'cancel'])->name('checkout.cancel');

Route::middleware(["auth"])->group(function () {
    Route::resource('checkout', CheckoutController::class)->only(['index', 'store']);
    Route::resource('orders', OrderController::class)->only(['index', 'show']);
    Route::get('/profile', [AuthController::class, 'profile'])->name('user.profile');
    Route::post('menu-item/{menu_item}/review', [MenuItemController::class, 'review'])->name('menu-item.review');
});
