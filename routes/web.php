<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Tables\BrandController;
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
    [BrandController::class, 'index']
)->name('home');

Route::get('/about', function () {
    return view('Pages.about');
})->name('about');
Route::get('/shop', function () {
    return view('Pages.shop');
})->name('shop');
Route::get('/cart', function () {
    return view('Pages.cart');
})->name('cart');
Auth::routes();
