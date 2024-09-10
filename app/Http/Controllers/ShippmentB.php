<?php

namespace App\Http\Controllers;

use App\Imports\ShippmentAImport;
use App\Imports\ShippmentBImport;
use App\Models\ShipB;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel; // Import this

use function PHPSTORM_META\type;

class ShippmentB extends Controller
{
    public function index(){
        $data  = ShipB::select('type')->distinct()->get();
        // dd($pembeda);
        // $data = ShipB::where('type',$pembeda)->get();
        return view('pegawai.shippmentb.index', compact('data'));
    }

    public function add(){
        $lastRecord = ShipB::where('type', 'LIKE', 'B00%')->orderBy('type', 'desc')->first();

        if ($lastRecord) {
            // Extract the numeric part of the type and increment it by 1
            $lastTypeNumber = intval(substr($lastRecord->type, 2));
            $newType = 'B00' . ($lastTypeNumber + 1);
        } else {
            // If no previous record exists, start with '001'
            $newType = 'B001';
        }
        return view('pegawai.shippmentb.add',compact('newType'));
    }
    public function storea(Request $request)
    {
        $validated = $request->validate([
            'atribute' => 'required',
            'product' => 'required',
            'size' => 'required',
            'gros' => 'required',
            'net' => 'required',
            'satuan_berat' => 'required',
            'destination' => 'required',
            'type' => 'required',
            'manufactur' => 'required',
        ]);

        ShipB::create($validated);

        return redirect()->route('pegawai.shipment-b')->with('success', 'Shippment added successfully');
    }

    public function edit($id)
    {
        $shippmentA = ShipB::findOrFail($id); // Fetch the specific record

        return view('pegawai.shippmentb.edit', compact('shippmentA')); // Pass the data to the view
    }

    // Update the specified resource in storage
    public function update(Request $request, $id)
    {
        // dd($request->all());
        $back= ShipB::where('id', $id)->value('type');
        // Validate the incoming request
        $request->validate([
            'manufactur' => 'required',
            'atribute' => 'required',
            'product' => 'required',
            'size' => 'required',
            'gros' => 'required',
            'net' => 'required',
            'satuan_berat' => 'required',
            'destination' => 'required',
            'type' => 'required',
        ]);

        // Find the specific ShippmentA and update the record
        $shippmentA = ShipB::findOrFail($id);
        $shippmentA->update($request->all());

        return redirect()->route('pegawai.shipment-b-show',$back)->with('success', 'ShippmentA updated successfully');
    }

    public function show($id){
        $data = ShipB::where('type', $id)->get();
        $type= ShipB::select('type')->distinct()->where('type',$id)->value('type');
        return view('pegawai.shippmentb.show', compact('data','type'));
    }

    public function print($id){
        $data = ShipB::where('type', $id)->get();
        $type= ShipB::select('type')->distinct()->where('type',$id)->pluck('type');
        return view('pegawai.shippmentb.print', compact('data','type'));

    }
    public function printone($id){
        $data = ShipB::where('atribute', $id)->get();
        $type= ShipB::select('type')->distinct()->where('type',$id)->pluck('type');
        return view('pegawai.shippmentb.print', compact('data','type'));

    }

    public function store(Request $request){
        // dd($request->all());

        // Validasi file input
        $request->validate([
            'shipmentb' => 'required|file|mimes:xlsx,xls|max:2048',
            'satuan_berat' => 'required'
        ]);

        // Find the last type in the database and increment it by 1
        $lastRecord = ShipB::where('type', 'LIKE', 'B00%')->orderBy('type', 'desc')->first();

        if ($lastRecord) {
            // Extract the numeric part of the type and increment it by 1
            $lastTypeNumber = intval(substr($lastRecord->type, 2));
            $newType = 'B00' . ($lastTypeNumber + 1);
        } else {
            // If no previous record exists, start with '001'
            $newType = 'B001';
        }


        // Proses file Excel (misalnya, menggunakan Laravel Excel)
        Excel::import(new ShippmentBImport($request->satuan_berat,$newType),$request->file('shipmentb'));
;

        return redirect()->route('pegawai.shipment-b')->with('success', 'Data berhasil ditambahkan');
    }

    public function destroy($id)
    {
        $back= ShipB::where('id', $id)->value('type');
        $shippmenta = ShipB::findOrFail($id);
        $shippmenta->delete();

        return redirect()->route('pegawai.shipment-b-show',$back)->with('success', 'Shippmenta deleted successfully');
    }
    public function destroyA($type)
    {
        $back= ShipB::where('id', $type)->value('type');

        $shippmenta = ShipB::findOrFail($type);
        $shippmenta->delete();

        return redirect()->route('pegawai.shipment-b')->with('success', 'Shippmenta deleted successfully');
    }
}
