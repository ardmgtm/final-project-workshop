<?php
use Illuminate\Support\Facades\Route;

Route::resource('v1/products', \App\Http\Controllers\ProductController::class);
Route::resource('v1/inventories', \App\Http\Controllers\InventoryController::class);
Route::resource('v1/orders', \App\Http\Controllers\OrderController::class);
