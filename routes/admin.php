<?php

use App\Http\Controllers\Admin\AdminLoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AdminRegisterController;

use App\Http\Controllers\AdminController;
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

Route::get('admin/dashboard', [AdminController::class, 'index'])->name('dashboard')->middleware('admin_auth');
//login
Route::prefix('admin/')->name('dashboard.admin.')->middleware('guest:admin')->group(function () {
    Route::get('login', [AdminLoginController::class, 'login'])->name('login');
    Route::post('login', [AdminLoginController::class, 'checkLogin'])->name('checkLogin');
    Route::get('register', [AdminRegisterController::class, 'register'])->name('register');
    Route::post('register', [AdminRegisterController::class, 'store'])->name('store');
});
Route::post('admin/logout', [AdminLoginController::class, 'logoutAdmin'])->name('dashboard.admin.logout');

//register