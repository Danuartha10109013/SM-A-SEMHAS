<?php

use App\Http\Controllers\CoilController;
use App\Http\Controllers\CoilDamageController;
use App\Http\Controllers\CraneController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DashboardControlller;
use App\Http\Controllers\DataMasterController;
use App\Http\Controllers\EUPController;
use App\Http\Controllers\ForkliftController;
use App\Http\Controllers\InputDataExcel;
use App\Http\Controllers\KendaraanController;
use App\Http\Controllers\KUserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MappingController;
use App\Http\Controllers\MappingTrukController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\OpenPackController;
use App\Http\Controllers\PackingL08Controller;
use App\Http\Controllers\PListController;
use App\Http\Controllers\PrintController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RekapController;
use App\Http\Controllers\ScanLayoutController;
use App\Http\Controllers\ShippmentA;
use App\Http\Controllers\ShippmentB;
use App\Http\Controllers\ShippmentC;
use App\Http\Controllers\ShippmentD;
use App\Http\Controllers\ShippmentE;
use App\Http\Controllers\SIKController;
use App\Http\Controllers\SupplyController;
use App\Http\Controllers\TraillerController;
use App\Http\Middleware\AutoLogout;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Response;

Route::get('/scheduler-run', function () {
    Artisan::call('schedule:run');
    return 'Scheduler executed at ' . now();
});
Route::get('/country-data/{negara}', function ($negara) {
    $negara = strtolower($negara);
    $count = 0;

    $count += ShippmentA::whereRaw('LOWER(destination) LIKE ?', ["%$negara%"])->count();
    $count += ShippmentB::whereRaw('LOWER(destination) LIKE ?', ["%$negara%"])->count();
    $count += ShippmentC::whereRaw('LOWER(pod) LIKE ?', ["%$negara%"])->count();
    $count += ShippmentD::whereRaw('LOWER(destination) LIKE ?', ["%$negara%"])->count();
    $count += ShippmentE::whereRaw('LOWER(pod) LIKE ?', ["%$negara%"])->count();

    return response()->json(['negara' => $negara, 'total' => $count]);
});

