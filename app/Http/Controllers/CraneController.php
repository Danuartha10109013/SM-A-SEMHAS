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
   public function index(Request $request)
{
    $searchTerm = $request->input('search');
    $sort = $request->get('sort', 'id');
    $direction = $request->get('direction', 'desc');
    $start = $request->get('start', null);
    $end = $request->get('end', null);

    $div = Auth::user()->division;

    // Base query
    $query = CraneM::query();

    // Filter by division and jenis_crane
    if ($div === 'Produksi') {
        $query->where('jenis_crane', 'LIKE', '%PRD%');
    } else { // Assume Warehouse or others
        $query->where('jenis_crane', 'NOT LIKE', '%PRD%');
    }

    // Apply search if it exists
    if ($searchTerm) {
        $results = User::where('name', 'LIKE', '%' . $searchTerm . '%')->pluck('id');
        $query->where(function ($q) use ($results, $searchTerm) {
            $q->whereIn('user_id', $results)
              ->orWhere('jenis_crane', 'LIKE', '%' . $searchTerm . '%');
        });
    }

    // Apply date filtering if start and/or end is provided
    if ($start && $end) {
        $query->whereBetween('created_at', [$start, $end]);
    } elseif ($start) {
        $query->whereDate('created_at', '>=', $start);
    } elseif ($end) {
        $query->whereDate('created_at', '<=', $end);
    }

    // Role-based filtering
    if (Auth::user()->role == 0) {
        $data = $query->orderBy($sort, $direction)->paginate(10);
    } else {
        $data = $query->where('user_id', Auth::user()->id)->orderBy($sort, $direction)->paginate(10);
    }

    return view('Form-Check.pages.crane.index', compact('data', 'searchTerm', 'sort', 'direction', 'start', 'end'));
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
        'jenis_crane_other' => 'nullable|string|max:255', // Add validation for other shift leader input
    ]);

    // Update shift_leader if the 'other' option is selected
    $validatedData['shift_leader'] = $request->shift_leader == 'other' ? $request->other_sift_leader : $request->shift_leader;
    $validatedData['jenis_crane'] = $request->jenis_crane == 'Other' ? $request->jenis_crane_other : $request->jenis_crane;
    // dd($request->jenis_crane == 'Other' ? $request->jenis_crane_other : $request->jenis_crane);
    // Create a new CraneChecklist record and store the data
    CraneM::create($validatedData);
    if (Auth::user()->role == 0){
        return redirect()->route('Form-Check.admin.crane')->with('success', 'Submission complete');
    }else{
        return redirect()->route('Form-Check.pegawai.crane')->with('success', 'Submission complete');
    }
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
