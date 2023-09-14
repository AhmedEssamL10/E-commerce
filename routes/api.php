<?php

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
