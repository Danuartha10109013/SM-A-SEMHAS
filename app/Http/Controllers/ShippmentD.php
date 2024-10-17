<?php

namespace App\Http\Controllers;

use App\Imports\ShippmentAImport;
use App\Imports\ShippmentBImport;
use App\Imports\ShippmentDImport;
use App\Models\ShipD;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel; // Import this

use function PHPSTORM_META\type;

class ShippmentD extends Controller
{
    public function index(Request $request){
        $search = $request->search;
        if ($search) {
            $data = ShipD::where('type', 'LIKE', '%' . $search . '%')->select('type')->distinct()->get();
        } else {
            // If no search query, retrieve distinct 'type' values
            $data = ShipD::select('type')->distinct()->get();
        }
        return view('pegawai.shippmentd.index', compact('data','search'));
    }

    public function add(){
        $lastRecord = ShipD::where('type', 'LIKE', 'B00%')->orderBy('type', 'desc')->first();

        if ($lastRecord) {
            // Extract the numeric part of the type and increment it by 1
            $lastTypeNumber = intval(substr($lastRecord->type, 2));
            $newType = 'B00' . ($lastTypeNumber + 1);
        } else {
            // If no previous record exists, start with '001'
            $newType = 'B001';
        }
        return view('pegawai.shippmentd.add',compact('newType'));
    }
    public function storea(Request $request)
    {
        $validated = $request->validate([
            'atribute' => 'required',
            'destination' => 'required',
            'size' => 'required',
            'type' => 'required',
            'unicode' => 'required',
        ]);

        ShipD::create($validated);
        if(Auth::user()->role == 0){

            return redirect()->route('Ship-Mark.admin.shipment-d')->with('success', 'Shippment added successfully');
        }else{
            
            return redirect()->route('Ship-Mark.pegawai.shipment-d')->with('success', 'Shippment added successfully');
        }

    }

    public function edit($id)
    {
        $shippmentA = ShipD::findOrFail($id); // Fetch the specific record

        return view('pegawai.shippmentd.edit', compact('shippmentA')); // Pass the data to the view
    }

    // Update the specified resource in storage
    public function update(Request $request, $id)
    {
        // dd($request->all());
        $back= ShipD::where('id', $id)->value('type');
        // Validate the incoming request
        $request->validate([
            'unicode' => 'required',
            'atribute' => 'required',
            'size' => 'required',
            'destination' => 'required',
            'type' => 'required',
        ]);

        // Find the specific ShippmentA and update the record
        $shippmentA = ShipD::findOrFail($id);
        $shippmentA->update($request->all());
        if(Auth::user()->role == 0){

            return redirect()->route('Ship-Mark.admin.shipment-d-show',$back)->with('success', 'ShippmentA updated successfully');
        }else{

            return redirect()->route('Ship-Mark.pegawai.shipment-d-show',$back)->with('success', 'ShippmentA updated successfully');
        }

    }

    public function show(Request $request,$id){
        $search = $request->search;
        if ($search) {
            $data = ShipD::where('type', $id)->where('atribute', 'LIKE', '%' . $search . '%')->get();
        } else {
            // If no search query, retrieve distinct 'type' values
            $data = ShipD::where('type', $id)->get();
        }
        $type= ShipD::select('type')->distinct()->where('type',$id)->value('type');
        return view('pegawai.shippmentd.show', compact('data','type','id','search'));
    }

    public function print($id){
        $data = ShipD::where('type', $id)->get();
        $type= ShipD::select('type')->distinct()->where('type',$id)->pluck('type');
        return view('pegawai.shippmentd.print', compact('data','type'));

    }
    public function printone($id){
        $data = ShipD::where('atribute', $id)->get();
        $type= ShipD::select('type')->distinct()->where('type',$id)->pluck('type');
        return view('pegawai.shippmentd.print', compact('data','type'));

    }

    public function store(Request $request){
        // dd($request->all());

        // Validasi file input
        $request->validate([
            'shipmentb' => 'required|file|mimes:xlsx,xls|max:2048',
            'satuan_berat' => 'required'
        ]);

        // Find the last type in the database and increment it by 1
        $lastRecord = ShipD::where('type', 'LIKE', 'B00%')->orderBy('type', 'desc')->first();

        if ($lastRecord) {
            // Extract the numeric part of the type and increment it by 1
            $lastTypeNumber = intval(substr($lastRecord->type, 2));
            $newType = 'B00' . ($lastTypeNumber + 1);
        } else {
            // If no previous record exists, start with '001'
            $newType = 'B001';
        }


        // Proses file Excel (misalnya, menggunakan Laravel Excel)
        Excel::import(new ShippmentDImport($request->satuan_berat,$newType),$request->file('shipmentb'));
;
        if(Auth::user()->role == 0){

            return redirect()->route('Ship-Mark.admin.shipment-d')->with('success', 'Data berhasil ditambahkan');
        }else{

            return redirect()->route('Ship-Mark.pegawai.shipment-d')->with('success', 'Data berhasil ditambahkan');
        }

    }

    public function destroy($id)
    {
        $back= ShipD::where('id', $id)->value('type');
        $shippmenta = ShipD::findOrFail($id);
        $shippmenta->delete();

        if(Auth::user()->role == 0){

            return redirect()->route('Ship-Mark.admin.shipment-d-show',$back)->with('success', 'Shippmenta deleted successfully');
        }else{

            return redirect()->route('Ship-Mark.pegawai.shipment-d-show',$back)->with('success', 'Shippmenta deleted successfully');
        }

    }
    public function destroyA($type)
    {
        $back= ShipD::where('id', $type)->value('type');

        $shippmenta = ShipD::findOrFail($type);
        $shippmenta->delete();

        if(Auth::user()->role == 0){

            return redirect()->route('Ship-Mark.admin.shipment-d')->with('success', 'Shippmenta deleted successfully');
        }else{

            return redirect()->route('Ship-Mark.pegawai.shipment-d')->with('success', 'Shippmenta deleted successfully');
        }

    }
}
