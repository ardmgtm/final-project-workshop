<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductInventoryController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

Route::post('/v1/products', [ProductController::class, 'store']);
Route::get('/v1/products', [ProductController::class, 'index']);
Route::get('/v1/products/{product}', [ProductController::class, 'get']);
Route::get('/v1/categories', [CategoryController::class, 'index']);
Route::post('/v1/categories', [CategoryController::class, 'store']);

Route::post('/v1/inventory', [InventoryController::class, 'store']);
Route::get('/v1/inventory/products', [ProductInventoryController::class, 'index']);
Route::get('/v1/inventory/products/{product}', [ProductInventoryController::class, 'get']);

Route::post('/v1/orders', [OrderController::class, 'store']);
Route::get('/v1/orders/{order}', [OrderController::class, 'get']);
