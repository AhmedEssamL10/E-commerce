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
Route::prefix('users')->group(function () {
    Route::post('/register', RegisterController::class);
    Route::post('/login', [LoginController::class, 'login']);
    Route::post('/logout', [LoginController::class, 'logout']);
    Route::post('/logout-From-All-Devices', [LoginController::class, 'logoutFromAllDevices']);
    Route::post('/send-code', [EmailVerificationController::class, 'sendCode'])->middleware('auth:sanctum');
    Route::post('/check-code', [EmailVerificationController::class, 'checkCode'])->middleware('auth:sanctum');
    //forget password
});