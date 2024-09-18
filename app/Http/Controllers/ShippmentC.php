<?php

namespace App\Http\Controllers;

use App\Imports\ShippmentAImport;
use App\Imports\ShippmentBImport;
use App\Imports\ShippmentCImport;
use App\Models\ShipC;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel; // Import this

use function PHPSTORM_META\type;

class ShippmentC extends Controller
{
    public function index(){
        $data  = ShipC::select('type')->distinct()->get();
        // dd($pembeda);
        // $data = ShipC::where('type',$pembeda)->get();
        return view('pegawai.shippmentc.index', compact('data'));
    }

    public function add(){
        $lastRecord = ShipC::where('type', 'LIKE', 'B00%')->orderBy('type', 'desc')->first();

        if ($lastRecord) {
            // Extract the numeric part of the type and increment it by 1
            $lastTypeNumber = intval(substr($lastRecord->type, 2));
            $newType = 'B00' . ($lastTypeNumber + 1);
        } else {
            // If no previous record exists, start with '001'
            $newType = 'B001';
        }
        return view('pegawai.shippmentc.add',compact('newType'));
    }
    public function storea(Request $request)
    {
        $validated = $request->validate([
            'atribute' => 'required',
            'unicode' => 'required',
            'pod' => 'required',
            'product' => 'required',
            'size' => 'required',
            'gros' => 'required',
            'net' => 'required',
            'satuan_berat' => 'required',
            'type' => 'required',
            'manufactur' => 'required',
        ]);

        ShipC::create($validated);

        return redirect()->route('pegawai.shipment-c')->with('success', 'Shippment added successfully');
    }

    public function edit($id)
    {
        $shippmentA = ShipC::findOrFail($id); // Fetch the specific record

        return view('pegawai.shippmentc.edit', compact('shippmentA')); // Pass the data to the view
    }

    // Update the specified resource in storage
    public function update(Request $request, $id)
    {
        // dd($request->all());
        $back= ShipC::where('id', $id)->value('type');
        // Validate the incoming request
        $request->validate([
            'unicode' => 'required',
            'pod' => 'required',
            'atribute' => 'required',
            'product' => 'required',
            'size' => 'required',
            'gros' => 'required',
            'net' => 'required',
            'satuan_berat' => 'required',
            'type' => 'required',
        ]);

        // Find the specific ShippmentA and update the record
        $shippmentA = ShipC::findOrFail($id);
        $shippmentA->update($request->all());

        return redirect()->route('pegawai.shipment-c-show',$back)->with('success', 'ShippmentC updated successfully');
    }

    public function show($id){
        $data = ShipC::where('type', $id)->get();
        $type= ShipC::select('type')->distinct()->where('type',$id)->value('type');
        return view('pegawai.shippmentc.show', compact('data','type'));
    }

    public function print($id){
        $data = ShipC::where('type', $id)->get();
        $type= ShipC::select('type')->distinct()->where('type',$id)->pluck('type');
        return view('pegawai.shippmentc.print', compact('data','type'));

    }
    public function printone($id){
        $data = ShipC::where('atribute', $id)->get();
        $type= ShipC::select('type')->distinct()->where('type',$id)->pluck('type');
        return view('pegawai.shippmentc.print', compact('data','type'));

    }

    public function store(Request $request){
        // dd($request->all());

        // Validasi file input
        $request->validate([
            'shipmentb' => 'required|file|mimes:xlsx,xls|max:2048',
            'satuan_berat' => 'required'
        ]);

        // Find the last type in the database and increment it by 1
        $lastRecord = ShipC::where('type', 'LIKE', 'B00%')->orderBy('type', 'desc')->first();

        if ($lastRecord) {
            // Extract the numeric part of the type and increment it by 1
            $lastTypeNumber = intval(substr($lastRecord->type, 2));
            $newType = 'B00' . ($lastTypeNumber + 1);
        } else {
            // If no previous record exists, start with '001'
            $newType = 'B001';
        }


        // Proses file Excel (misalnya, menggunakan Laravel Excel)
        Excel::import(new ShippmentCImport($request->satuan_berat,$newType),$request->file('shipmentb'));
;

        return redirect()->route('pegawai.shipment-c')->with('success', 'Data berhasil ditambahkan');
    }

    public function destroy($id)
    {
        $back= ShipC::where('id', $id)->value('type');
        $shippmenta = ShipC::findOrFail($id);
        $shippmenta->delete();

        return redirect()->route('pegawai.shipment-c-show',$back)->with('success', 'Shippmenta deleted successfully');
    }
    public function destroyA($type)
    {
        $back= ShipC::where('id', $type)->value('type');

        $shippmenta = ShipC::findOrFail($type);
        $shippmenta->delete();

        return redirect()->route('pegawai.shipment-c')->with('success', 'Shippmenta deleted successfully');
    }
}
