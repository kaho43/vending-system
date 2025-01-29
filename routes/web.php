<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Auth\LoginController;

Route::get('/', function () {
    return view('welcome');
});


// トップページ
Route::get('/', function () {
    return view('products.index');
    
});

Route::prefix('vending-system')->group(function () {
    // ここに他のルートを定義
    Route::get('/', [HomeController::class, 'index']);
});

// 認証ルート
Auth::routes();

// ログイン・ログアウト
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login')->middleware('guest');
Route::post('login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
Route::get('/products', [ProductController::class, 'index'])->name('products.index');

Route::post('/products', [ProductController::class, 'store'])->name('products.store');
Route::post('/products/create', [ProductController::class, 'store']);


Route::middleware('auth')->group(function () {
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    Route::resource('products', ProductController::class)->except(['create', 'store']);
});

