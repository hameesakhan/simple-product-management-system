<?php

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

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::apiResource('category', App\Http\Controllers\CategoryController::class);
    Route::apiResource('dispatch', App\Http\Controllers\DispatchController::class);
    Route::apiResource('product', App\Http\Controllers\ProductController::class);
    Route::apiResource('receiving', App\Http\Controllers\ReceivingController::class);
    Route::apiResource('transaction', App\Http\Controllers\TransactionController::class);
    Route::apiResource('vendor', App\Http\Controllers\VendorController::class);
});
