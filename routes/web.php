<?php

use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\ProductController;
use App\Http\Controllers\Front\ShopController;
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

Route::get('/', [HomeController::class, 'index']);

Route::get('/shop', [ShopController::class, 'index'])->name('shop');
Route::get('/shop/category/{slugCate}', [ShopController::class, 'category'])->name('shop.category');
Route::get('/product/{id}', [ProductController::class, 'show'])->name('front.product');
Route::post('/product/{id}', [ProductController::class, 'comment'])->name('front.product.comment');
Route::post('/modal', [ProductController::class, 'modal'])->name('front.product.modal');


