<?php

    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\ProductController;
    use App\Http\Controllers\Auth\LoginController;
    use App\Http\Controllers\PurchaseController;



    Route::get('/', function () {
        return view('welcome');
    });

    // トップページ
    Route::get('/', function () {
        return view('products.index');
    });

    // 認証ルート
    Auth::routes();

    // ログイン・ログアウト
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login')->middleware('guest');
    Route::post('login', [LoginController::class, 'login']);
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    // 商品管理ルート
    Route::middleware('auth')->group(function () {
        Route::get('/products', [ProductController::class, 'index'])->name('products.index');
        Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
        Route::post('/products', [ProductController::class, 'store'])->name('products.store');
        Route::get('/products/search', [ProductController::class, 'search'])->name('products.search');
        Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');
        Route::resource('products', ProductController::class)->except(['create', 'store']);
    });
