<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/productform', [ProductController::class, 'create'])->name('products.create');
Route::post('/addproduct', [ProductController::class, 'create'])->name('products.store');

Route::get('/products', [ProductController::class, 'index'])->name('products.display');
Route::get('/categories', [CategoryController::class, 'index'])->name('categories.display');

Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');

Route::get('/products/{product}/delete', [ProductController::class, 'delete'])->name('products.delete');


Route::get('/categoriesform', function () {
    return view('categoriesform');
})->name('categories.create');


Route::post('/addcategories', [CategoryController::class, 'create']);
Route::get('/category/{categories}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
Route::put('/category/{categories}', [CategoryController::class, 'update'])->name('categories.update');

Route::get('/products/{product}/delete', [ProductController::class, 'delete'])->name('products.delete');
Route::get('/categories/{categories}/delete', [CategoryController::class, 'delete'])->name('categories.delete');



