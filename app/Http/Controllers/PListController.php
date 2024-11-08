<?php

namespace App\Http\Controllers;

use App\Exports\HasilAkhir;
use App\Imports\DatabaseImport;
use App\Models\DatabM;
use App\Models\PackingM;
use App\Models\ScanM;
use App\Models\SupplyM;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel; // Import this
use PhpParser\Node\Stmt\Return_;

class PListController extends Controller
{
    public function index(){
        $data = ScanM::all();
        return view('Packing-List.pages.admin.list.index',compact('data'));
    }

    public function add()
    {
        return view('Packing-List.pages.admin.list.add');
    }

    public function store(Request $request)
{
    // dd($request->all());
    // Validate the request data
    $request->validate([
        'attribute'=>'required|string|max:255',
        'kondisi'=>'required|string|max:255',
        'keterangan'=>'required|string|max:255',
        'tujuan'=>'required|string|max:255',
        'other_keterangan' => 'nullable|string',
        'panjang'=>'required|integer',
    ]);
    if($request->keterangan == "other"){
        ScanM::create([
            'attribute' => $request->input('attribute'),
            'kondisi' => $request->input('kondisi'),
            'keterangan' => $request->input('other_keterangan'),
            'tujuan' => $request->input('tujuan'),
            'panjang' => $request->input('panjang'),
            'user_id' => Auth::user()->id,
        ]);
        
    }else{
        ScanM::create([
            'attribute' => $request->input('attribute'),
            'kondisi' => $request->input('kondisi'),
            'keterangan' => $request->input('keterangan'),
            'tujuan' => $request->input('tujuan'),
            'panjang' => $request->input('panjang'),
            'user_id' => Auth::user()->id,
        ]);
    }
    
    // Redirect back with a success message
    if (Auth::user()->role == 0) {
        return redirect()->route('Packing-List.admin.list', 'Supply created successfully!');
    } else {
        return redirect()->route('Packing-List.pegawai.list')->with('success', 'Supply created successfully!');
    }
}

    
    


    public function add_gm($gm){
        return view('Packing-List.pages.admin.list.add-gm',compact('gm'));
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

        PackingM::create([
            'gm' => $request->gm,
            'attribute' => $request->attribute, // Corrected 'atribute' to 'attribute'
            'b_label' => $request->b_label,
            'b_aktual' => $request->b_aktual,
            'selisih' => $request->b_label - $request->b_aktual, // Corrected calculation
            'persentase' => number_format(($request->b_label * 0.25) / 100, 4), // Increase decimal precision to 4 places
            'stiker' => $request->stiker,
            'keterangan' => $request->keterangan,
        ]);
        

        return redirect()->route('Supply.admin.packing')->with('success','Product Has Been created');
    }

    public function show($gm)
    {
        $data = SupplyM::find($gm);
        return view('Packing-List.pages.admin.list.show',compact('data','gm'));
    }

    public function edit($id){
        $data = ScanM::find($id);
        return view('Packing-List.pages.admin.list.edit',compact('data'));
    }


