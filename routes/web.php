<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Tables\ProductController;
use App\Http\Controllers\Tables\CartController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get(
    '/',
    [HomeController::class, 'index']
)->name('home');
Route::get('/shop/brand/{brand_id}', [ProductController::class, 'filterByBrands'])->name('productByBrands');
Route::get('/shop/category/{Category_id}', [ProductController::class, 'filterByCategories'])->name('productByCategories');
Route::get('/shop/subcategory/{subCategory_id}', [ProductController::class, 'filterBySubategories'])->name('productBySubcategories');
Route::get('/shop', [ProductController::class, 'index'])->name('shop');
Route::get('/shop/product-details/{product_id}', [ProductController::class, 'product_details'])->name('product_details');
Route::get('/shop/cart/{product_id}', [CartController::class, 'cart'])->name('AddToCart')->middleware('auth');
Route::get('/cart', [CartController::class, 'index'])->name('cart')->middleware('auth');

Route::get('/about', function () {
    return view('Pages.about');
})->name('about');

// Route::get('/cart', function () {
//     return view('Pages.cart');
// })->name('cart');
Auth::routes();
