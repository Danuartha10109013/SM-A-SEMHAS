<?php

namespace App\Http\Controllers;

use App\Exports\CKendaraanExportExcel;
use App\Models\KendaraanM;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class KendaraanController extends Controller
{
    public function add(){
        return view('Kendaraan.pages.pegawai.add');
    }


    public function store(Request $request)
    {
        // dd($request->all());
        // Validate the form data
        $request->validate([
            'no_urut' => 'required|string',
            'tanggal' => 'required|date',
            'in' => 'required|string',
            'nama_ekspedisi' => 'required|string',
            'ket_nama_ekspedisi' => 'nullable|string',
            'no_mobil' => 'required|string',
            'ket_no_mobil' => 'nullable|string',
            'no_mobil_foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            'no_kontainer' => 'required|string',
            'no_kontainer_foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            'ket_no_kontainer' => 'nullable|string',
            'tujuan' => 'required|string',
            'ket_tujuan' => 'nullable|string',
            'nama_sopir' => 'required|string',
            'ket_nama_sopir' => 'nullable|string',
            'helm' => 'required|string',
            'celana_panjang' => 'required|string',
            'baju_lengan_panjang' => 'required|string',
            'sepatu' => 'required|string',
            'sim' => 'required|string',
            'masa_berlaku_sim' => 'required|string',
            'ket_masa_berlaku_sim' => 'nullable|date',
            'stnk' => 'required|string',
            'masa_berlaku_stnk' => 'required|string',
            'ket_masa_berlaku_stnk' => 'nullable|date',
            'kir' => 'required|string',
            'masa_berlaku_kir' => 'required|string',
            'ket_masa_berlaku_kir' => 'nullable|date',
            'surat_pengantar_ekspedisi' => 'required|string',
            'segel' => 'required|string',
        ]);

        // Handle file uploads
        $noMobilFotoPath = null;
        if ($request->hasFile('no_mobil_foto')) {
            $noMobilFotoPath = $request->file('no_mobil_foto')->store('uploads', 'public');
        }

        $noKontainerFotoPath = null;
        if ($request->hasFile('no_kontainer_foto')) {
            $noKontainerFotoPath = $request->file('no_kontainer_foto')->store('uploads', 'public');
        }

        $tanggal = date('Y-m-d', strtotime($request->tanggal));

        // Create a new Kendaraan record in the database
        $kendaraan = new KendaraanM();
        $kendaraan->no_urut = $request->input('no_urut');
        $kendaraan->tanggal = $tanggal;
        $kendaraan->jam = $request->input('in');
        $kendaraan->nama_ekspedisi = $request->input('nama_ekspedisi');
        $kendaraan->ket_nama_ekspedisi = $request->input('ket_nama_ekspedisi');
        $kendaraan->no_mobil = $request->input('no_mobil');
        $kendaraan->ket_no_mobil = $request->input('ket_no_mobil');
        $kendaraan->no_mobil_foto = $noMobilFotoPath;
        $kendaraan->no_kontainer = $request->input('no_kontainer');
        $kendaraan->ket_no_kontainer = $request->input('ket_no_kontainer');
        $kendaraan->no_kontainer_foto = $noKontainerFotoPath;
        $kendaraan->tujuan = $request->input('tujuan');
        $kendaraan->ket_tujuan = $request->input('ket_tujuan');
        $kendaraan->nama_sopir = $request->input('nama_sopir');
        $kendaraan->ket_nama_sopir = $request->input('ket_nama_sopir');
        $kendaraan->helm = $request->input('helm');
        $kendaraan->ket_helm = $request->input('ket_helm');
        $kendaraan->celana_panjang = $request->input('celana_panjang');
        $kendaraan->ket_celana_panjang = $request->input('ket_celana_panjang');
        $kendaraan->baju_lengan_panjang = $request->input('baju_lengan_panjang');
        $kendaraan->ket_baju_lengan_panjang = $request->input('ket_baju_lengan_panjang');
        $kendaraan->sepatu = $request->input('sepatu');
        $kendaraan->ket_sepatu = $request->input('ket_sepatu');
        $kendaraan->sim = $request->input('sim');
        $kendaraan->ket_sim = $request->input('ket_sim');
        $kendaraan->masa_berlaku_sim = $request->input('masa_berlaku_sim');
        $kendaraan->ket_masa_berlaku_sim = $request->input('ket_masa_berlaku_sim');
        $kendaraan->stnk = $request->input('stnk');
        $kendaraan->ket_stnk = $request->input('ket_stnk');
        $kendaraan->masa_berlaku_stnk = $request->input('masa_berlaku_stnk');
        $kendaraan->ket_masa_berlaku_stnk = $request->input('ket_masa_berlaku_stnk');
        $kendaraan->kir = $request->input('kir');
        $kendaraan->ket_kir = $request->input('ket_kir');
        $kendaraan->masa_berlaku_kir = $request->input('masa_berlaku_kir');
        $kendaraan->ket_masa_berlaku_kir = $request->input('ket_masa_berlaku_kir');
        $kendaraan->surat_pengantar_ekspedisi = $request->input('surat_pengantar_ekspedisi');
        $kendaraan->ket_surat_pengantar_ekspedisi = $request->input('ket_surat_pengantar_ekspedisi');
        $kendaraan->segel = $request->input('segel');
        $kendaraan->ket_segel = $request->input('ket_segel');
        $kendaraan->user_id = Auth::id(); // Logged-in user ID as 'responden'
        
        // Save the record
        $kendaraan->save();

        return redirect()->route('Kendaraan.pegawai.dashboard')->with('success', 'Vehicle checklist successfully submitted.');
    }

    public function update(Request $request, $id)
{
    // dd($request->all());
    // Validate the incoming request data
    $request->validate([
        'no_urut' => 'required|string|max:255',
        'date' => 'required|date',
        'jam' => 'required|date_format:H:i:s',
        'nama_ekspedisi' => 'required|string|max:255',
        'no_mobil' => 'required|string|max:255',
        'no_kontainer' => 'required|string|max:255',
        'tujuan' => 'required|string|max:255',
        'nama_sopir' => 'required|string|max:255',
        'helm' => 'required|string',
        'celana_panjang' => 'required|string',
        'baju_lengan_panjang' => 'required|string',
        'sepatu' => 'required|string',
        'sim' => 'required|string|max:255',
        'masa_berlaku_sim' => 'required|string',
        'stnk' => 'required|string|max:255',
        'masa_berlaku_stnk' => 'required|string',
        'kir' => 'required|string|max:255',
        'masa_berlaku_kir' => 'required|string',
        'surat_pengantar_ekspedisi' => 'required|string|max:255',
        'segel' => 'required|string|max:255',
        'no_mobil_foto' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        'no_kontainer_foto' => 'nullable|image|mimes:jpeg,png,jpg,gif',
    ]);

    // Find the record by ID
    $record = KendaraanM::findOrFail($id);

    // Update the record with validated data
    $record->no_urut = $request->no_urut;
    $record->created_at = $request->date;
    $record->jam = $request->jam;
    $record->nama_ekspedisi = $request->nama_ekspedisi;
    $record->no_mobil = $request->no_mobil;
    $record->no_kontainer = $request->no_kontainer;
    $record->tujuan = $request->tujuan;
    $record->nama_sopir = $request->nama_sopir;
    $record->helm = $request->helm;
    $record->celana_panjang = $request->celana_panjang;
    $record->baju_lengan_panjang = $request->baju_lengan_panjang;
    $record->sepatu = $request->sepatu;
    $record->sim = $request->sim;
    $record->masa_berlaku_sim = $request->masa_berlaku_sim;
    $record->stnk = $request->stnk;
    $record->masa_berlaku_stnk = $request->masa_berlaku_stnk;
    $record->kir = $request->kir;
    $record->masa_berlaku_kir = $request->masa_berlaku_kir;
    $record->surat_pengantar_ekspedisi = $request->surat_pengantar_ekspedisi;
    $record->segel = $request->segel;
    // Update other fields similarly...

    // Handle file uploads
    if ($request->hasFile('no_mobil_foto')) {
        // Delete the old photo if it exists
        if ($record->no_mobil_foto) {
            Storage::disk('public')->delete($record->no_mobil_foto);
        }
        // Store the new file
        $record->no_mobil_foto = $request->file('no_mobil_foto')->store('uploads/no_mobil_foto', 'public');
    }

    if ($request->hasFile('no_kontainer_foto')) {
        // Delete the old photo if it exists
        if ($record->no_kontainer_foto) {
            Storage::disk('public')->delete($record->no_kontainer_foto);
        }
        // Store the new file
        $record->no_kontainer_foto = $request->file('no_kontainer_foto')->store('uploads/no_kontainer_foto', 'public');
    }

    // Save the updated record
    $record->save();

    // Redirect or return response
    return redirect()->back()->with('success', 'Record updated successfully.');
}

public function delete($id)
    {
        // Find the record by ID
        $record = KendaraanM::findOrFail($id);

        // Check if the image file exists and delete it
        if ($record->image_path) { // Assuming 'image_path' is the column storing the image path
            Storage::disk('public')->delete($record->image_path);
        }

        // Delete the record from the database
        $record->delete();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Record deleted successfully.');
    }

    public function print($id){
        $data = KendaraanM::find($id);
        return view('Kendaraan.pages.admin.print',compact('data'));
    }

    public function export(){
        $date = now()->format('d-m-Y'); 
        return Excel::download(new CKendaraanExportExcel, $date . '_Checklist_Kendaraan.xlsx');
    }
}
    