    public function update(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'attribute' => 'required|string',
            'kondisi' => 'required|string',
            'tujuan' => 'required|string',
            'keterangan' => 'required|string',
            'other_keterangan' => 'nullable|string',
            'panjang' => 'required|numeric',
        ]);

        // Find the existing PackingList data (assuming you pass an id in the form)
        $packingList = ScanM::findOrFail($request->id);

        // Update the packing list data
        $packingList->attribute = $request->attribute;
        $packingList->kondisi = $request->kondisi;
        $packingList->tujuan = $request->tujuan;
        if($request->keterangan == "other"){

            $packingList->keterangan = $request->other_keterangan;
        }else{
            $packingList->keterangan = $request->keterangan;
        }
        $packingList->panjang = $request->panjang;

        // Save the updated data
        $packingList->save();

        // Redirect with a success message
        return redirect()->route('Packing-List.admin.list')->with('success', 'Packing List updated successfully.');
    }
    
    public function delete($id){
        ScanM::find($id)->delete();

        return redirect()->back()->with('success', 'Data has been deleted');
    }

    public function print($gm){
        $data = SupplyM::find($gm);

        $date = PackingM::where('gm',$gm)->value('created_at');

        return view('Packing-List.pages.admin.list.print',compact('data','date'));
    }

    public function db(Request $request)
{
    // Get the search query from the request
    $search = $request->input('search');
    
    // Get sort and direction from the request, with default values
    $sort = $request->input('sort', 'date'); // Default sort by 'date'
    $direction = $request->input('direction', 'asc');

    // Validate direction to be either 'asc' or 'desc'
    if (!in_array($direction, ['asc', 'desc'])) {
        $direction = 'asc'; // Set to default if invalid
    }

    // Validate sort column (ensure it's a valid column name)
    $validSortColumns = ['kode', 'nama_produk', 'qty', 'uom', 'attribute', 'storage_bin', 'date', 'user_id']; // Add all valid columns here
    if (!in_array($sort, $validSortColumns)) {
        $sort = 'date'; // Fallback to default if invalid
    }

    // Check if there's a search query, if so filter based on the 'attribute' field
    if ($search) {
        $data = DatabM::where('storage_bin','!=','WH-L03-COIL')->where('attribute', 'LIKE', '%' . $search . '%')
            ->orderBy($sort, $direction) // Apply sorting
            ->get();
    } else {
        // If no search query, retrieve all records with sorting
        $data = DatabM::where('storage_bin','!=','WH-L03-COIL')->orderBy($sort, $direction)->get();
    }

    return view('Packing-List.pages.admin.database.index', compact('data', 'search', 'sort', 'direction'));
}
    public function db_add(){
        return view('Packing-List.pages.admin.database.add');
    }

    public function db_store(Request $request){
    {
    $validatedData = $request->validate([
        'kode' => 'required|string|max:255',
        'nama_produk' => 'required|string|max:255',
        'qty' => 'required|string|max:255',
        'uom' => 'required|string|max:255',
        'attribute' => 'required|string|max:255',
        'storage_bin' => 'required|string|max:255',
        'date' => 'required|date',
        'user_id' => 'required|integer',
    ]);

    DatabM::create($validatedData);

    return redirect()->route('Packing-List.admin.database')->with('success', 'Product added successfully!');

    }
}

    public function db_edit($id){
        $data = DatabM::find($id);
        return view('Packing-List.pages.admin.database.edit',compact('data'));
    }


    public function db_update(Request $request, $id)
{
    $request->validate([
        'kode' => 'required|string|max:255',
        'nama_produk' => 'required|string|max:255',
        'qty' => 'required|string',
        'uom' => 'required|string|max:10',
        'attribute' => 'required|string|max:255',
        'storage_bin' => 'required|string|max:255',
        'date' => 'required|date',
    ]);

    $data = DatabM::findOrFail($id); // Replace YourModel with your actual model
    $data->update($request->all());

    return redirect()->route('Packing-List.admin.database')->with('success', 'Product updated successfully!');
}

    public function db_destroy($id){
        $data = DatabM::find($id);
        $data->delete();
        return redirect()->back()->with('success','Data has been Deleted');
    }

    public function db_clear()
    {
        // This will delete all records from the DatabM table
        DatabM::truncate();

        return redirect()->route('Packing-List.admin.database')->with('success', 'All Data has been cleared');
    }


    public function confir(){
        return view('Packing-List.pages.admin.database.confir');
    }

    
    public function hasil($ket){
        
        $data = ScanM::where('keterangan',$ket)->get();

        return view('Packing-List.pages.admin.hasil.index',compact('data','ket'));
    }
    public function hasil_group(){
        
        $data = ScanM::select('keterangan')->distinct()->get();

        return view('Packing-List.pages.admin.hasil.hasil',compact('data'));
    }

    public function db_store_excel(Request $request){
        // dd($request->all());
        Excel::import(new DatabaseImport(),$request->file('excel'));
        return redirect()->back()->with('success','Database Baru Telah ditambahkan');
    }

    public function exportexcel(){
        $date = now()->format('d-m-Y'); 
        return Excel::download(new HasilAkhir, $date . '_Packing_List.xlsx');

    }

    public function db_gm(Request $request){
        // Get the search query from the request
    $search = $request->input('search');
    
    // Get sort and direction from the request, with default values
    $sort = $request->input('sort', 'date'); // Default sort by 'date'
    $direction = $request->input('direction', 'asc');

    // Validate direction to be either 'asc' or 'desc'
    if (!in_array($direction, ['asc', 'desc'])) {
        $direction = 'asc'; // Set to default if invalid
    }

    // Validate sort column (ensure it's a valid column name)
    $validSortColumns = ['kode', 'nama_produk', 'qty', 'uom', 'attribute', 'storage_bin', 'date', 'user_id']; // Add all valid columns here
    if (!in_array($sort, $validSortColumns)) {
        $sort = 'date'; // Fallback to default if invalid
    }

    // Check if there's a search query, if so filter based on the 'attribute' field
    if ($search) {
        $data = DatabM::where('storage_bin','WH-L03-COIL')->where('attribute', 'LIKE', '%' . $search . '%')
            ->orderBy($sort, $direction) // Apply sorting
            ->get();
    } else {
        // If no search query, retrieve all records with sorting
        $data = DatabM::where('storage_bin','WH-L03-COIL')->orderBy($sort, $direction)->get();
    }

    return view('Packing-List.pages.admin.database.gm', compact('data', 'search', 'sort', 'direction'));
    }

    public function db_add_gm(){
        return view('Packing-List.pages.admin.database.add');
    }
}
