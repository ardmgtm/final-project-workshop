<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

Route::get('/v1/products', [ProductController::class, 'index'])->name('products.index');
Route::post('/v1/products', [ProductController::class, 'store'])->name('products.store');
Route::get('/v1/products/{product}', [ProductController::class, 'get'])->name('products.get');
Route::get('/v1/categories', [CategoryController::class, 'index']);
Route::post('/v1/categories', [CategoryController::class, 'store']);

Route::post('/v1/inventory', [InventoryController::class, 'store'])->name('inventories.store');

Route::post('/v1/orders', [OrderController::class, 'store'])->name('orders.store');
Route::get('/v1/orders/{order}', [OrderController::class, 'get'])->name('orders.get');
