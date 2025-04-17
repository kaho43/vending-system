<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SalesController;


Route::post('/purchase', [SaleController::class, 'purchase']);

use App\Http\Controllers\PurchaseController;

Route::post('/purchase', [PurchaseController::class, 'purchase']);
Route::post('/products/search', [ProductController::class, 'search'])->name('products.search');

