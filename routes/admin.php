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

Route::get('admin/dashboard', [AdminController::class, 'index'])->name('dashboard')->middleware('auth:admin');
//login
Route::get('admin/login', [AdminLoginController::class, 'login'])->name('dashboard.admin.login');
Route::post('admin/login', [AdminLoginController::class, 'checkLogin'])->name('dashboard.admin.checkLogin');
//register
Route::get('admin/register', [AdminRegisterController::class, 'register'])->name('dashboard.admin.register');
Route::post('admin/register', [AdminRegisterController::class, 'store'])->name('dashboard.admin.store');
