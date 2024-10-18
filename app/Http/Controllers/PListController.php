<?php

namespace App\Http\Controllers;

use App\Models\DatabM;
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
        'tujuan'=>'required|string|max:255',
        'other_keterangan' => 'nullable|string',
        'panjang'=>'required|integer',
    ]);
    if($request->keterangan == "other"){
        ScanM::create([
            'attribute' => $request->input('attribute'),
            'kondisi' => $request->input('kondisi'),
            'keterangan' => $request->input('other_keterangan'),
            'tujuan' => $request->input('tujuan'),
            'panjang' => $request->input('panjang'),
            'user_id' => Auth::user()->id,
        ]);
        
    }else{
        ScanM::create([
            'attribute' => $request->input('attribute'),
            'kondisi' => $request->input('kondisi'),
            'keterangan' => $request->input('keterangan'),
            'tujuan' => $request->input('tujuan'),
            'panjang' => $request->input('panjang'),
            'user_id' => Auth::user()->id,
        ]);
    }
    
    // Redirect back with a success message
    if (Auth::user()->role == 0) {
        return redirect()->route('Packing-List.admin.list', 'Supply created successfully!');
    } else {
        return redirect()->route('Packing-List.pegawai.list')->with('success', 'Supply created successfully!');
    }
}

    
    


    public function add_gm($gm){
        return view('Packing-List.pages.admin.list.add-gm',compact('gm'));
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
        return view('Packing-List.pages.admin.list.show',compact('data','gm'));
    }

    public function edit($id){
        $data = ScanM::find($id);
        return view('Packing-List.pages.admin.list.edit',compact('data'));
    }


    public function update(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'attribute' => 'required|string',
            'kondisi' => 'required|string',
            'tujuan' => 'required|string',
            'keterangan' => 'required|string',
            'other_keterangan' => 'nullable|string',
            'panjang' => 'required|numeric',
        ]);

        // Find the existing PackingList data (assuming you pass an id in the form)
        $packingList = ScanM::findOrFail($request->id);

        // Update the packing list data
        $packingList->attribute = $request->attribute;
        $packingList->kondisi = $request->kondisi;
        $packingList->tujuan = $request->tujuan;
        if($request->keterangan == "other"){

            $packingList->keterangan = $request->other_keterangan;
        }else{
            $packingList->keterangan = $request->keterangan;
        }
        $packingList->panjang = $request->panjang;

        // Save the updated data
        $packingList->save();

        // Redirect with a success message
        return redirect()->route('Packing-List.admin.list')->with('success', 'Packing List updated successfully.');
    }
    
    

    public function delete($id){
        PackingM::find($id)->delete();

        return redirect()->back()->with('success', 'Data has been deleted');
    }

    public function print($gm){
        $data = SupplyM::find($gm);

        $date = PackingM::where('gm',$gm)->value('created_at');

        return view('Packing-List.pages.admin.list.print',compact('data','date'));
    }

    public function db(){
        $data = DatabM::all();
        return view('Packing-List.pages.admin.database.index',compact('data'));
    }
    
    public function hasil(){
        $data = DatabM::all();

        return view('Packing-List.pages.admin.hasil.index',compact('data'));
    }
}
