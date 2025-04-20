<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\ProductController;

// APIルートの設定
Route::middleware('api')->group(function () {
    Route::post('/purchase', [PurchaseController::class, 'purchase']);
    Route::post('/products/search', [ProductController::class, 'search'])->name('products.search');
    // 他のAPI関連ルート
});
