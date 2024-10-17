<?php

namespace App\Http\Controllers;

use App\Models\PackingM;
use Illuminate\Http\Request;

class OpenPackController extends Controller
{
    public function index(){
        // Select unique 'gm' and aggregate other fields
        $data = PackingM::selectRaw('gm, 
                                MIN(attribute) as attribute,
                                count(attribute) as total,  
                                MIN(b_label) as b_label, 
                                MIN(b_aktual) as b_aktual, 
                                MIN(selisih) as selisih, 
                                MIN(persentase) as persentase, 
                                MIN(stiker) as stiker, 
                                MIN(keterangan) as keterangan, 
                                MIN(created_at) as created_at')
                        ->groupBy('gm')
                        ->get();

        

        return view('Open-Packing.pages.admin.packing.index', compact('data'));
    }
    

    public function add()
    {
        return view('Open-Packing.pages.admin.packing.add');
    }

    public function store(Request $request){
        $request->validate([
            'gm' => 'required|string|max:255',
        ]);

        PackingM::create([
            'gm' => $request->gm,
        ]);

        return redirect()->route('Open-Packing.admin.packing')->with('success','GM Has Been created');
    }

    public function add_gm($gm){
        return view('Open-Packing.pages.admin.packing.add-gm',compact('gm'));
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
        

        return redirect()->route('Open-Packing.admin.packing')->with('success','Product Has Been created');
    }

    public function show($gm)
    {
        $data = PackingM::where('gm', $gm)->whereNotNull('attribute')->get();
        return view('Open-Packing.pages.admin.packing.show',compact('data','gm'));
    }

    public function edit($id){
        $data = PackingM::find($id);
        return view('Open-Packing.pages.admin.packing.edit',compact('data'));
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

        return redirect()->route('Open-Packing.admin.packing.show',$request->gm)->with('success','Product Updated');
    }

    public function delete($id){
        PackingM::find($id)->delete();

        return redirect()->back()->with('success', 'Data has been deleted');
    }

    public function print($gm){
        $data = PackingM::where('gm', $gm)->whereNotNull('attribute')->get();

        $date = PackingM::where('gm',$gm)->value('created_at');

        return view('Open-Packing.pages.admin.packing.print',compact('data','date'));
    }
}
