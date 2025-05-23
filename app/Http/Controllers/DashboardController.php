<?php

namespace App\Http\Controllers;

use App\Models\Coil;
use App\Models\MapCoil;
use App\Models\MapCoilTruck;
use App\Models\Pengecekan;
use App\Models\Shipment;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
{
    // $errorin;

    $search = $request->input('search');
    $start = $request->input('start');
    $end = $request->input('end');

    // Query builder to handle both filters
    $query = Shipment::query();

    // Apply search filter
    if ($search) {
        $query->where('no_gs', 'like', '%' . $search . '%'); // Adjust 'no_gs' based on your table column
    }

    // Apply date range filter
    if ($start && $end) {
        $query->whereBetween('created_at', [$start, $end]);
    }

    $data = $query->latest()->get();

    return view('Mapping-Container.content.dashboard.indexss', compact('data',));
}

    public function show($id)
    {
        // Mengambil data Shipment berdasarkan id
        $data = Shipment::where('id',$id)->get();
        $same = Shipment::where('id',$id)->value('no_gs');
        $coil = Coil::where('no_gs', $same)->get();
        $pengecekan = Pengecekan::where('no_gs',$same)->value('pembeda');
    
        // Mengembalikan view dengan data Shipment yang diambil
        return view('Mapping-Container.content.dashboard.index', compact('data','coil','pengecekan'));
    }

    public function create($gs){
        
        return view('Mapping-Container.content.dashboard.create',compact('gs'));
    }
    public function store(Request $request){
        // dd($request->all());
        $validatedData = $request->validate([
            'no_gs' => 'required|string',
            'tgl_gs' => 'nullable|date',
            'no_so' => 'nullable|string',
            'no_po' => 'nullable|string',
            'no_do' => 'nullable|string',
            'no_container' => 'nullable|string',
            'no_seal' => 'nullable|string',
            'no_mobil' => 'nullable|string',
            'forwarding' => 'nullable|string',
            'kepada' => 'nullable|string',
            'alamat_pengirim' => 'nullable|string',
            'alamat_tujuan' => 'nullable|string',
            'tare' => 'nullable|integer',
            ]
        );

        $ids = Shipment::where('no_gs',$request->no_gs)->value('id');

        $shipment = Shipment::find($ids);
        $shipment->tgl_gs = $request->tgl_gs;
        $shipment->no_so = $request->no_so;
        $shipment->no_po = $request->no_po;
        $shipment->no_do = $request->no_do;
        $shipment->no_container = $request->no_container;
        $shipment->no_seal = $request->no_seal;
        $shipment->no_mobil = $request->no_mobil;
        $shipment->forwarding = $request->forwarding;
        $shipment->kepada = $request->kepada;
        $shipment->alamat_pengirim = $request->alamat_pengirim;
        $shipment->alamat_tujuan = $request->alamat_tujuan;
        $shipment->tare = $request->tare;

        $shipment->save();


        return redirect()->route('Mapping.admin.shipment');


    }

    public function destroy($id){
        $data = Shipment::where('no_gs',$id)->delete();
        $coil = Coil::where('no_gs',$id)->delete();
        $pengecekan = MapCoil::where('no_gs',$id)->delete();
        $pengecekantruck = MapCoilTruck::where('no_gs',$id)->delete();
        $cek = Pengecekan::where('no_gs',$id)->delete();
        return redirect()->back()->with('success','Shipment has been deleted');
    }




    
}
