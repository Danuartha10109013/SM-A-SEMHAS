<?php

namespace App\Http\Controllers;

use App\Exports\ForkliftExportExcel;
use App\Models\CraneM;
use App\Models\ForkliftM;
use App\Models\TraillerM;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class ForkliftController extends Controller
{
    public function index(Request $request) {
        $searchTerm = $request->input('search');
        $sort = $request->get('sort', 'id'); // Default sort by 'id'
        $direction = $request->get('direction', 'desc'); // Default direction 'asc'
        $start = $request->get('start', null);
        $end = $request->get('end', null);
    
        // Fetch data with search and sorting applied
        $query = ForkliftM::query();
    
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
        return view('Form-Check.pages.forklift.index', compact('data', 'searchTerm', 'sort', 'direction','start','end'));
    }
    

    public function add (){
        return view('Form-Check.pages.forklift.add');
    }
    public function create (Request $request){
        // dd($request->all());
        // Validate the form data - fields without "ket_" are required, "ket_" fields are optional
        $validatedData = $request->validate([
            'user_id' => 'required|integer',
            'shift_leader' => 'required|string|max:255',
            'jenis_forklift' => 'required|string|max:255',
            'shift' => 'required|string|max:255',
            'date' => 'required|date',
            'awal' => 'required|string|max:255',
            'horn' => 'required|string|max:255',
            'mundur' => 'required|string|max:255',
            'sein' => 'required|string|max:255',
            'rotating' => 'required|string|max:255',
            'stop' => 'required|string|max:255',
            'utama' => 'required|string|max:255',
            'connector' => 'required|string|max:255',
            'accu' => 'required|string|max:255',
            'parking' => 'required|string|max:255',
            'brake' => 'required|string|max:255',
            'akhir' => 'required|string|max:255',
            'oil' => 'required|string|max:255',
            'raulic' => 'required|string|max:255',
            'chain' => 'required|string|max:255',
            'allhose' => 'required|string|max:255',
            'steering' => 'required|string|max:255',
            'belts' => 'required|string|max:255',
            'cooland' => 'required|string|max:255',
            'transmisi' => 'required|string|max:255',
            'ban' => 'required|string|max:255',
            'fork' => 'required|string|max:255',
            'teba' => 'nullable|string|max:255',
            'catatan' => 'nullable|string|max:1000',
            'mtc' => 'nullable|string|max:255',

            // "ket_" fields are optional
            'ket_awal' => 'nullable|string|max:255',
            'ket_akhir' => 'nullable|string|max:255',
            'ket_horn' => 'nullable|string|max:255',
            'ket_mundur' => 'nullable|string|max:255',
            'ket_sein' => 'nullable|string|max:255',
            'ket_rotating' => 'nullable|string|max:255',
            'ket_stop' => 'nullable|string|max:255',
            'ket_utama' => 'nullable|string|max:255',
            'ket_connector' => 'nullable|string|max:255',
            'ket_acuu' => 'nullable|string|max:255',
            'ket_parking' => 'nullable|string|max:255',
            'ket_brake' => 'nullable|string|max:255',
            'ket_oil' => 'nullable|string|max:255',
            'ket_raulic' => 'nullable|string|max:255',
            'ket_chain' => 'nullable|string|max:255',
            'ket_allhose' => 'nullable|string|max:255',
            'ket_steering' => 'nullable|string|max:255',
            'ket_belts' => 'nullable|string|max:255',
            'ket_cooland' => 'nullable|string|max:255',
            'ket_transmisi' => 'nullable|string|max:255',
            'ket_ban' => 'nullable|string|max:255',
            'ket_fork' => 'nullable|string|max:255',
            'ket_teba' => 'nullable|string|max:255',
            'other_sift_leader' => 'nullable|string|max:255', // Add validation for other shift leader input

        ]);

        // Store the validated data
        $checklist = new ForkliftM;
        $checklist->user_id = $request->user_id;
        if($request->shift_leader == 'other'){
            $checklist->shift_leader = $request->other_sift_leader;
        }else{
            $checklist->shift_leader = $request->shift_leader;
        }
        $checklist->jenis_forklift = $request->jenis_forklift;
        $checklist->shift = $request->shift;
        $checklist->date = $request->date;
        $checklist->awal = $request->awal;
        $checklist->horn = $request->horn;
        $checklist->mundur = $request->mundur;
        $checklist->sein = $request->sein;
        $checklist->rotating = $request->rotating;
        $checklist->stop = $request->stop;
        $checklist->utama = $request->utama;
        $checklist->connector = $request->connector;
        $checklist->accu = $request->accu;
        $checklist->parking = $request->parking;
        $checklist->brake = $request->brake;
        $checklist->akhir = $request->akhir;
        $checklist->oil = $request->oil;
        $checklist->raulic = $request->raulic;
        $checklist->chain = $request->chain;
        $checklist->allhose = $request->allhose;
        $checklist->steering = $request->steering;
        $checklist->belts = $request->belts;
        $checklist->cooland = $request->cooland;
        $checklist->transmisi = $request->transmisi;
        $checklist->ban = $request->ban;
        $checklist->fork = $request->fork;
        $checklist->teba = $request->teba;
        $checklist->catatan = $request->catatan;
        $checklist->mtc = $request->mtc;

        // Save the optional "ket_" fields
        $checklist->ket_awal = $request->ket_awal;
        $checklist->ket_akhir = $request->ket_awal;
        $checklist->ket_horn = $request->ket_horn;
        $checklist->ket_mundur = $request->ket_mundur;
        $checklist->ket_sein = $request->ket_sein;
        $checklist->ket_rotating = $request->ket_rotating;
        $checklist->ket_stop = $request->ket_stop;
        $checklist->ket_utama = $request->ket_utama;
        $checklist->ket_connector = $request->ket_connector;
        $checklist->ket_accu = $request->ket_accu;
        $checklist->ket_parking = $request->ket_parking;
        $checklist->ket_brake = $request->ket_brake;
        $checklist->ket_oil = $request->ket_oil;
        $checklist->ket_raulic = $request->ket_raulic;
        $checklist->ket_chain = $request->ket_chain;
        $checklist->ket_allhose = $request->ket_allhose;
        $checklist->ket_steering = $request->ket_steering;
        $checklist->ket_belts = $request->ket_belts;
        $checklist->ket_cooland = $request->ket_cooland;
        $checklist->ket_transmisi = $request->ket_transmisi;
        $checklist->ket_ban = $request->ket_ban;
        $checklist->ket_fork = $request->ket_fork;
        $checklist->ket_teba = $request->ket_teba;

        // Save the checklist to the database
        $checklist->save();
        if (Auth::user()->role == 0){
            return redirect()->route('Form-Check.admin.forklift')->with('succes', 'Submission complite');
        }else{
            return redirect()->route('Form-Check.pegawai.forklift')->with('succes', 'Submission complite');

        }
    }

    public function print($id){
        $data = ForkliftM::FindOrFail($id);
        return view('Form-Check.pages.forklift.print',compact('data'));
    }
    public function show($id){
        $data = ForkliftM::FindOrFail($id);
        return view('Form-Check.pages.forklift.show',compact('data'));
    }

    public function destroy($id){
        $data = ForkliftM::find($id);
        $data->delete();
        return redirect()->back()->with('success', 'Data berhasil Dihapus');
    }
    public function exportexcel(){
        $date = now()->format('d-m-Y'); 
        return Excel::download(new ForkliftExportExcel, $date . '_Forklift.xlsx');

    }

}
