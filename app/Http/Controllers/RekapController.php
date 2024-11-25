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
    
        // Get the count of grouped 'no_so' where 'packing' is 'YES'
        $countdone = RekapM::select('no_so', RekapM::raw('MAX(id) as max_id'))
            ->groupBy('no_so')
            ->where('packing', 'YES')
            ->count();
    
        return view('L-08.pages.rekap.index', compact('data', 'countall', 'countdone', 'search'));
    }
    

    public function upload(Request $request)
    {
        // Validate the uploaded file
        $request->validate([
            'excel' => 'required|file|mimes:xlsx,xls|max:2048', // Ensure it's a valid Excel file with size limit
        ]);
    
        try {
            // Import the Excel file using the ImportRekap class
            Excel::import(new ImportRekap, $request->file('excel'));
    
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

    return view('L-08.pages.rekap.detail', compact('data', 'so'));
}


}
