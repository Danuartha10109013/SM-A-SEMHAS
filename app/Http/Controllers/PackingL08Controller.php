<?php

namespace App\Http\Controllers;

use App\Exports\CoilDamageExportExcel;
use App\Exports\PackingL08ExportExcel;
use App\Models\PackingL08M;
use App\Models\RekapM;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class PackingL08Controller extends Controller
{
    public function add(){
        return view('L-08.pages.admin.add');
    }

    public function store(Request $request)
    {
        // Validate incoming request data
        $request->validate([
            'attribute' => 'required|string|max:255',
            'kondisi' => 'required|string|max:255',
            'group' => 'required|string|max:255',
            'layout' => 'required|string|max:255',
            'no_sales' => 'required|string|max:255',
            'other_kondisi' => 'nullable|string|max:255',
            'other_group' => 'nullable|string|max:255',
            'other_layout' => 'nullable|string|max:255',
            'user_id' => 'required|exists:users,id', // Ensure user exists
        ]);

        // Determine the final values for 'kondisi', 'group', and 'layout'
        $kondisi = $request->kondisi === 'other' ? $request->other_kondisi : $request->kondisi;
        $group = $request->group === 'other' ? $request->other_group : $request->group;
        $layout = $request->layout === 'other' ? $request->other_layout : $request->layout;

        // Create new Damage record
        $damage = new PackingL08M();
        $damage->attribute = $request->attribute;
        $damage->kondisi = $kondisi;
        $damage->group = $group;
        $damage->layout_kontainer = $layout;
        $damage->no_sales = $request->no_sales;
        $damage->user_id = $request->user_id;

        $ids = RekapM::where('attribute',$request->attribute)->value('id');
        $rekap = RekapM::find($ids);
        $rekap->packing = 'YES';
        $rekap->save();
// dd($ids);
        // Save to database
        if ($damage->save()) {
            if(Auth::user()->role == 0){
                return redirect()->route('L-08.admin.dashboard')->with('success', 'Data has been successfully saved.');
            }else{
                return redirect()->route('L-08.pegawai.dashboard')->with('success', 'Data has been successfully saved.');
            }
        }

        return redirect()->back()->with('error', 'Failed to save data. Please try again.');
    }


    public function update(Request $request, $id)
{
    // Validate the incoming request
    $request->validate([
        'attribute' => 'required|string|max:255',
        'kondisi' => 'required|string',
        'group' => 'required|string',
        'layout' => 'required|string',
        'no_sales' => 'nullable|string|max:255',
        'other_kondisi' => 'nullable|string|max:255',
        'other_group' => 'nullable|string|max:255',
        'other_layout' => 'nullable|string|max:255',
    ]);

    // Find the record by ID
    $damage = PackingL08M::findOrFail($id);

    // Update fields
    $damage->attribute = $request->input('attribute');
    $damage->kondisi = $request->input('kondisi') === 'other' ? $request->input('other_kondisi') : $request->input('kondisi');
    $damage->group = $request->input('group') === 'other' ? $request->input('other_group') : $request->input('group');
    $damage->layout_kontainer = $request->input('layout') === 'other' ? $request->input('other_layout') : $request->input('layout');
    $damage->no_sales = $request->input('no_sales');
    $damage->user_id = Auth::user()->id;

    // Save the record
    $damage->save();

    // Redirect back with success message
    return redirect()->back()->with('success', 'Packing record updated successfully!');
}

    public function delete($id){
        $damage = PackingL08M::findOrFail($id);
        $damage->delete();
        return redirect()->back()->with('success', 'Data has been Deleted');
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
        $query = DB::table('packingl08')
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
        return Excel::download(new PackingL08ExportExcel($data), 'packing_l_08_report.xlsx');
    }
}
