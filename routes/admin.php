<?php

use App\Http\Controllers\Admin\AdminLoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AdminRegisterController;
use App\Http\Controllers\Admin\Tables\ProductController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('admin/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('admin_auth');
//login
Route::prefix('admin/')->name('dashboard.admin.')->middleware('guest:admin')->group(function () {
    Route::get('login', [AdminLoginController::class, 'login'])->name('login');
    Route::post('login', [AdminLoginController::class, 'checkLogin'])->name('checkLogin');
    Route::get('register', [AdminRegisterController::class, 'register'])->name('register');
    Route::post('register', [AdminRegisterController::class, 'store'])->name('store');
});
Route::post('admin/logout', [AdminLoginController::class, 'logoutAdmin'])->name('dashboard.admin.logout');
//products
Route::prefix('admin/dashboard/products')->middleware('admin_auth')->name('products.')->controller(ProductController::class)->group(function () { // routing group to make unrepeated code
    Route::get('/all', 'index')->name('index');
    Route::get('/create', 'create')->name('create');
    Route::post('/store', 'store')->name('store');
    Route::get('/edit/{id}', 'edit')->name('edit');
    Route::put('/update/{id}', 'update')->name('update');
    Route::get('/delete/{id}', 'delete')->name('delete');
});
// brands
Route::prefix('brands')->middleware('verified')->name('brands.')->controller(BrandController::class)->group(function () {
    Route::get('/all', 'index')->name('index');
    //create
    Route::get('/create', 'create')->name('create');
    Route::post('/store', 'store')->name('store');
    //edit
    Route::get('/edit/{id}', 'edit')->name('edit');
    Route::post('/update/{id}', 'update')->name('update');
    //delete
    Route::get('/delete/{id}', 'delete')->name('delete');
});
// catigories
Route::prefix('catigories')->middleware('verified')->name('catigories.')->controller(CatigoryController::class)->group(function () {
    Route::get('/all', 'index')->name('index');
    //create
    Route::get('/create', 'create')->name('create');
    Route::post('/store', 'store')->name('store');
    //edit
    Route::get('/edit/{id}', 'edit')->name('edit');
    Route::post('/update/{id}', 'update')->name('update');
    //delete
    Route::get('/delete/{id}', 'delete')->name('delete');
});
