<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Tables\BrandController;
use App\Http\Controllers\Tables\CategoryController;
use App\Http\Controllers\Tables\ProductController;
use App\Models\Catigory;
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
Route::get('/shop/{brand_id}', [ProductController::class, 'filterByBrands'])->name('productByBrands');
Route::get('/shop', [ProductController::class, 'index'])->name('shop');


Route::get('/about', function () {
    return view('Pages.about');
})->name('about');

Route::get('/cart', function () {
    return view('Pages.cart');
})->name('cart');
Auth::routes();