Route::get('/', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'proses'])->name('login-proses');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::prefix('Surat-Izin-Keluar')->group(function () {
    Route::get('/',[SIKController::class,'index'])->name('sik');
    Route::get('/add',[SIKController::class,'add'])->name('sik.add');
    Route::post('/store',[SIKController::class,'store'])->name('sik.store');
    Route::get('/delete/{id}',[SIKController::class,'delete'])->name('sik.delete');
    Route::get('/edit/{id}',[SIKController::class,'edit'])->name('sik.edit');
    Route::post('/update/{id}',[SIKController::class,'update'])->name('sik.update');
    Route::get('/print/{id}',[SIKController::class,'print'])->name('sik.print');
    Route::get('/export',[SIKController::class,'export'])->name('sik.export');
});
Route::prefix('Pemberi-Izin')->group(function () {
    Route::get('/',[SIKController::class,'pemberi_izin'])->name('pemberi-izin');
    Route::get('/setujui/{id}',[SIKController::class,'pemberi_izin_add'])->name('pemberi-izin.setujui');
    Route::post('/store/{id}',[SIKController::class,'pemberi_izin_store'])->name('pemberi-izin.store');
});
Route::prefix('Security')->group(function () {
    Route::get('/',[SIKController::class,'security'])->name('security');
    Route::get('/setujui/{id}',[SIKController::class,'setujui'])->name('security.setujui');
    Route::post('/store',[SIKController::class,'setujui_store'])->name('security.store');
});

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
    
    Route::get('/welcome', [LoginController::class, 'welcome'])->name('welcome');

    //Profile 
    Route::prefix('profile')->group(function () {
        Route::get('/{id}',[ProfileController::class,'index'])->name('profile');
        Route::put('/update/{id}',[ProfileController::class,'update'])->name('update-profile');
    });

    Route::group(['prefix' => 'superadmin', 'middleware' => ['superadmin'], 'as' => 'superadmin.'], function () {

        Route::group(['prefix' => 'Administrator', 'middleware' => ['Administrator'], 'as' => 'Administrator.'], function () {

            Route::get('k-user',[KUserController::class,'index'])->name('kelola-user');
            Route::get('k-user/add',[KUserController::class,'add'])->name('kelola-user.add');
            Route::get('k-user/print',[KUserController::class,'print'])->name('kelola-user.print');
            Route::post('k-user/store',[KUserController::class,'store'])->name('kelola-user.store');
            Route::get('k-user/edit/{id}',[KUserController::class,'edit'])->name('kelola-user.edit');
            Route::put('k-user/update/{id}',[KUserController::class,'update'])->name('kelola-user.update');
            Route::delete('k-user/delete/{id}',[KUserController::class,'destroy'])->name('kelola-user.delete');
        });
        Route::prefix('data-master')->group(function () {
            Route::get('/',[DataMasterController::class,'index'])->name('data-master');
            Route::post('/shifts/store', [DataMasterController::class, 'store'])->name('shifts.store');
            Route::patch('/shifts/update/{id}', [DataMasterController::class, 'update'])->name('shifts.update');
            Route::delete('/shifts/delete/{id}', [DataMasterController::class, 'destroy'])->name('shifts.delete');
            Route::name('teamlead.')->group(function () {
                Route::post('/', [DataMasterController::class, 'storetl'])->name('store');
                Route::patch('/{id}', [DataMasterController::class, 'updatetl'])->name('update');
                Route::delete('/{id}', [DataMasterController::class, 'destroytl'])->name('destroy');
            });

            Route::prefix('form-check')->group(function () {
                Route::get('/',[DataMasterController::class,'indexfc'])->name('form-check');
                Route::prefix('kapasitas')->name('kapasitas.')->group(function () {
                    Route::post('/store', [DataMasterController::class, 'storekap'])->name('store');
                    Route::patch('/update/{id}', [DataMasterController::class, 'updatekap'])->name('update');
                    Route::delete('/delete/{id}', [DataMasterController::class, 'deletekap'])->name('delete');
                });
                Route::prefix('trailer')->name('trailer.')->group(function () {
                    Route::post('/store', [DataMasterController::class, 'storetr'])->name('store');
                    Route::patch('/update/{id}', [DataMasterController::class, 'updatetr'])->name('update');
                    Route::delete('/delete/{id}', [DataMasterController::class, 'destroytr'])->name('delete');
                });
                Route::prefix('kondisi')->name('kondisi.')->group(function () {
                    Route::get('/', [DataMasterController::class, 'indexko'])->name('kondisi');
                    Route::post('/store', [DataMasterController::class, 'storeko'])->name('store');
                    Route::patch('/update/{id}', [DataMasterController::class, 'updateko'])->name('update');
                    Route::delete('/delete/{id}', [DataMasterController::class, 'destroyko'])->name('delete');
                });
                Route::prefix('division')->name('division.')->group(function () {
                    Route::get('/', [DataMasterController::class, 'indexdi'])->name('division');
                    Route::post('/store', [DataMasterController::class, 'storedi'])->name('store');
                    Route::put('/update/{id}', [DataMasterController::class, 'updatedi'])->name('update');
                    Route::delete('/delete/{id}', [DataMasterController::class, 'destroydi'])->name('delete');
                });
                
            });
            Route::prefix('Open-Packing')->group(function () {
                Route::get('/Open-Packing',[DataMasterController::class,'openPacking'])->name('data-master.Open-Packing');
                
            });
        });

    });

    // Ship-Mark
    Route::group(['prefix' => 'Ship-Mark', 'middleware' => ['Ship-Mark'], 'as' => 'Ship-Mark.'], function () {


        Route::group(['prefix' => 'admin', 'middleware' => ['admin'], 'as' => 'admin.'], function () {

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
            //E
            Route::prefix('ShipmentE')->group(function () {
                Route::get('/',[ShippmentE::class,'index'])->name('shipment-e');
                Route::get('/add',[ShippmentE::class,'add'])->name('shipment-e-add');
                Route::post('/store',[ShippmentE::class,'storea'])->name('shipment-e-store');
                Route::get('/edit/{id}',[ShippmentE::class,'edit'])->name('shipment-e-edit');
                Route::put('/update/{id}',[ShippmentE::class,'update'])->name('shipment-e-update');
                Route::get('/delete/{id}',[ShippmentE::class,'destroy'])->name('shipment-e-delete');
                Route::delete('/deleteA/{type}',[ShippmentE::class,'destroyA'])->name('shipment-e-deleteA');
                Route::get('/show/{id}',[ShippmentE::class,'show'])->name('shipment-e-show');
                Route::get('/print/{id}',[ShippmentE::class,'print'])->name('shipment-e-print');
                Route::get('/printone/{id}',[ShippmentE::class,'printone'])->name('shipment-e-printone');
                Route::post('/add-excel-a',[ShippmentE::class,'store'])->name('add-shippmente-excel');
            });
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

    // Mapping Container & Trailler
    Route::group(['prefix' => 'Mapping', 'middleware' => ['Mapping'], 'as' => 'Mapping.'], function () {
        //admin
        Route::group(['prefix' => 'admin', 'middleware' => ['admin'], 'as' => 'admin.'], function () {
           
            Route::prefix('shipment')->group(function () {
                Route::get('/', [DashboardController::class, 'index'])->name('shipment');
                Route::get('/shipment/{id}', [DashboardController::class, 'show'])->name('show-shipment');
                Route::get('/delete/{id}', [DashboardController::class, 'destroy'])->name('delete-shipment');
                Route::get('shipmentcreate/{gs}', [DashboardController::class, 'create'])->name('create-shipment');
                Route::post('shipmentcreated', [DashboardController::class, 'store'])->name('store-shipment');
            });

            
            Route::prefix('mapping')->group(function () {
                Route::get('/mapping/{id}', [MappingController::class, 'index'])->name('maping-shipment');
                Route::get('/mapping-truk/{id}', [MappingTrukController::class, 'index'])->name('maping-shipment-truk');
            });
            Route::prefix('coil')->group(function () {
                Route::get('/coil', [CoilController::class, 'indexs'])->name('coil');
                Route::get('/coiling/{no_gs}', [CoilController::class, 'index'])->name('coiling');
                Route::get('/tambah/coil/add/{no_gs}', [CoilController::class, 'create'])->name('tambahcoil');
                Route::post('/tambah/coil/store', [CoilController::class, 'store'])->name('koil.store');
            });
            Route::prefix('mapping-truck')->group(function () {
                Route::post('/store-truck/{no_gs}', [MappingTrukController ::class, 'store'])->name('store-data-truck');
                Route::post('/store/{no_gs}', [MappingController::class, 'store'])->name('store-data');
                // Route::get('/print/{id}', [PrintController::class, 'print'])->name('print');
                Route::get('/print/{id}', [PrintController::class, 'view_pdf'])->name('print');
                Route::get('/print/{id}', [PrintController::class, 'downloadPDF'])->name('print.pdf');
                Route::get('/prints/{id}', [PrintController::class, 'print'])->name('prints-map');
                Route::get('/prints-truck/{id}', [PrintController::class, 'printtruck'])->name('prints');
            });
            // Input Data Excelx
            Route::prefix('input-excel')->group(function () {
                Route::get('/input-excel', [InputDataExcel::class, 'index'])->name('input-excel');
                Route::post('/upload-excel', [InputDataExcel::class, 'store'])->name('upload-excel');
                Route::post('/upload-koil-excel', [InputDataExcel::class, 'storekoil'])->name('upload-koil-excel');
            });
            
        });

        //pegawai
        Route::group(['prefix' => 'pegawai', 'middleware' => ['pegawai'], 'as' => 'pegawai.'], function () {
            
            Route::prefix('shipment')->group(function () {
                Route::get('/', [DashboardController::class, 'index'])->name('shipment');
                Route::get('/shipment/{id}', [DashboardController::class, 'show'])->name('show-shipment');
                Route::get('/delete/{id}', [DashboardController::class, 'destroy'])->name('delete-shipment');
                Route::get('shipmentcreate', [DashboardController::class, 'create'])->name('create-shipment');
                Route::post('shipmentcreated', [DashboardController::class, 'store'])->name('store-shipment');
            });
            Route::prefix('mapping')->group(function () {
                Route::get('/mapping/{id}', [MappingController::class, 'index'])->name('maping-shipment');
                Route::get('/mapping-truk/{id}', [MappingTrukController::class, 'index'])->name('maping-shipment-truk');
            });
            Route::prefix('coil')->group(function () {
                Route::get('/coil', [CoilController::class, 'indexs'])->name('coil');
                Route::get('/coiling/{no_gs}', [CoilController::class, 'index'])->name('coiling');
                Route::get('/tambah/coil/{no_gs}', [CoilController::class, 'create'])->name('tambahcoil');
                Route::post('/tambah/coil/store', [CoilController::class, 'store'])->name('koil.store');
            });
            Route::prefix('mapping-truck')->group(function () {
                Route::post('/store-truck/{no_gs}', [MappingTrukController ::class, 'store'])->name('store-data-truck');
                Route::post('/store/{no_gs}', [MappingController::class, 'store'])->name('store-data');
                // Route::get('/print/{id}', [PrintController::class, 'print'])->name('print');
                Route::get('/print/{id}', [PrintController::class, 'view_pdf'])->name('print');
                Route::get('/prints/{id}', [PrintController::class, 'print'])->name('prints-map');
                Route::get('/prints-truck/{id}', [PrintController::class, 'printtruck'])->name('prints');
            });
            // Input Data Excelx
            Route::prefix('input-excel')->group(function () {
                Route::get('/input-excel', [InputDataExcel::class, 'index'])->name('input-excel');
                Route::post('/upload-excel', [InputDataExcel::class, 'store'])->name('upload-excel');
                Route::post('/upload-koil-excel', [InputDataExcel::class, 'storekoil'])->name('upload-koil-excel');
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
                Route::get('/show/{id}', [CraneController::class, 'show'])->name('crane.show');
                Route::delete('/destroy/{id}', [CraneController::class, 'destroy'])->name('crane.destroy');
                Route::get('/export',[CraneController::class, 'exportexcel'])->name('crane.export');


            });
            //foklift
            Route::prefix('forklift')->group(function () {
                Route::get('/', [ForkliftController::class, 'index'])->name('forklift');
                Route::get('/add', [ForkliftController::class, 'add'])->name('forklift.add');
                Route::post('/create', [ForkliftController::class, 'create'])->name('forklift.create');
                Route::get('/print/{id}', [ForkliftController::class, 'print'])->name('forklift.print');
                Route::get('/show/{id}', [ForkliftController::class, 'show'])->name('forklift.show');
                Route::delete('/destroy/{id}', [ForkliftController::class, 'destroy'])->name('forklift.destroy');
                Route::get('/export',[ForkliftController::class, 'exportexcel'])->name('forklift.export');

            });

            //trailler
            Route::prefix('trailler')->group(function () {
                Route::get('/', [TraillerController::class, 'index'])->name('trailler');
                Route::get('/add', [TraillerController::class, 'add'])->name('trailler.add');
                Route::post('/create', [TraillerController::class, 'create'])->name('trailler.create');
                Route::get('/print/{id}', [TraillerController::class, 'print'])->name('trailler.print');
                Route::get('/show/{id}', [TraillerController::class, 'show'])->name('trailler.show');
                Route::delete('/destroy/{id}', [TraillerController::class, 'destroy'])->name('trailler.destroy');
                Route::get('/export', [TraillerController::class, 'export'])->name('trailler.export');

            });
            
            //Eup
            Route::prefix('eup')->group(function () {
                Route::get('/', [EUPController::class, 'index'])->name('eup');
                Route::get('/add', [EUPController::class, 'add'])->name('eup.add');
                Route::post('/create', [EUPController::class, 'create'])->name('eup.create');
                Route::get('/print/{id}', [EUPController::class, 'print'])->name('eup.print');
                Route::get('/export', [EUPController::class, 'export'])->name('eup.export');
                Route::get('/show/{id}', [EUPController::class, 'show'])->name('eup.show');    
                Route::delete('/destroy/{id}', [EUPController::class, 'destroy'])->name('eup.destroy');  
            });

            //material
            Route::prefix('material')->group(function () {
                Route::prefix('crc')->group(function () {
                    Route::get('/', [MaterialController::class, 'index_crc'])->name('crc');
                    Route::get('/add', [MaterialController::class, 'add_crc'])->name('crc.add');
                    Route::get('/export', [MaterialController::class, 'crc_export'])->name('crc.export');
                    Route::post('/create', [MaterialController::class, 'create_crc'])->name('crc.create');
                    Route::get('/print/{id}', [MaterialController::class, 'print_crc'])->name('crc.print');    
                    Route::get('/show/{id}', [MaterialController::class, 'show_crc'])->name('crc.show');    
                    Route::delete('/destroy/{id}', [MaterialController::class, 'destroy_crc'])->name('crc.destroy');  
                    
                });
                Route::prefix('ingot')->group(function () {
                    Route::get('/', [MaterialController::class, 'index_ingot'])->name('ingot');
                    Route::get('/add', [MaterialController::class, 'add_ingot'])->name('ingot.add');
                    Route::get('/export', [MaterialController::class, 'ingot_export'])->name('ingot.export');
                    Route::post('/create', [MaterialController::class, 'create_ingot'])->name('ingot.create');
                    Route::get('/print/{id}', [MaterialController::class, 'print_ingot'])->name('ingot.print');   
                    Route::get('/show/{id}', [MaterialController::class, 'show_ingot'])->name('ingot.show');    
                    Route::delete('/destroy/{id}', [MaterialController::class, 'destroy_ingot'])->name('ingot.destroy');  
                    
                    
                });
                Route::prefix('resin')->group(function () {
                    Route::get('/', [MaterialController::class, 'index_resin'])->name('resin');
                    Route::get('/add', [MaterialController::class, 'add_resin'])->name('resin.add');
                    Route::get('/export', [MaterialController::class, 'resin_export'])->name('resin.export');
                    Route::post('/create', [MaterialController::class, 'create_resin'])->name('resin.create');
                    Route::get('/print/{id}', [MaterialController::class, 'print_resin'])->name('resin.print');  
                    Route::get('/show/{id}', [MaterialController::class, 'show_resin'])->name('resin.show');    
                    Route::delete('/destroy/{id}', [MaterialController::class, 'destroy_resin'])->name('resin.destroy');  
                });
            });

        });

        // Pegawai routes group with middleware and prefix
        Route::group(['prefix' => 'pegawai', 'middleware' => ['pegawai'], 'as' => 'pegawai.'], function () {

            Route::get('/',[DashboardControlller::class, 'fc_pegawai'])->name('dashboard');
            
            //crane
            Route::prefix('crane')->group(function () {
                Route::get('/', [CraneController::class, 'index'])->name('crane');
                Route::get('/add', [CraneController::class, 'add'])->name('crane.add');
                Route::post('/create', [CraneController::class, 'create'])->name('crane.create');
                Route::get('/print/{id}', [CraneController::class, 'print'])->name('crane.print');
                Route::get('/show/{id}', [CraneController::class, 'show'])->name('crane.show');


            });
            //foklift
            Route::prefix('forklift')->group(function () {
                Route::get('/', [ForkliftController::class, 'index'])->name('forklift');
                Route::get('/add', [ForkliftController::class, 'add'])->name('forklift.add');
                Route::post('/create', [ForkliftController::class, 'create'])->name('forklift.create');
                Route::get('/print/{id}', [ForkliftController::class, 'print'])->name('forklift.print');
                Route::get('/show/{id}', [ForkliftController::class, 'show'])->name('forklift.show');

            });

            //trailler
            Route::prefix('trailler')->group(function () {
                Route::get('/', [TraillerController::class, 'index'])->name('trailler');
                Route::get('/add', [TraillerController::class, 'add'])->name('trailler.add');
                Route::post('/create', [TraillerController::class, 'create'])->name('trailler.create');
                Route::get('/print/{id}', [TraillerController::class, 'print'])->name('trailler.print');
                Route::get('/show/{id}', [TraillerController::class, 'show'])->name('trailler.show');

            });

            //material
            Route::prefix('material')->group(function () {
                Route::prefix('crc')->group(function () {
                    Route::get('/', [MaterialController::class, 'index_crc'])->name('crc');
                    Route::get('/add', [MaterialController::class, 'add_crc'])->name('crc.add');
                    Route::post('/create', [MaterialController::class, 'create_crc'])->name('crc.create');
                    Route::get('/print/{id}', [MaterialController::class, 'print_crc'])->name('crc.print');    
                    Route::get('/show/{id}', [MaterialController::class, 'show_crc'])->name('crc.show');    
                });
                Route::prefix('ingot')->group(function () {
                    Route::get('/', [MaterialController::class, 'index_ingot'])->name('ingot');
                    Route::get('/add', [MaterialController::class, 'add_ingot'])->name('ingot.add');
                    Route::post('/create', [MaterialController::class, 'create_ingot'])->name('ingot.create');
                    Route::get('/print/{id}', [MaterialController::class, 'print_ingot'])->name('ingot.print');    
                
                });
                Route::prefix('resin')->group(function () {
                    Route::get('/', [MaterialController::class, 'index_resin'])->name('resin');
                    Route::get('/add', [MaterialController::class, 'add_resin'])->name('resin.add');
                    Route::post('/create', [MaterialController::class, 'create_resin'])->name('resin.create');
                    Route::get('/print/{id}', [MaterialController::class, 'print_resin'])->name('resin.print');    
                
                }); 
            });
            //Eup
            Route::prefix('eup')->group(function () {
                Route::get('/', [EUPController::class, 'index'])->name('eup');
                Route::get('/add', [EUPController::class, 'add'])->name('eup.add');
                Route::post('/create', [EUPController::class, 'create'])->name('eup.create');
                Route::get('/print/{id}', [EUPController::class, 'print'])->name('eup.print');
                Route::get('/show/{id}', [EUPController::class, 'show'])->name('eup.show');     
            });
        });
    });

    // Open-Packing
    Route::group(['prefix' => 'Open-Packing', 'middleware' => ['Open-Packing'], 'as' => 'Open-Packing.'], function () {

        
        Route::group(['prefix' => 'admin', 'middleware' => ['admin'], 'as' => 'admin.'], function () {
            Route::get('/',[DashboardControlller::class, 'op_admin'])->name('dashboard');
            Route::get('/backup',[OpenPackController::class, 'backup'])->name('backup');
            Route::prefix('packing')->group(function () {
                Route::get('/',[OpenPackController::class, 'index'])->name('packing');
                Route::get('/add',[OpenPackController::class, 'add'])->name('packing.add');
                Route::post('/store',[OpenPackController::class,'store'])->name('packing.store');
                Route::get('/add-gm',[OpenPackController::class, 'add_gm'])->name('packing.add.gm');
                Route::post('/store/gm',[OpenPackController::class,'store_gm'])->name('packing.store.gm');
                Route::get('/show/{gm}',[OpenPackController::class, 'show'])->name('packing.show');
                Route::get('/edit/{id}',[OpenPackController::class, 'edit'])->name('packing.edit');
                Route::put('/checks/{gm}',[OpenPackController::class, 'checks'])->name('packing.checks');
                Route::get('/update',[OpenPackController::class, 'update'])->name('packing.update');
                Route::get('/delete/{id}',[OpenPackController::class, 'delete'])->name('packing.delete');
                Route::get('/delete/gm/{id}',[OpenPackController::class, 'delete_gm'])->name('packing.delete.gm');
                Route::get('/print/{gm}',[OpenPackController::class, 'print'])->name('packing.print');
                Route::get('/download/{gm}',[OpenPackController::class, 'download'])->name('packing.download');
                Route::post('/excel',[OpenPackController::class,'excel'])->name('packing.excel');
            });
        });
        Route::group(['prefix' => 'pegawai', 'middleware' => ['pegawai'], 'as' => 'pegawai.'], function () {
            Route::get('/',[DashboardControlller::class, 'op_pegawai'])->name('dashboard');

            Route::prefix('packing')->group(function () {
                Route::get('/',[OpenPackController::class, 'index'])->name('packing');
                Route::get('/add',[OpenPackController::class, 'add'])->name('packing.add');
                Route::post('/store',[OpenPackController::class,'store'])->name('packing.store');
                Route::get('/add-gm/{gm}',[OpenPackController::class, 'add_gm'])->name('packing.add.gm');
                Route::post('/store/gm',[OpenPackController::class,'store_gm'])->name('packing.store.gm');
            });
        });
    });

    // Supply
    Route::group(['prefix' => 'Supply', 'middleware' => ['Supply'], 'as' => 'Supply.'], function () {

        
        Route::group(['prefix' => 'admin', 'middleware' => ['admin'], 'as' => 'admin.'], function () {
            Route::get('/',[DashboardControlller::class, 'sp_admin'])->name('dashboard');
            Route::prefix('supply')->group(function () {
                Route::get('/',[SupplyController::class, 'index'])->name('supply');
                Route::get('/add',[SupplyController::class, 'add'])->name('supply.add');
                Route::post('/store',[SupplyController::class,'store'])->name('supply.store');
                Route::get('/add-gm/{gm}',[SupplyController::class, 'add_gm'])->name('supply.add.gm');
                Route::post('/store/gm',[SupplyController::class,'store_gm'])->name('supply.store.gm');
                Route::get('/show/{gm}',[SupplyController::class, 'show'])->name('supply.show');
                Route::get('/edit/{id}',[SupplyController::class, 'edit'])->name('supply.edit');
                Route::get('/update',[SupplyController::class, 'update'])->name('supply.update');
                Route::get('/delete/{id}',[SupplyController::class, 'delete'])->name('supply.delete');
                Route::get('/print/{gm}',[SupplyController::class, 'print'])->name('supply.print');
            });
        });
        Route::group(['prefix' => 'pegawai', 'middleware' => ['pegawai'], 'as' => 'pegawai.'], function () {
            Route::get('/',[DashboardControlller::class, 'op_pegawai'])->name('dashboard');

            Route::prefix('packing')->group(function () {
                Route::get('/',[OpenPackController::class, 'index'])->name('packing');
                Route::get('/add',[OpenPackController::class, 'add'])->name('packing.add');
                Route::post('/store',[OpenPackController::class,'store'])->name('packing.store');
                Route::get('/add-gm/{gm}',[OpenPackController::class, 'add_gm'])->name('packing.add.gm');
                Route::post('/store/gm',[OpenPackController::class,'store_gm'])->name('packing.store.gm');
            });
        });
    });

    // Packing-List
    Route::group(['prefix' => 'Packing-List', 'middleware' => ['Packing-List'], 'as' => 'Packing-List.'], function () {

        
        Route::group(['prefix' => 'admin', 'middleware' => ['admin'], 'as' => 'admin.'], function () {
            Route::get('/',[DashboardControlller::class, 'pl_admin'])->name('dashboard');
            Route::prefix('list')->group(function () {
                Route::get('/',[PListController::class, 'index'])->name('list');
                Route::get('/add',[PListController::class, 'add'])->name('list.add');
                Route::post('/store',[PListController::class,'store'])->name('list.store');
                Route::get('/add-gm/{gm}',[PListController::class, 'add_gm'])->name('list.add.gm');
                Route::post('/store/gm',[PListController::class,'store_gm'])->name('list.store.gm');
                Route::get('/show/{gm}',[PListController::class, 'show'])->name('list.show');
                Route::get('/edit/{id}',[PListController::class, 'edit'])->name('list.edit');
                Route::post('/update',[PListController::class, 'update'])->name('list.update');
                Route::get('/delete/{id}',[PListController::class, 'delete'])->name('list.delete');
                Route::get('/print/{gm}',[PListController::class, 'print'])->name('list.print');
                Route::delete('/clearall',[PListController::class, 'clearall'])->name('list.clearall');

            });
            Route::prefix('database')->group(function () {
                Route::get('/',[PListController::class, 'db'])->name('database');
                Route::get('/add',[PListController::class, 'db_add'])->name('database.add');
                Route::post('/store',[PListController::class, 'db_store'])->name('database.store');
                Route::post('/store-excel',[PListController::class, 'db_store_excel'])->name('database.store.excel');
                Route::get('/edit/{id}',[PListController::class, 'db_edit'])->name('database.edit');
                Route::put('/update/{id}',[PListController::class, 'db_update'])->name('database.update');
                Route::put('/update/{id}',[PListController::class, 'db_update'])->name('database.update');
                Route::delete('/delete/{id}',[PListController::class, 'db_destroy'])->name('database.destroy');
                Route::delete('/clear',[PListController::class, 'db_clear'])->name('database.clear');
                Route::get('/confirmation',[PListController::class, 'confir'])->name('database.confir');
                Route::prefix('gm')->group(function () {
                    Route::get('/',[PListController::class, 'db_gm'])->name('gm');
                    Route::get('/add',[PListController::class, 'db_add_gm'])->name('gm.add');
                    Route::post('/store',[PListController::class, 'db_store_gm'])->name('gm.store');
                    Route::post('/store/excel',[PListController::class, 'db_store_excel_gm'])->name('gm.excel.store');
                    Route::post('/store/excel1',[PListController::class, 'db_store_excel_gm1'])->name('gm.excel.store1');
                    Route::get('/edit/{id}',[PListController::class, 'db_edit_gm'])->name('gm.edit');
                    Route::put('/update/{id}',[PListController::class, 'db_update_gm'])->name('gm.update');
                    Route::delete('/delete/{id}',[PListController::class, 'db_delete_gm'])->name('gm.delete');
                    Route::delete('/clear',[PListController::class, 'db_clear_gm'])->name('gm.clear');
                });
            
            });
                
            Route::prefix('hasil')->group(function () {
                Route::get('/',[PListController::class, 'hasil_group'])->name('hasil');
                Route::get('/show/{ket}',[PListController::class, 'hasil'])->name('hasil.shows');
                Route::get('/add',[PListController::class, 'hasil_add'])->name('hasil.add');
                Route::post('/store',[PListController::class, 'hasil_store'])->name('hasil.store');
                Route::get('/download/{ket}',[PListController::class, 'exportexcel'])->name('hasil.export');
                Route::get('/download',[PListController::class, 'exportexcels'])->name('hasil.exports');
            });
                
        });

    });

    //Kendaraan
    Route::group(['prefix' => 'Kendaraan', 'middleware' => ['Kendaraan'], 'as' => 'Kendaraan.'], function () {
        Route::group(['prefix' => 'admin', 'middleware' => ['admin'], 'as' => 'admin.'], function () {
            Route::get('/',[DashboardControlller::class, 'k_admin'])->name('dashboard');
            Route::get('/print/{id}',[KendaraanController::class, 'print'])->name('print');
            Route::get('/export',[KendaraanController::class, 'export'])->name('export');
            Route::prefix('check')->group(function () {
                Route::get('/check',[KendaraanController::class, 'add'])->name('check.add');
                Route::post('/store',[KendaraanController::class, 'store'])->name('check.store');
                Route::post('/autosave', [KendaraanController::class, 'autosave'])->name('kendaraan.autosave');
                Route::put('/update/{id}', [KendaraanController::class, 'update'])->name('kendaraan.update');
                Route::delete('/delete/{id}', [KendaraanController::class, 'delete'])->name('kendaraan.delete');
            });

        });
        Route::group(['prefix' => 'pegawai', 'middleware' => ['pegawai'], 'as' => 'pegawai.'], function () {
            Route::get('/',[DashboardControlller::class, 'k_pegawai'])->name('dashboard');
            Route::get('/print/{id}',[KendaraanController::class, 'print'])->name('print');

            Route::prefix('check')->group(function () {
                Route::get('/check',[KendaraanController::class, 'add'])->name('check.add');
                Route::post('/store',[KendaraanController::class, 'store'])->name('check.store');
                Route::post('/autosave', [KendaraanController::class, 'autosave'])->name('kendaraan.autosave');
                Route::put('/update/{id}', [KendaraanController::class, 'update'])->name('kendaraan.update');
                Route::delete('/delete/{id}', [KendaraanController::class, 'delete'])->name('kendaraan.delete');
            });
            
        });

    });

    //Scan-Layout
    Route::group(['prefix' => 'Scan-Layout', 'middleware' => ['Scan-Layout'], 'as' => 'Scan-Layout.'], function () {
        Route::group(['prefix' => 'admin', 'middleware' => ['admin'], 'as' => 'admin.'], function () {
            Route::get('/',[DashboardControlller::class, 'a_scan'])->name('dashboard');
            
            Route::prefix('scan')->group(function () {
                Route::get('/',[ScanLayoutController::class, 'index'])->name('scan');
                Route::get('/add',[ScanLayoutController::class, 'add'])->name('scan.add');
                Route::get('/export',[ScanLayoutController::class, 'export'])->name('scan.export');
                Route::post('/store',[ScanLayoutController::class, 'store'])->name('scan.store');
                Route::put('/update/{id}',[ScanLayoutController::class, 'update'])->name('scan.update');
                Route::delete('/delete/{id}',[ScanLayoutController::class, 'delete'])->name('scan.delete');

            });
            
        });
        Route::group(['prefix' => 'pegawai', 'middleware' => ['pegawai'], 'as' => 'pegawai.'], function () {
            Route::get('/',[DashboardControlller::class, 'a_scan'])->name('dashboard');
            
            Route::prefix('scan')->group(function () {
                Route::get('/',[ScanLayoutController::class, 'index'])->name('scan');
                Route::get('/add',[ScanLayoutController::class, 'add'])->name('scan.add');
                Route::get('/export',[ScanLayoutController::class, 'export'])->name('scan.export');
                Route::post('/store',[ScanLayoutController::class, 'store'])->name('scan.store');
                Route::put('/update/{id}',[ScanLayoutController::class, 'update'])->name('scan.update');
                Route::delete('/delete/{id}',[ScanLayoutController::class, 'delete'])->name('scan.delete');

            });
        });

    });

    //Coil Damage
    Route::group(['prefix' => 'Coil-Damage', 'middleware' => ['Coil-Damage'], 'as' => 'Coil-Damage.'], function () {
        Route::group(['prefix' => 'admin', 'middleware' => ['admin'], 'as' => 'admin.'], function () {
            Route::get('/',[DashboardControlller::class, 'coil_damage'])->name('dashboard');
            
            Route::prefix('damage')->group(function () {
                Route::get('/',[CoilDamageController::class, 'index'])->name('damage');
                Route::get('/add',[CoilDamageController::class, 'add'])->name('damage.add');
                Route::get('/export',[CoilDamageController::class, 'export'])->name('damage.export');
                Route::post('/store',[CoilDamageController::class, 'store'])->name('damage.store');
                Route::put('/update/{id}',[CoilDamageController::class, 'update'])->name('damage.update');
                Route::delete('/delete/{id}',[CoilDamageController::class, 'delete'])->name('damage.delete');
            });
            
        });
        Route::group(['prefix' => 'pegawai', 'middleware' => ['pegawai'], 'as' => 'pegawai.'], function () {
            Route::get('/',[DashboardControlller::class, 'coil_damage'])->name('dashboard');
            
            Route::prefix('damage')->group(function () {
                Route::get('/',[CoilDamageController::class, 'index'])->name('damage');
                Route::get('/add',[CoilDamageController::class, 'add'])->name('damage.add');
                Route::get('/export',[CoilDamageController::class, 'export'])->name('damage.export');
                Route::post('/store',[CoilDamageController::class, 'store'])->name('damage.store');
                Route::put('/update/{id}',[CoilDamageController::class, 'update'])->name('damage.update');
                Route::delete('/delete/{id}',[CoilDamageController::class, 'delete'])->name('damage.delete');
            });
        });

    });

    //Packing L08
    Route::group(['prefix' => 'L-08', 'middleware' => ['L-08'], 'as' => 'L-08.'], function () {
        Route::group(['prefix' => 'admin', 'middleware' => ['admin'], 'as' => 'admin.'], function () {
            Route::get('/',[DashboardControlller::class, 'l_08'])->name('dashboard');
            
            Route::prefix('damage')->group(function () {
                Route::get('/',[PackingL08Controller::class, 'index'])->name('damage');
                Route::get('/add',[PackingL08Controller::class, 'add'])->name('damage.add');
                Route::get('/export',[PackingL08Controller::class, 'export'])->name('damage.export');
                Route::post('/store',[PackingL08Controller::class, 'store'])->name('damage.store');
                Route::put('/update/{id}',[PackingL08Controller::class, 'update'])->name('damage.update');
                Route::delete('/delete/{id}',[PackingL08Controller::class, 'delete'])->name('damage.delete');
            });
            Route::prefix('rekap')->group(function () {
                Route::get('/',[RekapController::class, 'index'])->name('rekap');
                Route::post('/upload',[RekapController::class, 'upload'])->name('rekap.upload');
                Route::get('/detail/{so}',[RekapController::class, 'detail'])->name('rekap.detail');
                Route::put('/rekap/detail/{id}', [RekapController::class, 'update'])->name('rekap.detail.find');
                Route::get('/delete/{so}',[RekapController::class, 'delete'])->name('rekap.delete');
                // Route::get('/search', [PackingL08Controller::class, 'search'])->name('rekap.search');
                Route::get('/search-attributes', [PackingL08Controller::class, 'searchAttributes'])->name('search.attributes');

            });
            
        });
        Route::group(['prefix' => 'pegawai', 'middleware' => ['pegawai'], 'as' => 'pegawai.'], function () {
            Route::get('/',[DashboardControlller::class, 'l_08'])->name('dashboard');
            
            Route::prefix('damage')->group(function () {
                Route::get('/',[PackingL08Controller::class, 'index'])->name('damage');
                Route::get('/add',[PackingL08Controller::class, 'add'])->name('damage.add');
                Route::get('/export',[PackingL08Controller::class, 'export'])->name('damage.export');
                Route::post('/store',[PackingL08Controller::class, 'store'])->name('damage.store');
                Route::put('/update/{id}',[PackingL08Controller::class, 'update'])->name('damage.update');
                Route::delete('/delete/{id}',[PackingL08Controller::class, 'delete'])->name('damage.delete');
            });
            Route::prefix('rekap')->group(function () {
                Route::get('/',[RekapController::class, 'index'])->name('rekap');
                Route::post('/upload',[RekapController::class, 'upload'])->name('rekap.upload');
                Route::get('/detail/{so}',[RekapController::class, 'detail'])->name('rekap.detail');
                Route::get('/delete/{so}',[RekapController::class, 'delete'])->name('rekap.delete');
            });
        });

    });

//endautologout
});




