<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\imports\ExcelImport;
use App\Imports\ExcelKoilImport;
use Excel;

class InputDataExcel extends Controller
{
    public function index(){
        return view('Mapping-Container.content.input-excel.index');
    }

    public function store(Request $request){
        // dd($request->all());
        $request->validate([
        'excel' => 'required|file|mimes:xlsx,xls,csv', // hanya terima file Excel
    ], [
        'excel.required' => 'File Excel wajib diunggah.',
        'excel.file' => 'File yang diunggah harus berupa file.',
        'excel.mimes' => 'Format file harus .xlsx atau .xls atau .csv.',
    ]);
        Excel::import(new ExcelImport, $request->file('excel'));
        return redirect()->route('Mapping.admin.shipment')->with('success', 'Data telah berhasil ditambahkan');
    }
    
    public function storekoil(Request $request) {
        // dd($request->all());
        $request->validate([
        'pegawaiexcel' => 'required|file|mimes:xlsx,xls,csv', // hanya terima file Excel
    ], [
        'pegawaiexcel.required' => 'File Excel wajib diunggah.',
        'pegawaiexcel.file' => 'File yang diunggah harus berupa file.',
        'pegawaiexcel.mimes' => 'Format file harus .xlsx atau .xls atau .csv.',
    ]);
        Excel::import(new ExcelKoilImport, $request->file('pegawaiexcel'));

        return redirect()->route('Mapping.admin.coil')->with('success', 'Data telah berhasil ditambahkan');
    }
}
