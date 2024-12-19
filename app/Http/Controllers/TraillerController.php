<?php

namespace App\Http\Controllers;

use App\Exports\TraillerExportExcel;
use App\Models\TraillerM;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class TraillerController extends Controller
{
    public function index(Request $request) {
        $searchTerm = $request->input('search');
        $sort = $request->get('sort', 'id'); // Default sort by 'id'
        $direction = $request->get('direction', 'asc'); // Default direction 'asc'
        $start = $request->get('start', null);
        $end = $request->get('end', null);
    
        // Fetch data with search and sorting applied
        $query = TraillerM::query();
    
        // Apply search if it exists
        if ($searchTerm) {
            $results = User::where('name', 'LIKE', '%' . $searchTerm . '%')->pluck('id');
            $query->whereIn('user_id', $results);
        }

        // Apply date filtering if start and end dates are provided
        if ($start && $end) {
            $query->whereBetween('created_at', [$start, $end]);
        } elseif ($start) {
            $query->whereDate('created_at', '>=', $start);
        } elseif ($end) {
            $query->whereDate('created_at', '<=', $end);
        }
    
        // Apply sorting
        if(Auth::user()->role == 0){
            // $data = ForkliftM::paginate(10); // 10 items per page
            $data = $query->orderBy($sort, $direction)->paginate(10);
        }else{
            $data = $query->where('user_id', Auth::user()->id)->orderBy($sort, $direction)->paginate(10);
            // $data = ForkliftM::where('user_id', Auth::user()->id)->paginate(10);
        }
        return view('Form-Check.pages.trailler.index', compact('data', 'searchTerm', 'sort', 'direction','start','end'));
    }
    

    public function add (){
        return view('Form-Check.pages.trailler.add');
    }
    public function create(Request $request)
{
    // dd($request->all());
    $validatedData = $request->validate([
        'user_id' => 'required|exists:users,id',
        'shift_leader' => 'nullable|string',
        'mtc' => 'nullable|string',
        'jenis_forklift' => 'nullable|string',
        'date' => 'nullable|date',
        'carrier' => 'nullable|string',
        'rantai' => 'nullable|string',
        'ban' => 'nullable|string',
        'cadangan' => 'nullable|string',
        'sein' => 'nullable|string',
        'rotating' => 'nullable|string',
        'stop' => 'nullable|string',
        'utama' => 'nullable|string',
        'kota' => 'nullable|string',
        'connector' => 'nullable|string',
        'accu' => 'nullable|string',
        'coolant' => 'nullable|string',
        'parking' => 'nullable|string',
        'brake' => 'nullable|string',
        'horn' => 'nullable|string',
        'mundur' => 'nullable|string',
        'clamp' => 'nullable|string',
        'terpal' => 'nullable|string',
        'rantai_pe' => 'nullable|string',
        'ganjal' => 'nullable|string',
        'pallet' => 'nullable|string',
        'apar' => 'nullable|string',
        'p3k' => 'nullable|string',
        'fancing' => 'nullable|string',
        'triangle' => 'nullable|string',
        'tools' => 'nullable|string',
        'catatan' => 'nullable|string',
        
        // Nullable ket fields
        'ket_carrier' => 'nullable|string',
        'ket_rantai' => 'nullable|string',
        'ket_ban' => 'nullable|string',
        'ket_cadangan' => 'nullable|string',
        'ket_sein' => 'nullable|string',
        'ket_rotating' => 'nullable|string',
        'ket_stop' => 'nullable|string',
        'ket_utama' => 'nullable|string',
        'ket_kota' => 'nullable|string',
        'ket_connector' => 'nullable|string',
        'ket_accu' => 'nullable|string',
        'ket_coolant' => 'nullable|string',
        'ket_parking' => 'nullable|string',
        'ket_brake' => 'nullable|string',
        'ket_horn' => 'nullable|string',
        'ket_mundur' => 'nullable|string',
        'ket_clamp' => 'nullable|string',
        'ket_terpal' => 'nullable|string',
        'ket_rantai_pe' => 'nullable|string',
        'ket_ganjal' => 'nullable|string',
        'ket_pallet' => 'nullable|string',
        'ket_apar' => 'nullable|string',
        'ket_p3k' => 'nullable|string',
        'ket_fancing' => 'nullable|string',
        'ket_triangle' => 'nullable|string',
        'ket_tools' => 'nullable|string',
        'other_sift_leader' => 'nullable|string|max:255', // Add validation for other shift leader input
    ]);

    $validatedData['shift_leader'] = $request->shift_leader == 'other' ? $request->other_sift_leader : $request->shift_leader;
    $validatedData['mtc_name']= $request->mtc;

    TraillerM::create($validatedData);

    if(Auth::user()->role == 0){

        return redirect()->route('Form-Check.admin.trailler')->with('success', 'Trailler record saved successfully.');
    }else{
        return redirect()->route('Form-Check.pegawai.trailler')->with('success', 'Trailler record saved successfully.');
    }
}

    public function print($id){
        $data = TraillerM::FindOrFail($id);
        return view('Form-Check.pages.trailler.print',compact('data'));
    }
    public function show($id){
        $data = TraillerM::FindOrFail($id);
        return view('Form-Check.pages.trailler.show',compact('data'));
    }

    public function export(){
        $date = now()->format('d-m-Y'); 

        return Excel::download(new TraillerExportExcel, $date.'Trailler.xlsx');
    }

    public function destroy($id){
        $data = TraillerM::find($id);
        $data->delete();
        return redirect()->back()->with('success', 'Data berhasil Dihapus');
    }

}
