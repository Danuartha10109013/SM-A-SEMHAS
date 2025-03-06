<?php

namespace App\Http\Controllers;

use App\Imports\ShippmentAImport;
use App\Imports\ShippmentBImport;
use App\Imports\ShippmentDImport;
use App\Imports\ShippmentEImport;
use App\Models\ShipE;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel; // Import this

use function PHPSTORM_META\no_so;

class ShippmentE extends Controller
{
    public function index(Request $request){
        $search = $request->search;
        if ($search) {
            $data = ShipE::where('no_so', 'LIKE', '%' . $search . '%')->select('no_so')->distinct()->get();
        } else {
            // If no search query, retrieve distinct 'no_so' values
            $data = ShipE::select('no_so')->distinct()->get();
        }
        return view('pegawai.shippmente.index', compact('data','search'));
    }

    public function add(){
        $lastRecord = ShipE::where('no_so', 'LIKE', 'B00%')->orderBy('no_so', 'desc')->first();

        if ($lastRecord) {
            // Extract the numeric part of the type and increment it by 1
            $lastTypeNumber = intval(substr($lastRecord->no_so, 2));
            $newType = 'B00' . ($lastTypeNumber + 1);
        } else {
            // If no previous record exists, start with '001'
            $newType = 'B001';
        }
        return view('pegawai.shippmente.add',compact('newType'));
    }
    public function storea(Request $request)
    {
        // dd($request->all());
        $validated = $request->validate([
            'attribute' => 'required',
            'name' => 'required',
            'no_so' => 'required',
            'product' => 'required',
            'pod' => 'required',
            'weight' => 'required',
            'satuan_berat' => 'required',
        ]);

        ShipE::create($validated);
        if(Auth::user()->role == 0){

            return redirect()->route('Ship-Mark.admin.shipment-e')->with('success', 'Shippment added successfully');
        }else{
            
            return redirect()->route('Ship-Mark.pegawai.shipment-e')->with('success', 'Shippment added successfully');
        }

    }

    public function edit($id)
    {
        $shippmentA = ShipE::findOrFail($id); // Fetch the specific record

        return view('pegawai.shippmente.edit', compact('shippmentA')); // Pass the data to the view
    }

    // Update the specified resource in storage
    public function update(Request $request, $id)
    {
        // dd($request->all());
        $back= ShipE::where('id', $id)->value('no_so');
        // Validate the incoming request
        $request->validate([
            'name' => 'required',
            'attribute' => 'required',
            'pod' => 'required',
            'weight' => 'required',
            'satuan_berat' => 'required',
            'no_so' => 'required',
        ]);

        // Find the specific ShippmentA and update the record
        $shippmentA = ShipE::findOrFail($id);
        $shippmentA->update($request->all());
        if(Auth::user()->role == 0){

            return redirect()->route('Ship-Mark.admin.shipment-e-show',$back)->with('success', 'ShippmentA updated successfully');
        }else{

            return redirect()->route('Ship-Mark.pegawai.shipment-e-show',$back)->with('success', 'ShippmentA updated successfully');
        }

    }

    public function show(Request $request,$id){
        $search = $request->search;
        if ($search) {
            $data = ShipE::where('no_so', $id)->where('atribute', 'LIKE', '%' . $search . '%')->get();
        } else {
            // If no search query, retrieve distinct 'type' values
            $data = ShipE::where('no_so', $id)->get();
        }
        $type= ShipE::select('no_so')->distinct()->where('no_so',$id)->value('no_so');
        return view('pegawai.shippmente.show', compact('data','type','id','search'));
    }

    public function print($id){
        $data = ShipE::where('no_so', $id)->get();
        $type= ShipE::select('no_so')->distinct()->where('no_so',$id)->pluck('no_so');
        // dd($type);
        
        return view('pegawai.shippmente.print', compact('data','type'));

    }
    public function printone($id){
        $data = ShipE::where('id', $id)->get();
        $type= ShipE::select('no_so')->distinct()->where('no_so',$id)->pluck('no_so');
        return view('pegawai.shippmente.print', compact('data','type'));

    }

    public function store(Request $request){
        // dd($request->all());

        // Validasi file input
        $request->validate([
            'shipmentb' => 'required|file|mimes:xlsx,xls|max:2048',
            'satuan_berat' => 'required'
        ]);

        // Find the last type in the database and increment it by 1
        $lastRecord = ShipE::where('no_so', 'LIKE', 'B00%')->orderBy('no_so', 'desc')->first();

        if ($lastRecord) {
            // Extract the numeric part of the type and increment it by 1
            $lastTypeNumber = intval(substr($lastRecord->type, 2));
            $newType = 'B00' . ($lastTypeNumber + 1);
        } else {
            // If no previous record exists, start with '001'
            $newType = 'B001';
        }


        // Proses file Excel (misalnya, menggunakan Laravel Excel)
        Excel::import(new ShippmentEImport($request->satuan_berat,$newType),$request->file('shipmentb'));
;
        if(Auth::user()->role == 0){

            return redirect()->route('Ship-Mark.admin.shipment-e')->with('success', 'Data berhasil ditambahkan');
        }else{

            return redirect()->route('Ship-Mark.pegawai.shipment-e')->with('success', 'Data berhasil ditambahkan');
        }

    }

    public function destroy($id)
    {
        $back= ShipE::where('id', $id)->value('no_so');
        $shippmenta = ShipE::findOrFail($id);
        $shippmenta->delete();

        if(ShipE::where('id', $id)->value('no_so')== null ){
            return redirect()->route('Ship-Mark.admin.shipment-e')->with('success', 'Data pada '. $back . 'Dihapus semua');
        }
        if(Auth::user()->role == 0){

            return redirect()->route('Ship-Mark.admin.shipment-e-show',$back)->with('success', 'Shippment deleted successfully');
        }else{

            return redirect()->route('Ship-Mark.pegawai.shipment-e-show',$back)->with('success', 'Shippment deleted successfully');
        }

    }
    public function destroyA($type)
    {
        $back= ShipE::where('id', $type)->value('type');

        $shippmenta = ShipE::findOrFail($type);
        $shippmenta->delete();

        if(Auth::user()->role == 0){

            return redirect()->route('Ship-Mark.admin.shipment-e')->with('success', 'Shippmente deleted successfully');
        }else{

            return redirect()->route('Ship-Mark.pegawai.shipment-e')->with('success', 'Shippmente deleted successfully');
        }

    }
}
