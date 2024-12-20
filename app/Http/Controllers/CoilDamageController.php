<?php

namespace App\Http\Controllers;

use App\Exports\CoilDamageExportExcel;
use App\Models\CoilDamageM;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class CoilDamageController extends Controller
{
    public function add(){
        return view('Coil-Damage.pages.admin.add');
    }

    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'attribute' => 'required|string|max:255',
            'berat_coil' => 'required',
            'jenis_handling' => 'required|string',
            'other_handling' => 'nullable|string|max:255',
            'foto' => 'required|array', // Expecting multiple files as an array
            'foto.*' => 'image|mimes:jpeg,png,jpg,gif,svg', // Validate each file
            'keterangan' => 'nullable|string',
        ]);

        $fileNames = [];

        // Handle multiple file uploads
        if ($request->hasFile('foto')) {
            foreach ($request->file('foto') as $file) {
                $fileName = time() . '_' . $file->getClientOriginalName();
                $file->storeAs('public/coil_damages', $fileName); // Save the file in storage
                $fileNames[] = $fileName; // Add the file name to the array
            }
        }

        // Create a new CoilDamage record
        $coilDamage = new CoilDamageM();
        $coilDamage->user_id = Auth::id();
        $coilDamage->attribute = $request->input('attribute');
        $coilDamage->berat_coil = $request->input('berat_coil');
        $coilDamage->jenis_handling = $request->input('jenis_handling') === 'other' 
            ? $request->input('other_handling') 
            : $request->input('jenis_handling');
        $coilDamage->keterangan = $request->input('keterangan');

        // Save the filenames array as a JSON-encoded string
        $coilDamage->foto = json_encode($fileNames);
        $coilDamage->save();

        // Redirect back with a success message
        return redirect()->route('Coil-Damage.admin.dashboard')
            ->with('success', 'Coil damage data has been saved successfully.');
    }

    public function update(Request $request, $id)
    {
        // Validate the request data
        $request->validate([
            'attribute' => 'required|string|max:255',
            'berat_coil' => 'required',
            'jenis_handling' => 'required|string',
            'other_handling' => 'nullable|string|max:255',
            'foto' => 'nullable|array', // Expecting multiple files as an array
            'foto.*' => 'image|mimes:jpeg,png,jpg,gif,svg', // Validate each file
            'keterangan' => 'nullable|string',
        ]);

        // Find the record by ID
        $coilDamage = CoilDamageM::findOrFail($id);

        $fileNames = [];

        // Handle multiple file uploads
        if ($request->hasFile('foto')) {
            foreach ($request->file('foto') as $file) {
                $fileName = time() . '_' . $file->getClientOriginalName();
                $file->storeAs('public/coil_damages', $fileName); // Save the file in storage
                $fileNames[] = $fileName; // Add the file name to the array
            }
        }

        $coilDamage->user_id = Auth::id();
        $coilDamage->attribute = $request->input('attribute');
        $coilDamage->berat_coil = $request->input('berat_coil');
        $coilDamage->jenis_handling = $request->input('jenis_handling') === 'other' 
            ? $request->input('other_handling') 
            : $request->input('jenis_handling');
        $coilDamage->keterangan = $request->input('keterangan');

        // Save the filenames array as a JSON-encoded string
        if($fileNames == []){

        }else{
            $coilDamage->foto = json_encode($fileNames);
        }
        $coilDamage->save();

        return redirect()->back()->with('success', 'Kendaraan updated successfully!');
    }

    public function delete($id){
        $data = CoilDamageM::find($id);
        $data->delete();
        return redirect()->back()->with('success','Data berhasul dihapus');
    }

    public function export(Request $request)
{
    // Get selected year from the request, or default to the current year
    $selectedYear = $request->input('year', date('Y'));

    // Get selected month from the request
    $month = $request->input('month');

    // Get search term from the request
    $search = $request->input('search');

    // Start query with year filter
    $query = DB::table('coil_damage')
                ->whereYear('created_at', $selectedYear);

    // Apply month filter if provided
    if ($month) {
        $query->whereMonth('created_at', $month);
    }

    // Apply search filter if provided
    if ($search) {
        $query->where('attribute', 'like', '%' . $search . '%');
    }

    // Fetch the data based on the filters
    $data = $query->get();

    // Export logic (assuming you're using Laravel Excel)
    return Excel::download(new CoilDamageExportExcel($data), 'coil_damage_report.xlsx');
}


}
