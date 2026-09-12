<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\WishlistController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'home'])->name('home');

Route::get('/about', [AboutController::class, 'index'])->name('about');

Route::get('/shop', [ShopController::class, 'shop'])->name('shop');
Route::get('/categories', [CategoryController::class, 'category'])->name('categories');
Route::get('/blog', fn () => view('petsaathi.blog'))->name('blog');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
Route::get('/faq', fn () => view('petsaathi.faq'))->name('faq');
Route::get('/checkout', fn () => view('petsaathi.checkout'))->name('checkout');
Route::get('/order-success', fn () => view('petsaathi.order-success'))->name('order.success');
Route::get('/order-history', fn () => view('petsaathi.order-history'))->name('order.history');
Route::get('/product-details', fn () => view('petsaathi.product-details'))->name('product.details');

Route::get('/dashboard', function () {
    return redirect(Auth::user()->homeRoute());
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // A wishlist belongs to a person, so both routes need someone logged in.
    // Guests who click the heart are sent to the login page automatically.
    Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist');
    Route::post('/wishlist/toggle', [WishlistController::class, 'toggle'])->name('wishlist.toggle');

    // The cart belongs to a person too, so it sits behind login as well.
    Route::get('/cart', [CartController::class, 'index'])->name('cart');
    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
    Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
    Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/admin.php';
require __DIR__.'/auth.php';
