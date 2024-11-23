<?php

namespace App\Http\Controllers;

use App\Exports\OpenPackExportExcel;
use App\Models\PackingDetailM;
use App\Models\PackingM;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class OpenPackController extends Controller
{
    public function index(Request $request)
    {
        // Mulai query dari model PackingM
        $query = PackingM::query();

        // Filter berdasarkan rentang tanggal
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('created_at', [$request->start_date, $request->end_date]);
        }

        // Filter berdasarkan bulan
        if ($request->filled('month')) {
            $query->whereMonth('created_at', $request->month);
        }

        // Filter berdasarkan tahun
        if ($request->filled('year')) {
            $query->whereYear('created_at', $request->year);
        }

        // Filter berdasarkan teks pencarian
        if ($request->filled('search')) {
            $query->where('gm', 'like', '%' . $request->search . '%');
        }

        // Ambil data unik 'gm' dengan tanggal pertama yang ditemukan
        $data = $query->select('gm', DB::raw('MIN(created_at) as created_at'))
                        ->groupBy('gm')
                        ->get();

        // Kirim data ke view
        return view('Open-Packing.pages.admin.packing.index', compact('data'));
    }
    
    

    public function add()
    {
        return view('Open-Packing.pages.admin.packing.add');
    }

    public function store(Request $request){
        // dd($request->all());
        $request->validate([
            'gm' => 'required|string|max:255',
            'jenis' => 'required|string|max:255',
            'shift' => 'required|string|max:255',
            'shift_leader' => 'required|string|max:255',
            'operator' => 'required|string|max:255',
        ]);

        $shift_leader = $request->shift_leader == 'other' ? $request->other_shift_leader : $request->shift_leader;

        PackingM::create([
            'gm' => $request->gm,
            // 'jenis' => $request->jenis,
            'shift' => $request->shift,
            'shift_leader' => $shift_leader,
            'operator' => $request->operator,
        ]);


        return redirect()->route('Open-Packing.admin.packing')->with('success','GM Has Been created');
    }

    public function add_gm($gm){
        return view('Open-Packing.pages.admin.packing.add-gm',compact('gm'));
    }

    public function store_gm(Request $request){
        // dd($request->all());
        $request->validate([
            'gm' => 'required|string|max:255',
            'attribute' => 'required|string|max:255',
            'b_label' => 'required|integer',
            'b_aktual' => 'required|integer',
            'stiker' => 'nullable|string|max:255',
            'keterangan' => 'nullable|string|max:255',
        ]);

        $cc = PackingM::where('gm',$request->gm)->value('id');
        // dd($cc);

        
        $data = new PackingDetailM();
        $data->attribute = $request->attribute;
        $data->b_label = $request->b_label;
        $data->b_aktual = $request->b_aktual;
        $data->selisih = $request->b_aktual - $request->b_label;
        $data->persentase = number_format($data->selisih / $request->b_label * 100, 2);
        $data->keterangan = $request->keterangan;
        $data->packing_id = $cc;
        $data->save();
        

        return redirect()->route('Open-Packing.admin.packing')->with('success','Product Has Been created');
    }

    public function show($gm)
    {
        $cc = PackingM::where('gm', $gm)->value('id');
        // dd($cc);
        $data = PackingDetailM::where('packing_id',$cc)->get();

        // dd($data);
        return view('Open-Packing.pages.admin.packing.show',compact('data','gm'));
    }

    public function edit($id){
        $data = PackingDetailM::find($id);
        $gm = PackingM::where('id',$data->packing_id)->value('gm');
        // dd($gm);
        return view('Open-Packing.pages.admin.packing.edit',compact('data','gm'));
    }

    public function update(Request $request){
        $request->validate([
            // 'gm' => 'required|string|max:255',
            'attribute' => 'required|string|max:255',
            'b_label' => 'required|integer',
            'b_aktual' => 'required|integer',
            'keterangan' => 'nullable|string|max:255',
        ]);

        $data = PackingDetailM::find($request->id);
        $gm = PackingM::where('id',$data->packing_id)->value('gm');

        // $data->gm = $request->gm;
        $data->attribute = $request->attribute;
        $data->b_label = $request->b_label;
        $data->b_aktual = $request->b_aktual;
        $data->selisih = $request->b_aktual - $request->b_label;
        $data->persentase = number_format($data->selisih / $request->b_label * 100, 2);

        $data->keterangan = $request->keterangan;
        $data->update();

        return redirect()->route('Open-Packing.admin.packing.show',$gm)->with('success','Product Updated');
    }

    public function delete($id){
        PackingDetailM::find($id)->delete();

        return redirect()->back()->with('success', 'Data has been deleted');
    }

    public function delete_gm($id){
        $ids = PackingM::where('gm',$id)->value('id'); 
        $data = PackingM::find($ids);
        $data->delete();

        $detail = PackingDetailM::where('packing_id',$data->id)->get();
        foreach ($detail as $d){
            $hapus = PackingDetailM::find($d->id);
            $hapus->delete();
        }

        return redirect()->back()->with('success', 'Data has been deleted');
    }

    public function print($gm){
        $data = PackingM::where('gm', $gm)->get();
        $cc = PackingM::where('gm',$gm)->value('id');
        $detail = PackingDetailM::where('packing_id',$cc)->get();
        $date = PackingM::where('gm',$gm)->value('created_at');
        $jenis = PackingM::where('gm',$gm)->value('jenis');
        $leader = PackingM::where('gm',$gm)->value('shift_leader');
        $shift = PackingM::where('gm',$gm)->value('shift');
        

        return view('Open-Packing.pages.admin.packing.print',compact('data','detail','date','jenis','leader','shift'));
    }

    public function download($gm){
        $data = PackingM::where('gm', $gm)->get();
        $cc = PackingM::where('gm',$gm)->value('id');
        $data = PackingDetailM::where('packing_id',$cc)->get();
        $date = PackingM::where('gm',$gm)->value('created_at');
        $jenis = PackingM::where('gm',$gm)->value('jenis');
        $leader = PackingM::where('gm',$gm)->value('shift_leader');
        $shift = PackingM::where('gm',$gm)->value('shift');
    return Excel::download(new OpenPackExportExcel($data,$gm,$date,$jenis,$leader,$shift), $gm.'_open_packing-report.xlsx');

    }
}
