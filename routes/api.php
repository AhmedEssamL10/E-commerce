<?php

use App\Http\Controllers\Apis\Auth\EmailVerificationController;
use App\Http\Controllers\Apis\Auth\LoginController;
use App\Http\Controllers\Apis\Auth\RegisterController;
use App\Http\Controllers\Apis\HomeController;
use App\Http\Controllers\Apis\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('products', [ProductController::class, 'index']);
Route::get('/', [HomeController::class, 'index']);
//Auth
Route::post('users/register', RegisterController::class);
Route::post('users/login', [LoginController::class, 'login']);
Route::post('users/logout', [LoginController::class, 'logout']);
Route::post('users/logout-From-All-Devices', [LoginController::class, 'logoutFromAllDevices']);
Route::post('users/send-code', [EmailVerificationController::class, 'sendCode']);
Route::post('users/check-code', [EmailVerificationController::class, 'checkCode']);
