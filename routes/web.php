<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;

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
    return view('welcome');
});

Route::get('add_product', [AdminController::class, 'add_product'])->name('add_product');
Route::post('store_product', [AdminController::class, 'store_product'])->name('store_product');
Route::get('show_product', [AdminController::class, 'show_product'])->name('show_product');
Route::get('edit/{product}', [AdminController::class, 'edit'])->name('edit');
Route::patch('update/{product}', [AdminController::class, 'update'])->name('update');
Route::delete('delete/{product}', [AdminController::class, 'delete'])->name('delete');
Route::patch('confirm/{id}', [AdminController::class, 'confirm']);

Route::group(['middleware' => ['auth']], function() {
    Route::get('beranda', [UserController::class, 'beranda'])->name('beranda');
    Route::get('detail/{product}', [UserController::class, 'detail'])->name('detail');
    Route::post('cart/{product}', [UserController::class, 'add_cart'])->name('add_cart');
    Route::get('carts', [UserController::class, 'carts'])->name('carts');
    Route::post('checkout', [UserController::class, 'checkout'])->name('checkout');
    Route::get('orders', [AdminController::class, 'orders'])->name('orders');
    Route::get('order/{id}', [UserController::class, 'order_user'])->name('show_order');
    Route::patch('order/{order}/pay', [UserController::class, 'payment']);
});



Route::group(['middleware' => ['guest']], function(){
    Route::get('register', [UserController::class, 'register'])->name('register');
    Route::post('signup', [UserController::class, 'signup'])->name('signup');
    Route::get('login', [UserController::class, 'login'])->name('login');
    Route::post('signin', [UserController::class, 'signin'])->name('signin');

});
Route::get('logout', [UserController::class, 'logout'])->name('logout');
