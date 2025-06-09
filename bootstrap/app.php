<?php

use App\Http\Middleware\Adminmiddleware;
use App\Http\Middleware\CheckCoilD;
use App\Http\Middleware\CheckL08;
use App\Http\Middleware\CheckList;
use App\Http\Middleware\CheckSupp;
use App\Http\Middleware\CheckType;
use App\Http\Middleware\CheckTypeADM;
use App\Http\Middleware\CheckTypeFC;
use App\Http\Middleware\CheckTypeK;
use App\Http\Middleware\CheckTypeMM;
use App\Http\Middleware\CheckTypeOP;
use App\Http\Middleware\PegawaiMiddleware;
use App\Http\Middleware\RunScheduler;
use App\Http\Middleware\ScanLayout;
use App\Http\Middleware\SuperAdmin;
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

         $middleware->append(RunScheduler::class);
         
        // Group for Ship-Mark users
        $middleware->appendToGroup('Ship-Mark', [
            CheckType::class,
        ]);
        
        $middleware->appendToGroup('admin', [
            AdminMiddleware::class,
        ]);
        $middleware->appendToGroup('superadmin', [
            SuperAdmin::class,
        ]);
        $middleware->appendToGroup('Administrator', [
            CheckTypeADM::class,
        ]);
        $middleware->appendToGroup('pegawai', [
            PegawaiMiddleware::class,
        ]);
    
        //Form-Check
        $middleware->appendToGroup('Form-Check', [
            CheckTypeFC::class,
        ]);
    
        $middleware->appendToGroup('admin', [
            AdminMiddleware::class,
        ]);
    
        $middleware->appendToGroup('pegawai', [
            PegawaiMiddleware::class,
        ]);

        //Mapping Muat 
        $middleware->appendToGroup('Mapping', [
            CheckTypeMM::class,
        ]);
    
        $middleware->appendToGroup('admin', [
            AdminMiddleware::class,
        ]);
    
        $middleware->appendToGroup('pegawai', [
            PegawaiMiddleware::class,
        ]);

        //Open-Packing
        $middleware->appendToGroup('Open-Packing', [
            CheckTypeOP::class,
        ]);
    
        $middleware->appendToGroup('admin', [
            AdminMiddleware::class,
        ]);
    
        $middleware->appendToGroup('pegawai', [
            PegawaiMiddleware::class,
        ]);

        //Supply
        $middleware->appendToGroup('Supply', [
            CheckSupp::class,
        ]);
    
        $middleware->appendToGroup('admin', [
            AdminMiddleware::class,
        ]);
    
        $middleware->appendToGroup('pegawai', [
            PegawaiMiddleware::class,
        ]);

        //Packing-List
        $middleware->appendToGroup('Packing-List', [
            CheckList::class,
        ]);
    
        $middleware->appendToGroup('admin', [
            AdminMiddleware::class,
        ]);
    
        $middleware->appendToGroup('pegawai', [
            PegawaiMiddleware::class,
        ]);
        //Kendaran ck
        $middleware->appendToGroup('Kendaraan', [
            CheckTypeK::class,
        ]);
    
        $middleware->appendToGroup('admin', [
            AdminMiddleware::class,
        ]);
    
        $middleware->appendToGroup('pegawai', [
            PegawaiMiddleware::class,
        ]);
        //Scan Lyout
        $middleware->appendToGroup('Scan-Layout', [
            ScanLayout::class,
        ]);
    
        $middleware->appendToGroup('admin', [
            AdminMiddleware::class,
        ]);
        //Coil-Damage
        $middleware->appendToGroup('Coil-Damage', [
            CheckCoilD::class,
        ]);
    
        $middleware->appendToGroup('admin', [
            AdminMiddleware::class,
        ]);
    
        $middleware->appendToGroup('pegawai', [
            PegawaiMiddleware::class,
        ]);
        //L-08
        $middleware->appendToGroup('L-08', [
            CheckL08::class,
        ]);
    
        $middleware->appendToGroup('admin', [
            AdminMiddleware::class,
        ]);
    
        $middleware->appendToGroup('pegawai', [
            PegawaiMiddleware::class,
        ]);
        //Administrator
        
        
    })
    
    ->withExceptions(function (Exceptions $exceptions) {
        
    })->create();

    $app->singleton(
        Illuminate\Contracts\Debug\ExceptionHandler::class,
        App\Exceptions\Handler::class
    );
    