<?php

namespace App\Http\Controllers;

use App\Imports\ShippmentAImport;
use App\Models\ShipA;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel; // Import this

use function PHPSTORM_META\type;

class ShippmentA extends Controller
{
    public function index(Request $request)
    {
        // Get the search query from the request
        $search = $request->input('search');

        // Check if there's a search query, if so filter based on the 'type' field
        if ($search) {
            $data = ShipA::where('type', 'LIKE', '%' . $search . '%')->select('type')->distinct()->get();
        } else {
            // If no search query, retrieve distinct 'type' values
            $data = ShipA::select('type')->distinct()->get();
        }

        // Return the view with the filtered or default data
        return view('pegawai.shippment.index', compact('data','search'));
    }


    public function add(){
        $lastRecord = ShipA::where('type', 'LIKE', '00%')->orderBy('type', 'desc')->first();

        return view('pegawai.shippment.add');
    }
    public function storea(Request $request)
    {
        // dd($request->all());
        $validated = $request->validate([
            'atribute' => 'required|unique:shippmenta,atribute',
            'unicode' => 'required',
            'size' => 'required',
            'weight' => 'required|integer',
            'satuan_berat' => 'required',
            'destination' => 'required',
            'type' => 'required',
        ]);

        ShipA::create($validated);

        if(Auth::user()->role == 0){
            return redirect()->route('Ship-Mark.admin.shipment-a')->with('success', 'Shippment added successfully');
        }else{

            return redirect()->route('Ship-Mark.pegawai.shipment-a')->with('success', 'Shippment added successfully');
        }
    }

    public function edit($id)
    {
        $shippmentA = ShipA::findOrFail($id); // Fetch the specific record

        return view('pegawai.shippment.edit', compact('shippmentA')); // Pass the data to the view
    }

    // Update the specified resource in storage
    public function update(Request $request, $id)
    {
        $back= ShipA::where('id', $id)->value('type');
        // Validate the incoming request
        $request->validate([
            'atribute' => 'required', // Ignore current record's atribute
            'unicode' => 'required',
            'size' => 'required',
            'weight' => 'required|integer',
            'satuan_berat' => 'required',
            'destination' => 'required',
            'type' => 'required',
        ]);

        // Find the specific ShippmentA and update the record
        $shippmentA = ShipA::findOrFail($id);
        $shippmentA->update($request->all());

        if(Auth::user()->role == 0){
            return redirect()->route('Ship-Mark.admin.shipment-a-show',$back)->with('success', 'ShippmentA updated successfully');
        }else{

            return redirect()->route('Ship-Mark.pegawai.shipment-a-show',$back)->with('success', 'ShippmentA updated successfully');
        }
    }

    public function show(Request $request,$id){
        $search = $request->search;
        if ($search) {
            $data = ShipA::where('type', $id)->where('atribute', 'LIKE', '%' . $search . '%')->get();
        } else {
            // If no search query, retrieve distinct 'type' values
            $data = ShipA::where('type', $id)->get();
        }
        $type= ShipA::select('type')->distinct()->where('type',$id)->value('type');
        return view('pegawai.shippment.show', compact('data','type','id','search'));
    }

    public function print($id){
        $data = ShipA::where('type', $id)->get();
        $type= ShipA::select('type')->distinct()->where('type',$id)->pluck('type');
        return view('pegawai.shippment.print', compact('data','type'));

    }
    public function printone($id){
        $data = ShipA::where('atribute', $id)->get();
        $type= ShipA::select('type')->distinct()->where('type',$id)->pluck('type');
        return view('pegawai.shippment.print', compact('data','type'));

    }

    public function store(Request $request){
        // Validasi file input
        // dd($request->all());
        $request->validate([
            'shipmenta' => 'required|file|mimes:xlsx,xls|max:2048',
            'satuan_berat' => 'required'
        ]);

        // Find the last type in the database and increment it by 1
        $lastRecord = ShipA::where('type', 'LIKE', '00%')->orderBy('type', 'desc')->first();

        if ($lastRecord) {
            // Extract the numeric part of the type and increment it by 1
            $lastTypeNumber = intval(substr($lastRecord->type, 2));
            $newType = '00' . ($lastTypeNumber + 1);
        } else {
            // If no previous record exists, start with '001'
            $newType = '001';
        }


        // Proses file Excel (misalnya, menggunakan Laravel Excel)
        Excel::import(new ShippmentAImport($request->satuan_berat,$newType),$request->file('shipmenta'));
;
        // dd($request->all());

        if(Auth::user()->role == 0){
            return redirect()->route('Ship-Mark.admin.shipment-a')->with('success', 'Data berhasil ditambahkan');
        }else{

            return redirect()->route('Ship-Mark.pegawai.shipment-a')->with('success', 'Data berhasil ditambahkan');
        }
    }

    public function destroy($id)
    {
        $back= ShipA::where('id', $id)->value('type');
        $shippmenta = ShipA::findOrFail($id);
        $shippmenta->delete();

        if(Auth::user()->role == 0){
            return redirect()->route('Ship-Mark.admin.shipment-a-show',$back)->with('success', 'Shippmenta deleted successfully');
        }else{

            return redirect()->route('Ship-Mark.pegawai.shipment-a-show',$back)->with('success', 'Shippmenta deleted successfully');
        }
    }
    public function destroyA($type)
    {
        $back= ShipA::where('id', $type)->value('type');

        $shippmenta = ShipA::findOrFail($type);
        $shippmenta->delete();

        if(Auth::user()->role == 0){
            return redirect()->route('Ship-Mark.admin.shipment-a')->with('success', 'Shippmenta deleted successfully');
        }else{

            return redirect()->route('Ship-Mark.pegawai.shipment-a')->with('success', 'Shippmenta deleted successfully');
        }
    }
}
