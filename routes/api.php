<?php

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

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::apiResource('category', App\Http\Controllers\API\CategoryController::class);
    Route::apiResource('dispatch', App\Http\Controllers\API\DispatchController::class);
    Route::apiResource('product', App\Http\Controllers\API\ProductController::class);
    Route::apiResource('receiving', App\Http\Controllers\API\ReceivingController::class);
    Route::apiResource('transaction', App\Http\Controllers\API\TransactionController::class);
    Route::apiResource('vendor', App\Http\Controllers\API\VendorController::class);

    // Route::get('user', function(){
    //     return ['users' => \App\Models\User::all()];
    // });
    Route::apiResource('user', App\Http\Controllers\API\UserController::class);

    Route::group(['prefix' => 'charts'], function () {
        Route::get('ins', [App\Http\Controllers\API\ChartController::class, 'ins']);
        Route::get('outs', [App\Http\Controllers\API\ChartController::class, 'outs']);
        Route::get('transactions', [App\Http\Controllers\API\ChartController::class, 'transactions']);
        
        Route::get('top-products', [App\Http\Controllers\API\ChartController::class, 'topProducts']);
        Route::get('hot-products', [App\Http\Controllers\API\ChartController::class, 'hotProducts']);
        
        Route::get('insnouts', [App\Http\Controllers\API\ChartController::class, 'insnouts']);
    });
});
