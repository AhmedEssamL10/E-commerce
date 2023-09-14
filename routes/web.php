<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Tables\FavorateController;
use App\Http\Controllers\Tables\AddressController;
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
Route::prefix('/shop')->group(function () {
    Route::get('/brand/{brand_id}', [ProductController::class, 'filterByBrands'])->name('productByBrands');
    Route::get('/category/{Category_id}', [ProductController::class, 'filterByCategories'])->name('productByCategories');
    Route::get('/subcategory/{subCategory_id}', [ProductController::class, 'filterBySubategories'])->name('productBySubcategories');
    Route::get('', [ProductController::class, 'index'])->name('shop');
    Route::get('/product-details/{product_id}', [ProductController::class, 'product_details'])->name('product_details');
    Route::get('/{product_id}', [CartController::class, 'cart'])->name('AddToCart')->middleware('auth');
});
Route::prefix('/cart')->middleware('auth')->controller(CartController::class)->group(function () {
    Route::get('', 'index')->name('cart');
    Route::get('delete/{product_id}', 'delete')->name('deleteCartProduct');
    Route::get('deleteAll', 'deleteAll')->name('deleteAllCartProducts');
    Route::post('edit/{product_id}',  'edit')->name('editCartProduct');
});
Route::get('/profile', function () {
    return view('Pages.profile');
})->name('profile');
Route::post('/profile/edit', [AddressController::class, 'edit'])->name('addressEdit');
Route::post('/profile/create', [AddressController::class, 'create'])->name('addressCreate');


Route::get('/about', function () {
    return view('Pages.about');
})->name('about');

Route::get('/favorate', [FavorateController::class, 'index'])->name('favorate');
Route::get('/favorate/create/{id}', [FavorateController::class, 'create'])->name('favorate.create');
Route::get('/favorate/delete/{id}', [FavorateController::class, 'delete'])->name('favorate.delete');
Auth::routes();
