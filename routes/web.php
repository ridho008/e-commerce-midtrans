<?php

use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('hello');
});

 
Route::get('/products', [ProductsController::class, 'index']);
Route::get('/cart', [CartController::class, 'index']);
Route::post('/midtrans-callback', [CartController::class, 'callback']);

Route::post('/checkout', [CartController::class, 'checkout'])->name('checkout.cart');
Route::post('/product/{id}', [CartController::class, 'addProducttoCart'])->name('addproduct.to.cart');
Route::post('/update-shopping-cart', [CartController::class, 'updateCart'])->name('update.sopping.cart');
Route::delete('/delete-cart-product', [CartController::class, 'deleteProduct'])->name('delete.cart.product');