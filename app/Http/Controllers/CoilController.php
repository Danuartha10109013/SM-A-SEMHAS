<?php

namespace App\Http\Controllers;

use App\Models\Coil;
use Illuminate\Http\Request;

class CoilController extends Controller
{
  
    public function index($no_gs){
        $same = $no_gs;
        $data = Coil::where('no_gs', $no_gs)->get();

        return view('Mapping-Container.content.dashboard.coiling', compact('data','same'));
    }
    public function create($no_gs){
         $same = $no_gs;
        //  dd($same);

        $data = Coil::where('no_gs',$same)->get();

        return view('Mapping-Container.content.dashboard.tambahcoil', compact('data','same'));
    }
    public function store(Request $request)
    {
        // Validasi data yang diterima dari form
        $request->validate([
            'no_gs' => 'required|string',
            'kode_produk' => 'required|string',
            'nama_produk' => 'required|string',
            'berat_produk' => 'required|numeric',
            'diameter_produk' => 'required|numeric',
            'lebar_produk' => 'required|numeric',
            'keterangan' => 'nullable|string',
        ]);

        // Membuat instance model Coil dan mengisi dengan data dari form
        $coil = new Coil([
            'no_gs' => $request->no_gs,
            'kode_produk' => $request->kode_produk,
            'nama_produk' => $request->nama_produk,
            'berat_produk' => $request->berat_produk,
            'diameter_produk' => $request->diameter_produk,
            'lebar_produk' => $request->lebar_produk,
            'keterangan' => $request->keterangan,
        ]);

        // Menyimpan data ke dalam database
        $coil->save();

        // Redirect ke halaman sebelumnya atau halaman lain dengan pesan sukses
        return redirect()->route('coiling', $request->no_gs)->with('success', 'Data Koil berhasil disimpan.');
    }

    public function indexs(){
        $data = Coil::all();
        return view('Mapping-Container.content.dashboard.coil', compact('data'));
    }
}
