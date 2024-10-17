<?php

namespace App\Http\Controllers;

use App\Models\Coil;
use App\Models\MapCoil;
use App\Models\Pengecekan;
use App\Models\Shipment;
use Illuminate\Http\Request;

class MappingController extends Controller
{
    public function index($id)
    {
        // Mengambil data Shipment berdasarkan id
        $data = Shipment::where('id',$id)->get();
        $same = Shipment::where('id',$id)->value('no_gs');
        $coil = Coil::where('no_gs', $same)->get();
        $tonase = Coil::where('no_gs', $same)->sum('berat_produk');
        $pengecekan = Pengecekan::where('no_gs', $same)->get();
        $maps = MapCoil::where('no_gs', $same)->get();
    
        // Mengembalikan view dengan data Shipment yang diambil
        return view('Mapping-Container.content.pengecekan.index', compact('data','coil', 'tonase','pengecekan','maps'));
    }


    public function store(Request $request, $no_gs)
{
    // Validasi data input
    // dd($request->all());
    $validatedData = $request->validate([
        'pembeda' => 'nullable|string',
        'awal_muat' => 'nullable|string',
        'awal_muat1' => 'nullable|string',
        'tgl_gs' => 'nullable|date',
        'kota_negara' => 'nullable|string',
        'customer' => 'nullable|string',
        'lantai' => 'nullable|string',
        'dinding' => 'nullable|string',
        'pengunci_kontainer' => 'nullable|string',
        'sapu' => 'nullable|in:sudah,belum',
        'vacum' => 'nullable|string',
        'disemprot' => 'nullable|string',
        'choke' => 'nullable|string',
        'stopper' => 'nullable|string',
        'sling' => 'nullable|int',
        'silica_gel' => 'nullable|string',
        'fumigasi' => 'nullable|string',
        'selesai_muat' => 'nullable|string',
        'cuaca' => 'nullable|string',
        'kondisi_ban' => 'nullable|string',
        'kondisi_lantai' => 'nullable|string',
        'rantai_webbing' => 'nullable|string',
        'tonase' => 'nullable|string',
        'tare' => 'nullable|string',
        'terpal' => 'nullable|string',
        'stuffing' => 'nullable|in:eye to sky,eye to side,eye to rear',
        'no_mobil' => 'nullable|string',
        'no_container' => 'nullable|string',
        'tonase_tare' => 'nullable|string',
        'catatan' => 'nullable|string',
        'no_gs' => 'required|string',
        'pegawai' => 'nullable|string',
        'a1' => 'nullable|string|max:255',
        'a2' => 'nullable|string|max:255',
        'a3' => 'nullable|string|max:255',
        'a4' => 'nullable|string|max:255',
        'a5' => 'nullable|string|max:255',
        'b1' => 'nullable|string|max:255',
        'b2' => 'nullable|string|max:255',
        'b3' => 'nullable|string|max:255',
        'b4' => 'nullable|string|max:255',
        'b5' => 'nullable|string|max:255',
        'c1' => 'nullable|string|max:255',
        'c2' => 'nullable|string|max:255',
        'c3' => 'nullable|string|max:255',
        'c4' => 'nullable|string|max:255',
        'c5' => 'nullable|string|max:255',
        'a1_eye' => 'nullable|string|max:255',
        'a2_eye' => 'nullable|string|max:255',
        'a3_eye' => 'nullable|string|max:255',
        'a4_eye' => 'nullable|string|max:255',
        'a5_eye' => 'nullable|string|max:255',
        'b1_eye' => 'nullable|string|max:255',
        'b2_eye' => 'nullable|string|max:255',
        'b3_eye' => 'nullable|string|max:255',
        'b4_eye' => 'nullable|string|max:255',
        'b5_eye' => 'nullable|string|max:255',
        'c1_eye' => 'nullable|string|max:255',
        'c2_eye' => 'nullable|string|max:255',
        'c3_eye' => 'nullable|string|max:255',
        'c4_eye' => 'nullable|string|max:255',
        'c5_eye' => 'nullable|string|max:255',
    ]);

    // Pastikan nilai `eye` yang tidak diisi menjadi null
    $fields = [
        'a1_eye', 'a2_eye', 'a3_eye', 'a4_eye', 'a5_eye',
        'b1_eye', 'b2_eye', 'b3_eye', 'b4_eye', 'b5_eye',
        'c1_eye', 'c2_eye', 'c3_eye', 'c4_eye', 'c5_eye'
    ];

    foreach ($fields as $field) {
        if (!array_key_exists($field, $validatedData)) {
            $validatedData[$field] = null;
        }
    }

    // Update data di model Pengecekan
    $pengecekan = Pengecekan::where('no_gs', $no_gs)->firstOrFail();
    $pengecekan->update($validatedData);

    // Update data di model MapCoil
    $mapCoil = MapCoil::where('no_gs', $no_gs)->firstOrFail();
    $mapCoil->update($validatedData);

    // Redirect ke halaman sukses
    return redirect()->back();
    // return redirect(url('prints/' . $validatedData['no_gs']));
}

}
