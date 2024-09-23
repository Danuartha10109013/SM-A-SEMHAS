<?php

use App\Http\Middleware\Adminmiddleware;
use App\Http\Middleware\CheckType;
use App\Http\Middleware\CheckTypeFC;
use App\Http\Middleware\PegawaiMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // Group for Ship-Mark users
        $middleware->appendToGroup('Ship-Mark', [
            CheckType::class,
        ]);
        
        // Additional middleware for admin under Ship-Mark group
        $middleware->appendToGroup('admin', [
            AdminMiddleware::class,
        ]);
    
        // Additional middleware for pegawai under Ship-Mark group
        $middleware->appendToGroup('pegawai', [
            PegawaiMiddleware::class,
        ]);
    
        // Group for Form-Check users
        $middleware->appendToGroup('Form-Check', [
            CheckTypeFC::class,
        ]);
    
        // Additional middleware for admin under Form-Check group
        $middleware->appendToGroup('admin', [
            AdminMiddleware::class,
        ]);
    
        // Additional middleware for pegawai under Form-Check group
        $middleware->appendToGroup('pegawai', [
            PegawaiMiddleware::class,
        ]);
    })
    
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
