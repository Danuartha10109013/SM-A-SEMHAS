<?php

namespace App\Http\Controllers;

use App\Exports\CraneExportExcel;
use App\Models\CraneM;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use PDF;

class CraneController extends Controller
{
    public function index(Request $request) {
        $searchTerm = $request->input('search');
        $sort = $request->get('sort', 'id'); // Default sort by 'id'
        $direction = $request->get('direction', 'asc'); // Default direction 'asc'
    
        // Fetch data with search and sorting applied
        $query = CraneM::query();
    
        // Apply search if it exists
        if ($searchTerm) {
            $results = User::where('name', 'LIKE', '%' . $searchTerm . '%')->pluck('id');
            $query->whereIn('user_id', $results);
        }
    
        // Apply sorting
        $data = $query->orderBy($sort, $direction)->paginate(10);
    
        return view('Form-Check.pages.crane.index', compact('data', 'searchTerm', 'sort', 'direction'));
    }
    
    
    

    public function add (){
        return view('Form-Check.pages.crane.add');
    }

    public function create(Request $request)
{
    // dd($request->all());
    // Validate the form input
    $validatedData = $request->validate([
        'user_id' => 'required|integer',
        'shift' => 'required|integer|max:255',
        'shift_leader' => 'required|string|max:255',
        'jenis_crane' => 'required|string|max:255',
        'date' => 'required|date',
        'start' => 'required|string|max:255',
        'ket_start' => 'nullable|string|max:255',
        'switch' => 'required|string|max:255',
        'ket_switch' => 'nullable|string|max:255',
        'up' => 'required|string|max:255',
        'ket_up' => 'nullable|string|max:255',
        'down' => 'required|string|max:255',
        'ket_down' => 'nullable|string|max:255',
        'ctravel' => 'required|string|max:255',
        'ket_ctravel' => 'nullable|string|max:255',
        'ltravel' => 'required|string|max:255',
        'ket_ltravel' => 'nullable|string|max:255',
        'emergency' => 'required|string|max:255',
        'ket_emergency' => 'nullable|string|max:255',
        'speed1' => 'required|string|max:255',
        'ket_speed1' => 'nullable|string|max:255',
        'speed2' => 'required|string|max:255',
        'ket_speed2' => 'nullable|string|max:255',
        'block' => 'required|string|max:255',
        'ket_block' => 'nullable|string|max:255',
        'lockert' => 'required|string|max:255',
        'ket_lockert' => 'nullable|string|max:255',
        'wire' => 'required|string|max:255',
        'ket_wire' => 'nullable|string|max:255',
        'sltravel' => 'required|string|max:255',
        'ket_sltravel' => 'nullable|string|max:255',
        'sirinelt' => 'required|string|max:255',
        'ket_sirinelt' => 'nullable|string|max:255',
        'brakeno' => 'required|string|max:255',
        'ket_brakeno' => 'nullable|string|max:255',
        'brakeya' => 'required|string|max:255',
        'ket_brakeya' => 'nullable|string|max:255',
        'bcno' => 'required|string|max:255',
        'ket_bcno' => 'nullable|string|max:255',
        'bcya' => 'required|string|max:255',
        'ket_bcya' => 'nullable|string|max:255',
        'updno' => 'required|string|max:255',
        'ket_updno' => 'nullable|string|max:255',
        'updya' => 'required|string|max:255',
        'ket_updya' => 'nullable|string|max:255',
        'crcros' => 'required|string|max:255',
        'ket_crcros' => 'nullable|string|max:255',
        'catatan' => 'nullable|string|max:255',
        'mtc' => 'required|string|max:255',
        'other_sift_leader' => 'nullable|string|max:255', // Add validation for other shift leader input
    ]);

    // Update shift_leader if the 'other' option is selected
    $validatedData['shift_leader'] = $request->shift_leader == 'other' ? $request->other_sift_leader : $request->shift_leader;

    // Create a new CraneChecklist record and store the data
    CraneM::create($validatedData);

    return redirect()->route('Form-Check.admin.crane')->with('success', 'Submission complete');
}


    public function print($id){
        $data = CraneM::FindOrFail($id);
        return view('Form-Check.pages.crane.print',compact('data'));
    }
    public function show($id){
        $data = CraneM::FindOrFail($id);
        return view('Form-Check.pages.crane.show',compact('data'));
    }


public function downloadReport($id)
{
    $data = CraneM::FindOrFail($id);

    $pdf = PDF::loadView('Form-Check.pages.crane.print',compact('data'));
    
    return $pdf->download('Crane_Operator_Daily_Checklist.pdf');
}

public function destroy($id){
    $data = CraneM::find($id);
    $data->delete();
    return redirect()->back()->with('success', 'Data berhasil Dihapus');
}

public function exportexcel(){
    return Excel::download(new CraneExportExcel,'Crane.xlsx');
}

}
