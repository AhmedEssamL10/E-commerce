<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Tables\FavorateController;
use App\Http\Controllers\Tables\AddressController;
use App\Http\Controllers\Tables\ProductController;
use App\Http\Controllers\Tables\CartController;
use App\Http\Controllers\Tables\OrderHistoryController;
use App\Http\Controllers\UserController;
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
//shop
Route::prefix('/shop')->group(function () {
    Route::get('/brand/{brand_id}', [ProductController::class, 'filterByBrands'])->name('productByBrands');
    Route::get('/category/{Category_id}', [ProductController::class, 'filterByCategories'])->name('productByCategories');
    Route::get('/subcategory/{subCategory_id}', [ProductController::class, 'filterBySubategories'])->name('productBySubcategories');
    Route::get('', [ProductController::class, 'index'])->name('shop');
    Route::get('/product-details/{product_id}', [ProductController::class, 'product_details'])->name('product_details');
    Route::get('/{product_id}', [CartController::class, 'cart'])->name('AddToCart')->middleware('auth');
});
//cart
Route::prefix('/cart')->middleware('verified')->controller(CartController::class)->group(function () {
    Route::get('', 'index')->name('cart');
    Route::get('delete/{product_id}', 'delete')->name('deleteCartProduct');
    Route::get('deleteAll', 'deleteAll')->name('deleteAllCartProducts');
    Route::post('edit/{product_id}',  'edit')->name('editCartProduct');
});
//profile
Route::get('/profile', function () {
    return view('Pages.profile');
})->name('profile');
Route::post('/profile/edit', [AddressController::class, 'edit'])->name('addressEdit');
Route::post('/profile/create', [AddressController::class, 'create'])->name('addressCreate');
Route::post('/profile/changePassword', [UserController::class, 'changePassword'])->name('changePassword');

Route::get('/about', function () {
    return view('Pages.about');
})->name('about');
Route::get('/contact', function () {
    return view('Pages.contact');
})->middleware('auth')->name('contact');
//checkout
Route::get('/checkout', [CartController::class, 'checkoutIndex'])->name('checkout')->middleware('auth');
Route::get('/checkout/create', [OrderHistoryController::class, 'create'])->name('orderHistpryCreate')->middleware('auth');
//favorate
Route::prefix('/favorate')->middleware('auth')->name('favorate')->controller(FavorateController::class)->group(function () {
    Route::get('', 'index');
    Route::get('/create/{id}',  'create')->name('.create');
    Route::get('/delete/{id}', 'delete')->name('.delete');
    Route::get('/deleteAll',  'deleteAll')->name('.deleteAll');
});
Auth::routes(['verify' => true]);

Auth::routes();
