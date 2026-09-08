<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'home'])->name('home');

Route::get('/about', function () {
    return view('petsaathi.about');
})->name('about');

Route::get('/shop', [ShopController::class, 'shop'])->name('shop');
Route::get('/categories', [CategoryController::class, 'category'])->name('categories');
Route::get('/blog', fn () => view('petsaathi.blog'))->name('blog');
Route::get('/contact', fn () => view('petsaathi.contact'))->name('contact');
Route::get('/faq', fn () => view('petsaathi.faq'))->name('faq');
Route::get('/cart', fn () => view('petsaathi.cart'))->name('cart');
Route::get('/wishlist', fn () => view('petsaathi.wishlist'))->name('wishlist');
Route::get('/checkout', fn () => view('petsaathi.checkout'))->name('checkout');
Route::get('/order-success', fn () => view('petsaathi.order-success'))->name('order.success');
Route::get('/order-history', fn () => view('petsaathi.order-history'))->name('order.history');
Route::get('/product-details', fn () => view('petsaathi.product-details'))->name('product.details');

Route::get('/dashboard', function () {
    return redirect(Auth::user()->homeRoute());
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/admin.php';
require __DIR__.'/auth.php';
