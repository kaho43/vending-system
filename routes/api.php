<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\PurchaseController;

Route::post('/purchase', [PurchaseController::class, 'store']);
Route::post('/products/search', [ProductController::class, 'search'])->name('products.search');
