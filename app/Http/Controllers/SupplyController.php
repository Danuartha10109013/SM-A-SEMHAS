<?php

namespace App\Http\Controllers;

use App\Models\PackingM;
use App\Models\SupplyM;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SupplyController extends Controller
{
    public function index(){
        // Select unique 'gm' and aggregate other fields
        $data = SupplyM::orderBy('created_at', 'desc')->get();
        return view('Supply-Bahan.pages.admin.supply.index', compact('data'));
    }
    

    public function add()
    {
        return view('Supply-Bahan.pages.admin.supply.add');
    }

    public function store(Request $request)
{
    // Validate the request data
    $request->validate([
        'date' => 'required|date',
        'shift_leader' => 'required|string|max:255',
        'shift' => 'required|string|max:255',
        'supply' => 'required|string',
        'foto1' => 'required',
        'foto1.*' => 'image|mimes:jpeg,png,jpg,gif', // Validate each image
    ]);

    // Store uploaded files in 'public/storage/supply' directory
    $uploadedPhotos = [];
    if ($request->hasFile('foto1')) {
        foreach ($request->file('foto1') as $photo) {
            // Generate a unique filename for the file
            $fileName = time() . '_' . $photo->getClientOriginalName();
    
            // Store the file in 'public/storage/supply'
             $photo->storeAs('supply', $fileName, 'public'); // 'public' refers to public/storage
            
            // Add the path to the uploadedPhotos array
            $uploadedPhotos[] = $fileName;
        }
    }
    if ($request->shift_leader == 'other'){

        SupplyM::create([
            'created_at' => $request->input('date'),
            'shift_leader' => $request->input('other_sift_leader'),
            'shift' => $request->input('shift'),
            'supply' => $request->input('supply'),
            'foto' => json_encode($uploadedPhotos), // Save photos as JSON
            'user_id' => Auth::user()->id, // Save the currently authenticated user's ID
        ]);
    }else{
        // Create a new Supply record in the database
        SupplyM::create([
            'created_at' => $request->input('date'),
            'shift_leader' => $request->input('shift_leader'),
            'shift' => $request->input('shift'),
            'supply' => $request->input('supply'),
            'foto' => json_encode($uploadedPhotos), // Save photos as JSON
            'user_id' => Auth::user()->id, // Save the currently authenticated user's ID
        ]);
    }

    // Redirect back with a success message
    if (Auth::user()->role == 0) {
        return redirect()->route('Supply.admin.supply')->with('success', 'Supply created successfully!');
    } else {
        return redirect()->route('Supply.pegawai.supply')->with('success', 'Supply created successfully!');
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
