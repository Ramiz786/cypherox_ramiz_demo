<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;

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
    return redirect()->route('login');
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Category 
Route::middleware('auth')->prefix('category')->name('category.')->group(function(){
    Route::get('/', [CategoryController::class, 'index'])->name('index');
    Route::get('/create', [CategoryController::class, 'create'])->name('create');
    Route::post('/store', [CategoryController::class, 'store'])->name('store');
    Route::get('/edit/{category}', [CategoryController::class, 'edit'])->name('edit');
    Route::put('/update/{category}', [CategoryController::class, 'update'])->name('update');
    Route::delete('/delete/{category}', [CategoryController::class, 'delete'])->name('destroy');
    Route::post('/category-data',[CategoryController::class, "getDatatable"])->name('category-data');
    Route::post('/category-form',[CategoryController::class, "addForm"])->name('category-form');
    Route::post('/category-edit-form/{category}', [CategoryController::class, 'editForm'])->name('category-edit-form');
    Route::post('/destroy', [CategoryController::class, 'delete'])->name('destroy');
});
// Product 
Route::middleware('auth')->prefix('product')->name('product.')->group(function(){
    Route::get('/', [ProductController::class, 'index'])->name('index');
    Route::get('/create', [ProductController::class, 'create'])->name('create');
    Route::post('/store', [ProductController::class, 'store'])->name('store');
    Route::get('/edit/{product}', [ProductController::class, 'edit'])->name('edit');
    Route::put('/update/{product}', [ProductController::class, 'update'])->name('update');
    Route::delete('/delete/{product}', [ProductController::class, 'delete'])->name('destroy');
    Route::post('/product-data',[ProductController::class, "getDatatable"])->name('product-data');
    Route::post('/product-form',[ProductController::class, "addForm"])->name('product-form');
    Route::post('/product-edit-form/{product}', [ProductController::class, 'editForm'])->name('product-edit-form');
    Route::post('/destroy', [ProductController::class, 'delete'])->name('destroy');
});

// Users 
Route::middleware('auth')->prefix('users')->name('users.')->group(function(){
    Route::get('/', [UserController::class, 'index'])->name('index');
    Route::get('/create', [UserController::class, 'create'])->name('create');
    Route::post('/store', [UserController::class, 'store'])->name('store');
    Route::get('/edit/{user}', [UserController::class, 'edit'])->name('edit');
    Route::put('/update/{user}', [UserController::class, 'update'])->name('update');
    Route::post('/delete', [UserController::class, 'delete'])->name('destroy');
    Route::post('/destroy', [UserController::class, 'delete'])->name('destroy');
    Route::get('/update/status/{user_id}/{status}', [UserController::class, 'updateStatus'])->name('status');

    
    Route::get('/import-users', [UserController::class, 'importUsers'])->name('import');
    Route::post('/upload-users', [UserController::class, 'uploadUsers'])->name('upload');

    Route::get('/export', [UserController::class, 'export'])->name('export');
    Route::post('/users-data',[UserController::class, "getDatatable"])->name('users-data');
    Route::post('/users-form',[UserController::class, "addForm"])->name('users-form');
    Route::post('/users-edit-form/{user}', [UserController::class, 'editForm'])->name('users-edit-form');

});
