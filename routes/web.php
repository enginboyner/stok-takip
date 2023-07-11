<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckRole;

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


Route::get('/login', [AuthController::class, 'login'])->name('login');

Route::post('/login', [AuthController::class, 'loginControl'])->name('loginControl');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/forget', [AuthController::class, 'forget']);


Route::middleware(['auth'])->group(function () {


    Route::group(['prefix' => 'customers'], function () {

        Route::get('/', [CustomerController::class, 'index'])->name('customer');
        Route::get('/add', [CustomerController::class, 'add'])->name('customer.add');
        Route::post('/add', [CustomerController::class, 'store'])->name('customer.add2');
        Route::get('/edit/{id}', [CustomerController::class, 'edit'])->name('customer.edit');
        Route::post('/update/{id}', [CustomerController::class, 'update'])->name('customer.update');
    });

    Route::group(['prefix' => 'category'], function () {

        Route::get('/', [CategoryController::class, 'index'])->name('category');
        Route::get('/add', [CategoryController::class, 'add'])->name('category.add');
        Route::post('/add', [CategoryController::class, 'store'])->name('category.add2');
        Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
        Route::post('/update/{id}', [CategoryController::class, 'update'])->name('category.update');
    });

    Route::group(['prefix' => 'product', 'middleware' => ['roles:product']], function () {
        Route::get('/', [ProductController::class, 'index'])->name('product');
        Route::get('/add', [ProductController::class, 'add'])->name('product.add');
        Route::post('/add', [ProductController::class, 'store'])->name('product.add2');
        Route::get('/edit/{id}', [ProductController::class, 'edit'])->name('product.edit');
        Route::post('/update/{id}', [ProductController::class, 'update'])->name('product.update');
        Route::delete('/{id}', [ProductController::class,'delete'])->name('product.delete');
    });


    Route::group(['prefix' => 'sales', 'middleware' => ['roles:sales']], function () {
        Route::get('/', [SalesController::class, 'index'])->name('sales');
        Route::get('/add', [SalesController::class, 'add'])->name('sales.add');
        Route::post('/add', [SalesController::class, 'store'])->name('sales.add2');
        Route::get('/edit/{id}', [SalesController::class, 'edit'])->name('sales.edit');
        Route::post('/update/{id}', [SalesController::class, 'update'])->name('sales.update');


    });

    Route::group(['prefix' => 'stock', 'middleware' => ['roles:stock']], function () {
        Route::get('/', [StockController::class, 'index'])->name('stock');
        Route::get('/add', [StockController::class, 'add'])->name('stock.add');
        Route::post('/add', [StockController::class, 'store'])->name('stock.add2');
        Route::get('/edit/{id}', [StockController::class, 'edit'])->name('stock.edit');
        Route::post('/update/{id}', [StockController::class, 'update'])->name('stock.update');
    });


    Route::group(['prefix' => 'user', 'middleware' => ['roles:user']], function () {
        Route::get('/', [UserController::class, 'index'])->name('user');
        Route::get('/add', [UserController::class, 'add'])->name('user.add');
        Route::post('/add', [UserController::class, 'store'])->name('user.add2');
        Route::get('/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
        Route::post('/update/{id}', [UserController::class, 'update'])->name('user.update');
    });


    Route::get('/', [HomeController::class, 'index'])->name('home');


});









