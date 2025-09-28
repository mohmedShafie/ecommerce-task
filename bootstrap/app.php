<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Route;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        using: function () {
            Route::prefix('api')
                ->group(base_path('routes/Api/api.php'));

            Route::middleware(['web' , 'lang'])
                ->group(base_path('routes/web.php'));

            Route::middleware(['web' , 'lang'])
                ->group(base_path('routes/Web/admin.php'));
        },
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // Load middleware from separate files
        $adminMiddleware = require __DIR__.'/middleware/admin.php';
        $customerMiddleware = require __DIR__.'/middleware/customer.php';
        $languageMiddleware = require __DIR__.'/middleware/language.php';
        $publicMiddleware = require __DIR__.'/middleware/public.php';

        // Merge all middleware aliases
        $allMiddleware = array_merge(
            $adminMiddleware,
            $customerMiddleware,
            $languageMiddleware,
            $publicMiddleware
        );

        $middleware->alias($allMiddleware);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(function (\Illuminate\Auth\AuthenticationException $e, $request) {
            if ($request->is('api/*')) {
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthenticated',
                    'data' => null
                ], 401);
            }
        });
    })
    ->create();
