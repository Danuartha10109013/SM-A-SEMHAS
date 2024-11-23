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
    public function index()
    {

        $data = Shipment::all();
        return view('Mapping-Container.content.dashboard.indexss', compact('data'));

        // return view('layouts.index');
        // return 'ini dashboard';
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

    public function create(){
        return view('Mapping-Container.content.dashboard.create');
    }
    public function store(Request $request){
        // dd($request->all());
        $validatedData = $request->validate([
            'no_gs' => 'required|string',
            'tgl_gs' => 'required|date',
            'no_so' => 'required|string',
            'no_po' => 'required|string',
            'no_do' => 'required|string',
            'no_container' => 'required|string',
            'no_seal' => 'required|string',
            'no_mobil' => 'required|string',
            'forwarding' => 'required|string',
            'Kepada' => 'required|string',
            'alamat_pengirim' => 'required|string',
            'alamat_tujuan' => 'required|string',
            ],
            [
            'no_gs.required' => 'Filed ini Wajib Diisi',
            'tgl_gs.required' => 'Filed ini Wajib Diisi',
            'no_so.required' => 'Filed ini Wajib Diisi',
            'no_po.required' => 'Filed ini Wajib Diisi',
            'no_do.required' => 'Filed ini Wajib Diisi',
            'no_container.required' => 'Filed ini Wajib Diisi',
            'no_seal.required' => 'Filed ini Wajib Diisi',
            'no_mobil.required' => 'Filed ini Wajib Diisi',
            'forwarding.required' => 'Filed ini Wajib Diisi',
            'Kepada.required' => 'Filed ini Wajib Diisi',
            'alamat_pengirim.required' => 'Filed ini Wajib Diisi',
            'alamat_tujuan.required' => 'Filed ini Wajib Diisi',
            ]
        );

        $shipment = new Shipment();
        $shipment->no_gs = $validatedData['no_gs'];
        $shipment->tgl_gs = $validatedData['tgl_gs'];
        $shipment->no_so = $validatedData['no_so'];
        $shipment->no_po = $validatedData['no_po'];
        $shipment->no_do = $validatedData['no_do'];
        $shipment->no_container = $validatedData['no_container'];
        $shipment->no_seal = $validatedData['no_seal'];
        $shipment->no_mobil = $validatedData['no_mobil'];
        $shipment->forwarding = $validatedData['forwarding'];
        $shipment->Kepada = $validatedData['Kepada'];
        $shipment->alamat_pengirim = $validatedData['alamat_pengirim'];
        $shipment->alamat_tujuan = $validatedData['alamat_tujuan'];

        $shipment->save();

        $pengecekan = new Pengecekan;
        $pengecekan->no_gs = $validatedData['no_gs']; 
        $pengecekan->save();

        $mapcoil = new MapCoil;
        $mapcoil->no_gs = $validatedData['no_gs']; 
        $mapcoil->save();

        $mapcoil = new MapCoilTruck();
        $mapcoil->no_gs = $validatedData['no_gs']; 
        $mapcoil->save();

        return redirect()->route('Mapping.admin.shipment');


    }

    public function destroy($id){
        $data = Shipment::where('no_gs',$id)->delete();
        $coil = Coil::where('no_gs',$id)->delete();
        $pengecekan = MapCoil::where('no_gs',$id)->delete();
        $pengecekantruck = MapCoilTruck::where('no_gs',$id)->delete();
        return redirect()->back()->with('success','Shipment has been deleted');
    }




    
}
