<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::view('categories', 'home');
Route::view('categories/:id', 'home');
Route::view('categories/:id/edit', 'home');

Route::view('vendors', 'home');
Route::view('vendors/:id', 'home');
Route::view('vendors/:id/edit', 'home');

Route::view('products', 'home');
Route::view('products/:id', 'home');
Route::view('products/:id/edit', 'home');

Route::view('transactions', 'home');
Route::view('transactions/:id', 'home');
Route::view('transactions/:id/edit', 'home');

// Route::view('dispatches', 'home');
// Route::view('dispatches/:id', 'home');
// Route::view('dispatches/:id/edit', 'home');

// Route::view('receivings', 'home');
// Route::view('receivings/:id', 'home');
// Route::view('receivings/:id/edit', 'home');
