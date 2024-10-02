<?php

namespace App\Http\Controllers;

use App\Models\TraillerM;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TraillerController extends Controller
{
    public function index() {
        if(Auth::user()->role == 0){
            $data = TraillerM::paginate(10); // 10 items per page

        }else{
            $data = TraillerM::where('user_id', Auth::user()->id)->paginate(10); // 10 items per page

        }
        return view('Form-Check.pages.trailler.index', compact('data'));
    }
    

    public function add (){
        return view('Form-Check.pages.trailler.add');
    }
    public function create(Request $request)
{
    // dd($request->all());
    $validatedData = $request->validate([
        'user_id' => 'required|exists:users,id',
        'shift_leader' => 'nullable|string',
        'mtc_name' => 'nullable|string',
        'jenis_forklift' => 'nullable|string',
        'date' => 'nullable|date',
        'carrier' => 'nullable|string',
        'rantai' => 'nullable|string',
        'ban' => 'nullable|string',
        'cadangan' => 'nullable|string',
        'sein' => 'nullable|string',
        'rotating' => 'nullable|string',
        'stop' => 'nullable|string',
        'utama' => 'nullable|string',
        'kota' => 'nullable|string',
        'connector' => 'nullable|string',
        'accu' => 'nullable|string',
        'coolant' => 'nullable|string',
        'parking' => 'nullable|string',
        'brake' => 'nullable|string',
        'horn' => 'nullable|string',
        'mundur' => 'nullable|string',
        'clamp' => 'nullable|string',
        'terpal' => 'nullable|string',
        'rantai_pe' => 'nullable|string',
        'ganjal' => 'nullable|string',
        'pallet' => 'nullable|string',
        'apar' => 'nullable|string',
        'p3k' => 'nullable|string',
        'fancing' => 'nullable|string',
        'triangle' => 'nullable|string',
        'tools' => 'nullable|string',
        'catatan' => 'nullable|string',
        
        // Nullable ket fields
        'ket_carrier' => 'nullable|string',
        'ket_rantai' => 'nullable|string',
        'ket_ban' => 'nullable|string',
        'ket_cadangan' => 'nullable|string',
        'ket_sein' => 'nullable|string',
        'ket_rotating' => 'nullable|string',
        'ket_stop' => 'nullable|string',
        'ket_utama' => 'nullable|string',
        'ket_kota' => 'nullable|string',
        'ket_connector' => 'nullable|string',
        'ket_accu' => 'nullable|string',
        'ket_coolant' => 'nullable|string',
        'ket_parking' => 'nullable|string',
        'ket_brake' => 'nullable|string',
        'ket_horn' => 'nullable|string',
        'ket_mundur' => 'nullable|string',
        'ket_clamp' => 'nullable|string',
        'ket_terpal' => 'nullable|string',
        'ket_rantai_pe' => 'nullable|string',
        'ket_ganjal' => 'nullable|string',
        'ket_pallet' => 'nullable|string',
        'ket_apar' => 'nullable|string',
        'ket_p3k' => 'nullable|string',
        'ket_fancing' => 'nullable|string',
        'ket_triangle' => 'nullable|string',
        'ket_tools' => 'nullable|string',
    ]);

    TraillerM::create($validatedData);

    if(Auth::user()->role == 0){

        return redirect()->route('Form-Check.admin.trailler')->with('success', 'Trailler record saved successfully.');
    }else{
        return redirect()->route('Form-Check.pegawai.trailler')->with('success', 'Trailler record saved successfully.');
    }
}

    public function print($id){
        $data = TraillerM::FindOrFail($id);
        return view('Form-Check.pages.trailler.print',compact('data'));
    }
}
