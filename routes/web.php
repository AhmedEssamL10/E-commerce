<?php

use App\Http\Controllers\Auth\SocialController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LangougeController;
use App\Http\Controllers\Tables\FavorateController;
use App\Http\Controllers\Tables\AddressController;
use App\Http\Controllers\Tables\ProductController;
use App\Http\Controllers\Tables\CartController;
use App\Http\Controllers\Tables\ComplaintController;
use App\Http\Controllers\Tables\NewsController;
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

Route::middleware('lang')->group(function () {
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
    Route::prefix('/profile')->middleware('verified')->group(function () {
        Route::get('', function () {
            return view('Pages.profile');
        })->name('profile');
        Route::post('/edit', [AddressController::class, 'edit'])->name('addressEdit');
        Route::post('/create', [AddressController::class, 'create'])->name('addressCreate');
        Route::post('/changePassword', [UserController::class, 'changePassword'])->name('changePassword');
    });

    Route::get('/about', function () {
        return view('Pages.about');
    })->name('about');
    //contact
    Route::get('/contact', [ComplaintController::class, 'index'])->middleware('auth')->name('contact');
    Route::get('/contact/create', [ComplaintController::class, 'create'])->middleware('auth')->name('contact.create');
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
    //news
    Route::get('/news', [NewsController::class, 'index'])->name('news.index');
    //language
    Route::get('/lang/en', [LangougeController::class, 'en'])->name('lang.en');
    Route::get('/lang/ar', [LangougeController::class, 'ar'])->name('lang.ar');
    Auth::routes(['verify' => true]);
    Auth::routes();
    //socialite
    Route::get('auth/google', [SocialController::class, 'redirectToGoogle']);
    Route::get('auth/google/callback', [SocialController::class, 'handleGoogleCallback']);

    // Route::get('auth/facebook', [SocialController::class, 'redirectToFacebook']);
    // Route::get('auth/facebook/callback', [SocialController::class, 'handleFacebookCallback']);
});