<?php

use App\Http\Controllers\DashboardControlller;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ShippmentA;
use App\Http\Controllers\ShippmentB;
use App\Http\Middleware\AutoLogout;
use Illuminate\Support\Facades\Route;

Route::get('/', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'proses'])->name('login-proses');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');


Route::middleware([AutoLogout::class])->group(function () {

    // Admin routes group with middleware and prefix
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


        
    });
});
