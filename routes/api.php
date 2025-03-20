<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\LoginController;
use App\Http\Controllers\API\OrderController;
use App\Http\Controllers\API\ProductNameController;
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

// API expose for login
Route::post('login', [LoginController::class, 'login']);

// API expose for orderCreation
Route::middleware(['auth:sanctum', 'admin'])->prefix('orders')->group(function () {
    Route::post('store', [OrderController::class, 'store']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//API expose for product name
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/product-names', [ProductNameController::class, 'view']);
});