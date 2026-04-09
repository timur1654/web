<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BasketController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
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

Route::get('/', [MainController::class, 'index'])->name('home');

Route::get('register', [UserController::class, 'registerForm'])->name('register');
Route::post('register', [UserController::class, 'register'])->name('register.post');

Route::get('login', [UserController::class, 'loginForm'])->name('login');
Route::post('login', [UserController::class, 'login'])->name('login.post');

Route::get('logout', [UserController::class, 'logout'])->name('logout');

Route::get('about', [MainController::class, 'index'])->name('about');

Route::get('find', function (){
    return view('find');
})->name('find');


Route::middleware('session.auth')->group(function (){
    Route::get('catalog', [CatalogController::class, 'index'])->name('catalog');
    Route::get('catalog/product/{product}', [CatalogController::class, 'show'])->name('catalog.product.show');

    Route::get('basket', [BasketController::class, 'index'])->name('basket');
    Route::post('basket/add{product}', [BasketController::class, 'itemAdd'])->name('basket.add');
    Route::post('basket/remove{product}', [BasketController::class, 'itemRemove'])->name('basket.remove');

    Route::post('orders/create', [OrderController::class, 'orderCreate'])->name('order.create');
    Route::get('orders', [OrderController::class, 'index'])->name('orders');
    Route::post('orders/remove{order}', [OrderController::class, 'orderRemove'])->name('order.remove');
});


Route::middleware('role')->group(function (){

    Route::view('admin', 'admins.admin')->name('admin');

    Route::get('admin/category', [CategoryController::class, 'index'])->name('admin.category');
    Route::post('admin/category', [CategoryController::class, 'categoryCreate'])->name('admin.category.create');
    Route::post('admin/editCategory{category}', [CategoryController::class, 'edit'])->name('admin.category.edit');
    Route::post('admin/deleteCategory{category}', [CategoryController::class, 'delete'])->name('admin.category.delete');

    Route::get('admin/products', [ProductController::class, 'index'])->name('admin.product');
    Route::post('admin/products', [ProductController::class, 'store'])->name('admin.product.store');
    Route::post('admin/editProduct{product}', [ProductController::class, 'edit'])->name('admin.product.edit');
    Route::post('admin/deleteProduct{product}', [ProductController::class, 'delete'])->name('admin.product.delete');

    Route::get('admin/orders', [AdminController::class, 'index'])->name('admin.order');
    Route::post('admin/orders/sort', [AdminController::class, 'index'])->name('admin.order.sort');
    Route::post('admin/orders/{orderId}/status/{action}', [AdminController::class, 'changeStatusOrder'])->name('admin.order.status');

});
