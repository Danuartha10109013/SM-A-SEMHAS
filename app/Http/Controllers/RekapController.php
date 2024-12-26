<?php

namespace App\Http\Controllers;

use App\Imports\ImportRekap;
use App\Models\RekapM;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class RekapController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;
    
        // Start the query to select necessary columns and group by 'no_so'
        $query = RekapM::select('no_so', RekapM::raw('MAX(id) as max_id'))
            ->groupBy('no_so');
    
        // If there is a search term, filter the query based on 'no_so' (or any other field)
        if ($search) {
            $query->where('no_so', 'LIKE', "%{$search}%"); // Adjust this line if searching by other fields
        }
    
        // Get the data with the search filter applied
        $data = $query->get();
    
        // Get the total count of grouped 'no_so'
        $countall = RekapM::select('no_so', RekapM::raw('MAX(id) as max_id'))
            ->groupBy('no_so')
            ->count();
    
        
    
        return view('L-08.pages.rekap.index', compact('data', 'countall', 'search'));
    }
    

    public function upload(Request $request)
    {
        // Validate the uploaded file
        $request->validate([
            'keterangan' => 'nullable',
            'excel' => 'required|file|mimes:xlsx,xls|max:2048', // Ensure it's a valid Excel file with size limit
        ]);
    
        try {
            // Import the Excel file using the ImportRekap class
            Excel::import(new ImportRekap($request->keterangan), $request->file('excel'));
    
            // Redirect back with a success message
            return redirect()->back()->with('success', 'Rekap has been successfully imported.');
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            // Handle validation errors during import
            $failures = $e->failures();
    
            // Collect error messages for rows that failed
            $errorMessages = [];
            foreach ($failures as $failure) {
                $errorMessages[] = "Row {$failure->row()}: " . implode(', ', $failure->errors());
            }
    
            return redirect()->back()->with('error', 'Failed to import Rekap. Errors: ' . implode(' | ', $errorMessages));
        } catch (\Exception $e) {
            // Catch other exceptions and show error message
            return redirect()->back()->with('error', 'Import failed: ' . $e->getMessage());
        }
    }
    
    public function detail(Request $request, $so)
{
    $query = RekapM::where('no_so', $so);

    // Check if a search term is provided
    if ($request->has('search') && $request->search) {
        $search = $request->search;
        $query->where('attribute', 'LIKE', "%{$search}%");
    }

    // Execute the query and get the results
    $data = $query->get();

    $keterangan = RekapM::where('no_so',$so)->value('keterangan');

    return view('L-08.pages.rekap.detail', compact('data', 'so', 'keterangan'));
}

    public function delete($so){
        $data = RekapM::where('no_so',$so)->get();
        // dd($data);
        foreach($data as $d){
            $d->delete();
        }
        return redirect()->back()->with('success', 'Data So Telah dihapus');
    }


    public function update(Request $request, $id)
    {
        // dd($request->all());
        // Validate the 'checked' field (ensuring it's either 0 or 1)
        $request->validate([
            'checked' => 'required|boolean',
        ]);

        // Find the record by ID
        $rekap = RekapM::findOrFail($id);

        // Update the value of the 'some_column' field based on the checkbox state
        $rekap->checks = $request->input('checked');
        
        try {
            $rekap->save(); // Save the updated record
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            // Catch any error that happens during the save and return a custom error message
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }




}
