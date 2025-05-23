<?php

namespace App\Http\Controllers;

use App\Models\Coil;
use App\Models\MapCoil;
use App\Models\Pengecekan;
use App\Models\Shipment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MappingController extends Controller
{
    public function index($id)
    {
        // Mengambil data Shipment berdasarkan id
        $data = Shipment::where('id',$id)->get();
        $same = Shipment::where('id',$id)->value('no_gs');
        $tare = Shipment::where('id',$id)->value('tare');
        // dd($tare);
        $coil = Coil::where('no_gs', $same)->get();
        $tonase = Coil::where('no_gs', $same)->sum('berat_produk');
        $pengecekan = Pengecekan::where('no_gs', $same)->get();
        $maps = MapCoil::where('no_gs', $same)->get();
        // Mengembalikan view dengan data Shipment yang diambil
        return view('Mapping-Container.content.pengecekan.index', compact('data','coil', 'tonase','pengecekan','maps','tare'));
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
        'ekspedisi' => 'nullable|string',
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

        'checker' => 'nullable|string|max:255',
        'signature' => 'nullable|string',
        'signature1' => 'nullable|string',
    ]);

    // Pastikan nilai `eye` yang tidak diisi menjadi null
    $fields = [
        'a1_eye', 'a2_eye', 'a3_eye', 'a4_eye', 'a5_eye',
        'b1_eye', 'b2_eye', 'b3_eye', 'b4_eye', 'b5_eye',
        'c1_eye', 'c2_eye', 'c3_eye', 'c4_eye', 'c5_eye'
    ];


    // dd($request->all());
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

    

    // foreach ($fields as $field) {
    //     if (!array_key_exists($field, $validatedData)) {
    //         $validatedData[$field] = null;
    //     }
    // }

    // $feiel = ['a1', 'a2', 'a3', 'a4', 'a5', 'b1', 'b2', 'b3', 'b4', 'b5', 'c1', 'c2', 'c3', 'c4', 'c5'];

    // foreach ($feiel as $field) {
    //     if ($request->$field) {
    //         $coilin = Coil::where('kode_produk', $request->$field)->value('id');
    //         if ($coilin) {
    //             $coil = Coil::find($coilin);
    //             $coil->status = 1;
    //             $coil->save();
    //         }
    //     }
    // }

    $coil = Coil::where('no_gs',$no_gs)->get();
    foreach($coil as $c){
        $c->status = 1;
        $c->save();
    }
    

    // Update data di model Pengecekan
    $pengecekan->update($validatedData);

    // Update data di model MapCoil
    $mapCoil = MapCoil::where('no_gs', $no_gs)->firstOrFail();
    $mapCoil->update($validatedData);

    // Redirect ke halaman sukses
    return redirect()->back();
    // return redirect(url('prints/' . $validatedData['no_gs']));
}

}
