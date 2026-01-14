<?php

use App\Http\Middleware\CheckLevel as FrontendLevel;
use App\Http\Middleware\Api\CheckLevel as ApiLevel;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        api: __DIR__.'/../routes/api.php',
        apiPrefix: 'api',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'level' => FrontendLevel::class,
            'apiLevel' => ApiLevel::class
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
