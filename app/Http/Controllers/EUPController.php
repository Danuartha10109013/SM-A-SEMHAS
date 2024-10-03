<?php

namespace App\Http\Controllers;

use App\Models\EupM;
use App\Models\ForkliftM;
use App\Models\Resin_imageM;
use App\Models\ResinM;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EUPController extends Controller
{
    public function index() {
        if(Auth::user()->role == 0){
            $data = EupM::paginate(10); // 10 items per page
        }else{
            $data = EupM::where('user_id', Auth::user()->id)->paginate(10);
        }
        $suppliers = ['a','b'];
        return view('Form-Check.pages.eup.index', compact('data','suppliers'));
    }

    public function add (){
        return view('Form-Check.pages.eup.add');
    }
    public function create(Request $request)
{
    // dd($request->all());
    // Validate form inputs
    $request->validate([
        'user_id' => 'required',
        'date' => 'required|date',
        'jenis' => 'required',
        'kaki_pallet' => 'array|nullable',
        'permukaan_pallet' => 'nullable',
        'ketebalan_pallet' => 'nullable',
        'paku_pallet' => 'nullable',
        'keluar_pallet' => 'nullable',
        'sesuai' => 'required',
        'action' => 'required',
        'foto7.*' => 'nullable|file|mimes:jpg,png,jpeg|max:2048', // Max 2MB per file
    ]);

    // Handle file uploads
    $uploadedFiles = [];
    if ($request->hasFile('foto7')) {
        foreach ($request->file('foto7') as $file) {
            $date = now()->format('d-m-Y');
            $name = $date . '/' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('eup', $name, 'public');
            $uploadedFiles[] = $name;
        }
    }

    // Create a new record in EupM model
    $crc = new EupM();
    $crc->user_id = $request->user_id;
    $crc->date = $request->date;
    $crc->jenis = $request->jenis;
    $crc->kaki_pallet = implode('|', $request->kaki_pallet ?? []);
    $crc->permukaan_pallet = $request->permukaan_pallet;
    $crc->ketebalan_pallet = $request->ketebalan_pallet;
    $crc->paku_pallet = $request->paku_pallet;
    $crc->keluar_pallet = $request->keluar_pallet;
    $crc->sesuai = $request->sesuai;
    $crc->action = $request->action;
    $crc->foto7 = implode('|', $uploadedFiles); // Store file paths with '|' delimiter

    // Save the CRC record
    $crc->save();

    // Redirect based on user role
    if (Auth::user()->role == 0) {
        return redirect()->route('Form-Check.admin.eup')->with('success', 'Submission completed');
    } else {
        return redirect()->route('Form-Check.pegawai.eup')->with('success', 'Submission completed');
    }
}

public function destroy($id){
    $data = EupM::find($id);
    $data->delete();
    return redirect()->back()->with('success', 'Data berhasil Dihapus');
}

    public function show($id){
        $submission = EupM::find($id);
        return view('Form-Check.pages.eup.show',compact('submission'));
    }

}
    