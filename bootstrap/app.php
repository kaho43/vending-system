<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Route;

$app = new Illuminate\Foundation\Application(
    $_ENV['APP_BASE_PATH'] ?? dirname(__DIR__)
);

return $app->configure(basePath: dirname(__DIR__))
    ->withRouting(function () use ($app) {
        // API ルートの設定
        Route::middleware('api')
             ->prefix('api')
             ->group(base_path('routes/api.php'));

        // Web ルートの設定
        Route::middleware('web')
             ->group(base_path('routes/web.php'));
    })
    ->withMiddleware(function (Middleware $middleware) {
        // 必要なミドルウェア設定があればここで追加
    })
    ->withExceptions(function (Exceptions $exceptions) {
        // 必要なエラーハンドリング設定があればここで追加
    })
    ->create();
