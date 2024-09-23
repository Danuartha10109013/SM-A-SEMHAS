<?php

use App\Http\Controllers\CraneController;
use App\Http\Controllers\DashboardControlller;
use App\Http\Controllers\ForkliftController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ShippmentA;
use App\Http\Controllers\ShippmentB;
use App\Http\Controllers\ShippmentC;
use App\Http\Controllers\ShippmentD;
use App\Http\Controllers\TraillerController;
use App\Http\Middleware\AutoLogout;
use Illuminate\Support\Facades\Route;

Route::get('/', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'proses'])->name('login-proses');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

use Illuminate\Support\Facades\Response;

Route::get('/download/{file}', function($file) {
    $filePath = public_path($file);

    if (file_exists($filePath)) {
        return Response::download($filePath);
    } else {
        abort(404, 'File not found.');
    }
})->name('download.file');

Route::get('/download-report/{id}', [CraneController::class, 'downloadReport'])->name('download.report');



Route::middleware([AutoLogout::class])->group(function () {

    // Ship-Mark
    Route::group(['prefix' => 'Ship-Mark', 'middleware' => ['Ship-Mark'], 'as' => 'Ship-Mark.'], function () {


        Route::group(['prefix' => 'admin', 'middleware' => ['admin'], 'as' => 'admin.'], function () {

            Route::get('/',[DashboardControlller::class, 'index'])->name('dashboard');

        });

        // Pegawai routes group with middleware and prefix
        Route::group(['prefix' => 'pegawai', 'middleware' => ['pegawai'], 'as' => 'pegawai.'], function () {

            Route::get('/',[DashboardControlller::class, 'index'])->name('dashboard');

            //A
            Route::prefix('ShipmentA')->group(function () {
                Route::get('/',[ShippmentA::class,'index'])->name('shipment-a');
                Route::get('/add',[ShippmentA::class,'add'])->name('shipment-a-add');
                Route::post('/store',[ShippmentA::class,'storea'])->name('shipment-a-store');
                Route::get('/edit/{id}',[ShippmentA::class,'edit'])->name('shipment-a-edit');
                Route::put('/update/{id}',[ShippmentA::class,'update'])->name('shipment-a-update');
                Route::get('/delete/{id}',[ShippmentA::class,'destroy'])->name('shipment-a-delete');
                Route::delete('/deleteA/{type}',[ShippmentA::class,'destroyA'])->name('shipment-a-deleteA');
                Route::get('/show/{id}',[ShippmentA::class,'show'])->name('shipment-a-show');
                Route::get('/print/{id}',[ShippmentA::class,'print'])->name('shipment-a-print');
                Route::get('/printone/{id}',[ShippmentA::class,'printone'])->name('shipment-a-printone');
                Route::post('/add-excel-a',[ShippmentA::class,'store'])->name('add-shippmenta-excel');
            });
            //B
            Route::prefix('ShipmentB')->group(function () {
                Route::get('/',[ShippmentB::class,'index'])->name('shipment-b');
                Route::get('/add',[ShippmentB::class,'add'])->name('shipment-b-add');
                Route::post('/store',[ShippmentB::class,'storea'])->name('shipment-b-store');
                Route::get('/edit/{id}',[ShippmentB::class,'edit'])->name('shipment-b-edit');
                Route::put('/update/{id}',[ShippmentB::class,'update'])->name('shipment-b-update');
                Route::get('/delete/{id}',[ShippmentB::class,'destroy'])->name('shipment-b-delete');
                Route::delete('/deleteA/{type}',[ShippmentB::class,'destroyA'])->name('shipment-b-deleteA');
                Route::get('/show/{id}',[ShippmentB::class,'show'])->name('shipment-b-show');
                Route::get('/print/{id}',[ShippmentB::class,'print'])->name('shipment-b-print');
                Route::get('/printone/{id}',[ShippmentB::class,'printone'])->name('shipment-b-printone');
                Route::post('/add-excel-a',[ShippmentB::class,'store'])->name('add-shippmentb-excel');
            });
            //C
            Route::prefix('ShipmentC')->group(function () {
                Route::get('/',[ShippmentC::class,'index'])->name('shipment-c');
                Route::get('/add',[ShippmentC::class,'add'])->name('shipment-c-add');
                Route::post('/store',[ShippmentC::class,'storea'])->name('shipment-c-store');
                Route::get('/edit/{id}',[ShippmentC::class,'edit'])->name('shipment-c-edit');
                Route::put('/update/{id}',[ShippmentC::class,'update'])->name('shipment-c-update');
                Route::get('/delete/{id}',[ShippmentC::class,'destroy'])->name('shipment-c-delete');
                Route::delete('/deleteA/{type}',[ShippmentC::class,'destroyA'])->name('shipment-c-deleteA');
                Route::get('/show/{id}',[ShippmentC::class,'show'])->name('shipment-c-show');
                Route::get('/print/{id}',[ShippmentC::class,'print'])->name('shipment-c-print');
                Route::get('/printone/{id}',[ShippmentC::class,'printone'])->name('shipment-c-printone');
                Route::post('/add-excel-a',[ShippmentC::class,'store'])->name('add-shippmentc-excel');
            });
            //D
            Route::prefix('ShipmentD')->group(function () {
                Route::get('/',[ShippmentD::class,'index'])->name('shipment-d');
                Route::get('/add',[ShippmentD::class,'add'])->name('shipment-d-add');
                Route::post('/store',[ShippmentD::class,'storea'])->name('shipment-d-store');
                Route::get('/edit/{id}',[ShippmentD::class,'edit'])->name('shipment-d-edit');
                Route::put('/update/{id}',[ShippmentD::class,'update'])->name('shipment-d-update');
                Route::get('/delete/{id}',[ShippmentD::class,'destroy'])->name('shipment-d-delete');
                Route::delete('/deleteA/{type}',[ShippmentD::class,'destroyA'])->name('shipment-d-deleteA');
                Route::get('/show/{id}',[ShippmentD::class,'show'])->name('shipment-d-show');
                Route::get('/print/{id}',[ShippmentD::class,'print'])->name('shipment-d-print');
                Route::get('/printone/{id}',[ShippmentD::class,'printone'])->name('shipment-d-printone');
                Route::post('/add-excel-a',[ShippmentD::class,'store'])->name('add-shippmentd-excel');
            });


            
        });
    });

    // Form-Check
    Route::group(['prefix' => 'Form-Check', 'middleware' => ['Form-Check'], 'as' => 'Form-Check.'], function () {

        //admin
        Route::group(['prefix' => 'admin', 'middleware' => ['admin'], 'as' => 'admin.'], function () {
            //dashboard admin
            Route::get('/',[DashboardControlller::class, 'fcindex'])->name('dashboard');
            //crane
            Route::prefix('crane')->group(function () {
                Route::get('/', [CraneController::class, 'index'])->name('crane');
                Route::get('/add', [CraneController::class, 'add'])->name('crane.add');
                Route::post('/create', [CraneController::class, 'create'])->name('crane.create');
                Route::get('/print/{id}', [CraneController::class, 'print'])->name('crane.print');

            });
            //foklift
            Route::prefix('forklift')->group(function () {
                Route::get('/', [ForkliftController::class, 'index'])->name('forklift');
                Route::get('/add', [ForkliftController::class, 'add'])->name('forklift.add');
                Route::post('/create', [ForkliftController::class, 'create'])->name('forklift.create');
                Route::get('/print/{id}', [ForkliftController::class, 'print'])->name('forklift.print');
            });

            //trailler
            Route::prefix('trailler')->group(function () {
                Route::get('/', [TraillerController::class, 'index'])->name('trailler');
                Route::get('/add', [TraillerController::class, 'add'])->name('trailler.add');
                Route::post('/create', [TraillerController::class, 'create'])->name('trailler.create');
                Route::get('/print/{id}', [TraillerController::class, 'print'])->name('trailler.print');
            });
        });

        // Pegawai routes group with middleware and prefix
        Route::group(['prefix' => 'pegawai', 'middleware' => ['pegawai'], 'as' => 'pegawai.'], function () {

            Route::get('/',[DashboardControlller::class, 'index'])->name('dashboard');
  
        });
    });

//endautologout
});
