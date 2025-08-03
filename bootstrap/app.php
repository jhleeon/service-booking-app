<?php

use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\UserMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Route;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api/v1/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
        then: function() {
            Route::middleware(['auth:sanctum', 'admin'])
            ->prefix('api/v1/')
            ->name('admin.')
            ->group(base_path('routes/api/v1/admin.php'));

            Route::middleware(['auth:sanctum', 'user'])
            ->prefix('api/v1/')
            ->name('user.')
            ->group(base_path('routes/api/v1/user.php'));
        }
    )
    ->withMiddleware(function (Middleware $middleware): void {
         $middleware->alias([
            'admin' => AdminMiddleware::class,
            'user' => UserMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
