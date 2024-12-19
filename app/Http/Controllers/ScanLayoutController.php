<?php

namespace App\Http\Controllers;

use App\Exports\ScanLayoutExportExcel;
use App\Models\ScanLayoutM;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class ScanLayoutController extends Controller
{
    public function index(){
        
    }

    public function add(){
        if(Auth::user()->role == 0){
            return view('Scan-Layout.pages.admin.add');
        }else{
            return view('Scan-Layout.pages.pegawai.add');
        }
    }

    public function store(Request $request)
    {
        // Validate the form data
        $request->validate([
            'attribute' => 'required|string|max:255',
            'layout' => 'required|string|max:255',
            'kondisi' => 'required|in:BAIK,TIDAK',
            'group' => 'required|string',
            'other_group' => 'nullable|string|max:255',
        ]);

        // Check if 'other' is selected and provide a custom group name if available
        $group = $request->group == 'other' ? $request->other_group : $request->group;
        // dd($group);

        // Create a new Packing record
        $packing = new ScanLayoutM();
        $packing->attribute = $request->attribute;
        $packing->layout = $request->layout;
        $packing->kondisi = $request->kondisi;
        $packing->group = $group;
        $packing->user_id = Auth::user()->id; // Track which user submitted this packing data
        $packing->save();

        // dd($packing);
        // Redirect back with a success message
        if(Auth::user()->role == 0){
            return redirect()->route('Scan-Layout.admin.dashboard')->with('success', 'New Packing has been successfully created.');
        }elseif(Auth::user()->role == 1){
            return redirect()->route('Scan-Layout.pegawai.dashboard')->with('success', 'New Packing has been successfully created.');
        }
    }

    public function update(Request $request, $id)
    {
        // Validate the request data
        $request->validate([
            'kondisi' => 'required|string|in:BAIK,TIDAK',
            'group' => 'required|string',
            'other_group' => 'nullable|string',
            'attribute' => 'required|string|max:255',
            'layout' => 'required|string|max:255',
        ]);

        // Find the record by ID
        $kendaraan = ScanLayoutM::findOrFail($id);

        // Update the record with the new data
        $kendaraan->kondisi = $request->input('kondisi');
        if($request->group == 'other'){
            $kendaraan->group = $request->input('other_group');
        }else{
            $kendaraan->group = $request->input('group');
        }
        $kendaraan->attribute = $request->input('attribute');
        $kendaraan->layout = $request->input('layout');

        $kendaraan->save();

        // Redirect back with a success message
        
        return redirect()->back()->with('success', 'Kendaraan updated successfully!');
    }

    public function delete($id){
        $data = ScanLayoutM::find($id);
        $data->delete();
        return redirect()->back()->with('success','Data Telah dihapus');
    }

    public function export(){
        $date = now()->format('d-m-Y'); 
        return Excel::download(new ScanLayoutExportExcel, $date . '_ScanLayout.xlsx');
    }
}
