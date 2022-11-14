<?php

use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CategoriesController;
use App\Http\Controllers\Front\CartController;
use App\Http\Controllers\Front\CheckoutController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\ProductController;
use App\Http\Controllers\Front\ShopController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

//cart
Route::get('/cart', [CartController::class, 'index'])->name('cart');
Route::get('/cart/add/{id}', [CartController::class, 'add'])->name('add.cart');
Route::get('cart/delete/{rowId}', [CartController::class, 'delete'])->name('delete.cart');
Route::get('cart/destroy', [CartController::class, 'destroy'])->name('destroy.cart');
Route::get('cart/update', [CartController::class, 'update'])->name('update.cart');

//checkout
Route::get('cart/checkout', [CheckoutController::class, 'index'])->name('checkout');
Route::post('cart/address', [CheckoutController::class, 'address'])->name('checkout.address');
Route::post('cart/checkout', [CheckoutController::class, 'addOrder'])->name('checkout.addorder');


//admin
Route::prefix('admin')->group(function () {
Route::get('/login', [AdminController::class, 'auth'])->name('admin.auth');
Route::post('/login', [AdminController::class, 'login'])->name('admin.login');
Route::post('/logout', [AdminController::class, 'logout'])->name('admin.logout');
Route::middleware(['admin'])->group(function () {
        Route::get('/', [AdminController::class, 'index'])->name('admin.index');
        //brand
        Route::get('/brands', [BrandController::class, 'index'])->name('admin.brand.index');
        Route::get('/brands/create', [BrandController::class, 'create'])->name('admin.brand.create');
        Route::post('/brands/store', [BrandController::class, 'store'])->name('admin.brand.store');
        Route::get('/brands/edit/{id}', [BrandController::class, 'edit'])->name('admin.brand.edit');
        Route::post('/brands/update/{id}', [BrandController::class, 'update'])->name('admin.brand.update');
        Route::delete('/brands/delete/{id}', [BrandController::class, 'destroy'])->name('admin.brand.destroy');

        //category
        Route::get('/categories', [CategoriesController::class, 'index'])->name('admin.categories.index');
        Route::get('/categories/create', [CategoriesController::class, 'create'])->name('admin.categories.create');
        Route::post('/categories/store', [CategoriesController::class, 'store'])->name('admin.categories.store');
        Route::get('/categories/edit/{id}', [CategoriesController::class, 'edit'])->name('admin.categories.edit');
        Route::post('/categories/update/{id}', [CategoriesController::class, 'update'])->name('admin.categories.update');
        Route::delete('/categories/delete/{id}', [CategoriesController::class, 'destroy'])->name('admin.categories.destroy');
    });
});
