<?php

namespace App\Http\Controllers;

use App\Models\Coil;
use App\Models\MapCoil;
use App\Models\MapCoilTruck;
use App\Models\Pengecekan;
use App\Models\Shipment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MappingTrukController extends Controller
{
    public function index($id)
    {
        // Mengambil data Shipment berdasarkan id
        $data = Shipment::where('id',$id)->get();
        $same = Shipment::where('id',$id)->value('no_gs');
        $coil = Coil::where('no_gs', $same)->get();
        $tonase = Coil::where('no_gs', $same)->sum('berat_produk');
        $pengecekan = Pengecekan::where('no_gs', $same)->get();
        $maps = MapCoilTruck::where('no_gs', $same)->get();
    
        // Mengembalikan view dengan data Shipment yang diambil
        return view('Mapping-Container.content.pengecekan.indextruck', compact('data','coil', 'tonase','pengecekan','maps'));
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
        'sapu' => 'nullable|string',
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

        'a1' => 'nullable|string|max:255', 'a2' => 'nullable|string|max:255', 'a3' => 'nullable|string|max:255', 'a4' => 'nullable|string|max:255', 'a5' => 'nullable|string|max:255', 'a6' => 'nullable|string|max:255', 'a7' => 'nullable|string|max:255', 'a8' => 'nullable|string|max:255', 'a9' => 'nullable|string|max:255', 'a10' => 'nullable|string|max:255', 'a11' => 'nullable|string|max:255', 'a12' => 'nullable|string|max:255',
        'b1' => 'nullable|string|max:255', 'b2' => 'nullable|string|max:255', 'b3' => 'nullable|string|max:255', 'b4' => 'nullable|string|max:255', 'b5' => 'nullable|string|max:255', 'b6' => 'nullable|string|max:255', 'b7' => 'nullable|string|max:255', 'b8' => 'nullable|string|max:255', 'b9' => 'nullable|string|max:255', 'b10' => 'nullable|string|max:255', 'b11' => 'nullable|string|max:255', 'b12' => 'nullable|string|max:255',
        'c1' => 'nullable|string|max:255', 'c2' => 'nullable|string|max:255', 'c3' => 'nullable|string|max:255', 'c4' => 'nullable|string|max:255', 'c5' => 'nullable|string|max:255', 'c6' => 'nullable|string|max:255', 'c7' => 'nullable|string|max:255', 'c8' => 'nullable|string|max:255', 'c9' => 'nullable|string|max:255', 'c10' => 'nullable|string|max:255', 'c11' => 'nullable|string|max:255', 'c12' => 'nullable|string|max:255',
        'a1_eye' => 'nullable|string|max:255', 'a2_eye' => 'nullable|string|max:255', 'a3_eye' => 'nullable|string|max:255', 'a4_eye' => 'nullable|string|max:255', 'a5_eye' => 'nullable|string|max:255', 'a6_eye' => 'nullable|string|max:255', 'a7_eye' => 'nullable|string|max:255', 'a8_eye' => 'nullable|string|max:255', 'a9_eye' => 'nullable|string|max:255', 'a10_eye' => 'nullable|string|max:255', 'a11_eye' => 'nullable|string|max:255', 'a12_eye' => 'nullable|string|max:255',
        'b1_eye' => 'nullable|string|max:255', 'b2_eye' => 'nullable|string|max:255', 'b3_eye' => 'nullable|string|max:255', 'b4_eye' => 'nullable|string|max:255', 'b5_eye' => 'nullable|string|max:255', 'b6_eye' => 'nullable|string|max:255', 'b7_eye' => 'nullable|string|max:255', 'b8_eye' => 'nullable|string|max:255', 'b9_eye' => 'nullable|string|max:255', 'b10_eye' => 'nullable|string|max:255', 'b11_eye' => 'nullable|string|max:255', 'b12_eye' => 'nullable|string|max:255',
        'c1_eye' => 'nullable|string|max:255', 'c2_eye' => 'nullable|string|max:255', 'c3_eye' => 'nullable|string|max:255', 'c4_eye' => 'nullable|string|max:255', 'c5_eye' => 'nullable|string|max:255', 'c6_eye' => 'nullable|string|max:255', 'c7_eye' => 'nullable|string|max:255', 'c8_eye' => 'nullable|string|max:255', 'c9_eye' => 'nullable|string|max:255', 'c10_eye' => 'nullable|string|max:255', 'c11_eye' => 'nullable|string|max:255', 'c12_eye' => 'nullable|string|max:255',

        'checker' => 'nullable|string|max:255',
        'signature' => 'nullable|string',
        'signature1' => 'nullable|string',
        
    ]);

    // Pastikan nilai `eye` yang tidak diisi menjadi null
    $fields = [
        'a1_eye', 'a2_eye', 'a3_eye', 'a4_eye', 'a5_eye', 'a6_eye', 'a7_eye', 'a8_eye', 'a9_eye', 'a10_eye', 'a11_eye', 'a12_eye',
        'b1_eye', 'b2_eye', 'b3_eye', 'b4_eye', 'b5_eye', 'b6_eye', 'b7_eye', 'b8_eye', 'b9_eye', 'b10_eye', 'b11_eye', 'b12_eye',
        'c1_eye', 'c2_eye', 'c3_eye', 'c4_eye', 'c5_eye', 'c6_eye', 'c7_eye', 'c8_eye', 'c9_eye', 'c10_eye', 'c11_eye', 'c12_eye'
   
    ];

    $pengecekan = Pengecekan::where('no_gs', $no_gs)->firstOrFail();
    // Mengecek apakah ada input tanda tangan dan data tidak kosong
    if ($request->has('signature') && !empty($request->input('signature'))) {
        // Jika ada data tanda tangan baru, simpan gambar tanda tangan yang baru
        $signatureData = $request->input('signature');
        $signatureData = str_replace('data:image/png;base64,', '', $signatureData);
        $signatureData = base64_decode($signatureData);

        // Menentukan nama file berdasarkan waktu
        $signatureFileName = 'signature_' . time() . '.png';
        Storage::disk('public')->put('signatures/' . $signatureFileName, $signatureData);

        // Menyimpan path file tanda tangan baru
        $validatedData['signature'] = 'storage/signatures/' . $signatureFileName;
    } else {
        // Jika tidak ada tanda tangan baru, pertahankan tanda tangan yang lama
        if ($pengecekan->signature) {
            // Jika tanda tangan sudah ada, tidak mengubah apa-apa
            $validatedData['signature'] = $pengecekan->signature;
        }
    }

    if ($request->has('signature1') && !empty($request->input('signature1'))) {
        // Jika ada data tanda tangan baru untuk signature1, simpan gambar tanda tangan yang baru
        $signatureData1 = $request->input('signature1');
        $signatureData1 = str_replace('data:image/png;base64,', '', $signatureData1);
        $signatureData1 = base64_decode($signatureData1);

        // Menentukan nama file berdasarkan waktu
        $signatureFileName1 = 'signature1_' . time() . '.png';
        Storage::disk('public')->put('signatures/1/' . $signatureFileName1, $signatureData1);

        // Menyimpan path file tanda tangan baru
        $validatedData['signature1'] = 'storage/signatures/1/' . $signatureFileName1;
    } else {
        // Jika tidak ada tanda tangan baru, pertahankan tanda tangan yang lama
        if ($pengecekan->signature1) {
            // Jika tanda tangan sudah ada, tidak mengubah apa-apa
            $validatedData['signature1'] = $pengecekan->signature1;
        }
    }

    foreach ($fields as $field) {
        if (!array_key_exists($field, $validatedData)) {
            $validatedData[$field] = null;
        }
    }

    // Update data di model Pengecekan
    $pengecekan->update($validatedData);

    // Update data di model MapCoil
    $mapCoil = MapCoilTruck::where('no_gs', $no_gs)->firstOrFail();
    $mapCoil->update($validatedData);

    // Redirect ke halaman sukses
    return redirect()->back();
    // return redirect(url('prints/' . $validatedData['no_gs']));
}
}
