<?php

namespace App\Http\Controllers;

use App\Models\PackingM;
use App\Models\ScanM;
use App\Models\SupplyM;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PListController extends Controller
{
    public function index(){
        $data = ScanM::all();
        return view('Packing-List.pages.admin.list.index',compact('data'));
    }

    public function add()
    {
        return view('Packing-List.pages.admin.list.add');
    }

    public function store(Request $request)
{
    // dd($request->all());
    // Validate the request data
    $request->validate([
        'attribute'=>'required|string|max:255',
        'kondisi'=>'required|string|max:255',
        'keterangan'=>'required|string|max:255',
        'panjang'=>'required|integer',
    ]);

    ScanM::create([
        'attribute' => $request->input('attribute'),
        'kondisi' => $request->input('kondisi'),
        'keterangan' => $request->input('keterangan'),
        'panjang' => $request->input('keterangan'),
        'user_id' => Auth::user()->id,
    ]);

    // Redirect back with a success message
    if (Auth::user()->role == 0) {
        return redirect()->route('Packing-List.admin.list', 'Supply created successfully!');
    } else {
        return redirect()->route('Packing-List.pegawai.list')->with('success', 'Supply created successfully!');
    }
}

    
    


    public function add_gm($gm){
        return view('Supply-Bahan.pages.admin.supply.add-gm',compact('gm'));
    }

    public function store_gm(Request $request){
        // dd($request->all());
        $request->validate([
            'gm' => 'required|string|max:255',
            'attribute' => 'required|string|max:255',
            'b_label' => 'required|integer',
            'b_aktual' => 'required|integer',
            'stiker' => 'nullable|string|max:255',
            'keterangan' => 'nullable|string|max:255',
        ]);

        PackingM::create([
            'gm' => $request->gm,
            'attribute' => $request->attribute, // Corrected 'atribute' to 'attribute'
            'b_label' => $request->b_label,
            'b_aktual' => $request->b_aktual,
            'selisih' => $request->b_label - $request->b_aktual, // Corrected calculation
            'persentase' => number_format(($request->b_label * 0.25) / 100, 4), // Increase decimal precision to 4 places
            'stiker' => $request->stiker,
            'keterangan' => $request->keterangan,
        ]);
        

        return redirect()->route('Supply.admin.packing')->with('success','Product Has Been created');
    }

    public function show($gm)
    {
        $data = SupplyM::find($gm);
        return view('Supply-Bahan.pages.admin.supply.show',compact('data','gm'));
    }

    public function edit($id){
        $data = PackingM::find($id);
        return view('Supply-Bahan.pages.admin.supply.edit',compact('data'));
    }

    public function update(Request $request){
        $request->validate([
            'gm' => 'required|string|max:255',
            'attribute' => 'required|string|max:255',
            'b_label' => 'required|integer',
            'b_aktual' => 'required|integer',
            'stiker' => 'nullable|string|max:255',
            'keterangan' => 'nullable|string|max:255',
        ]);

        $data = PackingM::find($request->id);

        $data->gm = $request->gm;
        $data->attribute = $request->attribute;
        $data->b_label = $request->b_label;
        $data->b_aktual = $request->b_aktual;
        $data->selisih = $request->b_label - $request->b_aktual;
        $data->persentase = number_format(($request->b_label * 0.25) / 100, 4);
        $data->stiker = $request->stiker;
        $data->keterangan = $request->keterangan;
        $data->update();

        return redirect()->route('Supply.admin.packing.show',$request->gm)->with('success','Product Updated');
    }

    public function delete($id){
        PackingM::find($id)->delete();

        return redirect()->back()->with('success', 'Data has been deleted');
    }

    public function print($gm){
        $data = SupplyM::find($gm);

        $date = PackingM::where('gm',$gm)->value('created_at');

        return view('Supply-Bahan.pages.admin.supply.print',compact('data','date'));
    }
}
