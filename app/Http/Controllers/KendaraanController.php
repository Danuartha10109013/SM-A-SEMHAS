<?php

namespace App\Http\Controllers;

use App\Models\KendaraanM;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KendaraanController extends Controller
{
    public function add(){
        return view('Kendaraan.pages.pegawai.add');
    }


    public function store(Request $request)
    {
        $request->validate([
            'no_urut' => 'required|string',
            'nama_ekspedisi' => 'required|string',
            'no_mobil' => 'required|string',
            'no_kontainer' => 'required|string',
            'tujuan' => 'required|string',
            'nama_sopir' => 'required|string',
            'helm' => 'required|string',
            'celana_panjang' => 'required|string',
            'baju_lengan_panjang' => 'required|string',
            'sepatu' => 'required|string',
            'sim' => 'required|string',
            'masa_berlaku_sim' => 'required|string',
            'stnk' => 'required|string',
            'masa_berlaku_stnk' => 'required|string',
            'kir' => 'required|string',
            'masa_berlaku_kir' => 'required|string',
            'surat_pengantar_ekspedisi' => 'required|string',
            'segel' => 'required|string',
            // Optional fields (keterangan fields)
            'ket_nama_ekspedisi' => 'nullable|string',
            'ket_no_mobil' => 'nullable|string',
            'ket_no_kontainer' => 'nullable|string',
            'ket_tujuan' => 'nullable|string',
            'ket_nama_sopir' => 'nullable|string',
            'ket_helm' => 'nullable|string',
            'ket_celana_panjang' => 'nullable|string',
            'ket_baju_lengan_panjang' => 'nullable|string',
            'ket_sepatu' => 'nullable|string',
            'ket_sim' => 'nullable|string',
            'ket_masa_berlaku_sim' => 'nullable|date',
            'ket_stnk' => 'nullable|string',
            'ket_masa_berlaku_stnk' => 'nullable|date',
            'ket_kir' => 'nullable|string',
            'ket_masa_berlaku_kir' => 'nullable|date',
            'ket_surat_pengantar_ekspedisi' => 'nullable|string',
            'ket_segel' => 'nullable|string',
        ]);

        $kendaraan = new KendaraanM([
            'no_urut' => $request->input('no_urut'),
            'nama_ekspedisi' => $request->input('nama_ekspedisi'),
            'no_mobil' => $request->input('no_mobil'),
            'no_kontainer' => $request->input('no_kontainer'),
            'tujuan' => $request->input('tujuan'),
            'nama_sopir' => $request->input('nama_sopir'),
            'helm' => $request->input('helm'),
            'celana_panjang' => $request->input('celana_panjang'),
            'baju_lengan_panjang' => $request->input('baju_lengan_panjang'),
            'sepatu' => $request->input('sepatu'),
            'sim' => $request->input('sim'),
            'masa_berlaku_sim' => $request->input('masa_berlaku_sim'),
            'stnk' => $request->input('stnk'),
            'masa_berlaku_stnk' => $request->input('masa_berlaku_stnk'),
            'kir' => $request->input('kir'),
            'masa_berlaku_kir' => $request->input('masa_berlaku_kir'),
            'surat_pengantar_ekspedisi' => $request->input('surat_pengantar_ekspedisi'),
            'segel' => $request->input('segel'),

            'ket_nama_ekspedisi' => $request->input('ket_nama_ekspedisi'),
            'ket_no_mobil' => $request->input('ket_no_mobil'),
            'ket_no_kontainer' => $request->input('ket_no_kontainer'),
            'ket_tujuan' => $request->input('ket_tujuan'),
            'ket_nama_sopir' => $request->input('ket_nama_sopir'),
            'ket_helm' => $request->input('ket_helm'),
            'ket_celana_panjang' => $request->input('ket_celana_panjang'),
            'ket_baju_lengan_panjang' => $request->input('ket_baju_lengan_panjang'),
            'ket_sepatu' => $request->input('ket_sepatu'),
            'ket_sim' => $request->input('ket_sim'),
            'ket_masa_berlaku_sim' => $request->input('ket_masa_berlaku_sim'),
            'ket_stnk' => $request->input('ket_stnk'),
            'ket_masa_berlaku_stnk' => $request->input('ket_masa_berlaku_stnk'),
            'ket_kir' => $request->input('ket_kir'),
            'ket_masa_berlaku_kir' => $request->input('ket_masa_berlaku_kir'),
            'ket_surat_pengantar_ekspedisi' => $request->input('ket_surat_pengantar_ekspedisi'),
            'ket_segel' => $request->input('ket_segel'),
            'user_id' => Auth::user()->id,
        ]);

        $kendaraan->save();

        return redirect()->route('Kendaraan.pegawai.dashboard')->with('success', 'Vehicle checklist saved successfully.');
    }
}
    

