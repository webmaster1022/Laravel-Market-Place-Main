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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/inbox', [App\Http\Controllers\HomeController::class, 'inbox'])->name('inbox');


Route::middleware(['auth'])->group(function() {
    Route::post('/create', [App\Http\Controllers\ProductController::class, 'createProduct'])->name('create-product');
    Route::get('/create-product', [App\Http\Controllers\ProductController::class, 'index'])->name('create-product-view');
    Route::get('/view-single-product/{id}', [App\Http\Controllers\ProductController::class, 'singleProductView']);
    Route::get('/product/{id}', [App\Http\Controllers\ProductController::class, 'viewProduct'])->name('view-product');
    Route::get('/products', [App\Http\Controllers\ProductController::class, 'viewProducts'])->name('view-products');
});
