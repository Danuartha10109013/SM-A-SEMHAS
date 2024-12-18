<?php

namespace App\Http\Controllers;

use App\Exports\HasilAkhir;
use App\Imports\DatabaseImport;
use App\Imports\DatabMImportExcel;
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
    public function index(Request $request)
{
    // Get the search term from the request
    $searchTerm = $request->input('search');

    // Check if there is a search term and filter the data accordingly
    if ($searchTerm) {
        $data = ScanM::where('attribute', 'like', '%' . $searchTerm . '%')->get();
    } else {
        // If no search term, get all data
        $data = ScanM::all();
    }

    // Pass the data and the search term to the view
    return view('Packing-List.pages.admin.list.index', compact('data', 'searchTerm'));
}


    public function add()
    {
        // $kcp = ScanM::pluck('attribute');
        // dd($kcp);
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
            'panjang'=>'nullable',
        ]);
        $kcp = ScanM::pluck('attribute'); // Assuming you want to check the 'attribute' column
        if ($kcp->contains($request->attribute)) {
            return redirect()->back()->with('error', 'Attribute Sudah Pernah Di Scan');
        }

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

    public function db_(Request $request){
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

    public function clearall(){
        // This will delete all records from the DatabM table
        ScanM::truncate();

        return redirect()->back()->with('success', 'All Data has been cleared');
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
        $data = DatabM::where('storage_bin','WH-L03-BJ L1-L10-CBT (3-3-3)')->get();
        foreach ($data as $d){
            $same = DatabM::where('id',$d->id)->value('id');
            $gm = DatabM::find($same);
            $gm->delete();
        }
        return redirect()->route('Packing-List.admin.database')->with('success', 'All Data has been cleared');
    }


    public function confir(){
        return view('Packing-List.pages.admin.database.confir');
    }

    
    public function hasil(Request $request, $ket)
    {
        $query = ScanM::where('keterangan', $ket);
    
        // Pencarian berdasarkan 'attribute'
        if ($request->has('search') && !empty($request->search)) {
            $query->where('attribute', 'LIKE', '%' . $request->search . '%');
        }
    
        // Sorting
        $sort = $request->input('sort', 'attribute'); // Default sort by 'attribute'
        $direction = $request->input('direction', 'asc'); // Default direction 'asc'
    
        // Validasi kolom yang dapat diurutkan
        $sortableColumns = ['attribute', 'keterangan', 'created_at', 'updated_at'];
        if (in_array($sort, $sortableColumns)) {
            $query->orderBy($sort, $direction);
        }
    
        // Ambil data
        $data = $query->get();
    
        return view('Packing-List.pages.admin.hasil.index', compact('data', 'ket', 'sort', 'direction'));
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

    public function exportexcel(Request $request, $ket)
    {
        $search = $request->get('search', null);
        $sort = $request->get('sort', 'attribute');
        $direction = $request->get('direction', 'asc');
    
        return Excel::download(new HasilAkhir($ket, $search, $sort, $direction), now()->format('d-m-Y') . '_Packing_List_' . $ket . '.xlsx');
    }
    

    public function exportexcels(Request $request)
    {

        $date = now()->format('d-m-Y'); 
        $ket = null;
        return Excel::download(new HasilAkhir($ket), $date.'_Packing_List.xlsx');
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
        return view('Packing-List.pages.admin.database.gm.add');
    }

    public function db_store_gm(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'kode' => 'required|string|max:255',
            'nama_produk' => 'required|string|max:255',
            'qty' => 'required|numeric',
            'panjang' => 'required',
            'attribute' => 'required|string|max:255',
            'storage_bin' => 'required|string|max:255',
            'date' => 'required|date',
            'uom' => 'required|string|max:255',
            'user_id' => 'required|integer|exists:users,id',
        ]);

        // Create a new Product instance and fill it with the form data
        $product = new DatabM();
        $product->kode = $request->kode;
        $product->nama_produk = $request->nama_produk;
        $product->qty = $request->qty;
        $product->panjang = $request->panjang;
        $product->attribute = $request->attribute;
        $product->storage_bin = $request->storage_bin;
        $product->date = $request->date;
        $product->uom = $request->uom;
        $product->user_id = $request->user_id;

        // Save the product to the database
        $product->save();

        // Redirect back with a success message
        return redirect()->route('Packing-List.admin.gm')
            ->with('success', 'Product added successfully!');
    }

    public function db_edit_gm($id){
        $data = DatabM::find($id);
        return view('Packing-List.pages.admin.database.gm.edit',compact('data'));
    }

    public function db_update_gm(Request $request, $id)
    {
        // dd($request->all());
        // Validate the incoming request data
        $request->validate([
            'kode' => 'required|string|max:255',
            'nama_produk' => 'required|string|max:255',
            'qty' => 'required|numeric',
            'uom' => 'required|string|max:255',
            'attribute' => 'required|string|max:255',
            'panjang' => 'required',
            'storage_bin' => 'required|string|max:255',
            'date' => 'required|date',
        ]);

        // Find the product by ID
        $product = DatabM::findOrFail($id);

        // Update the product fields with the form data
        $product->kode = $request->kode;
        $product->nama_produk = $request->nama_produk;
        $product->qty = $request->qty;
        $product->uom = $request->uom;
        $product->attribute = $request->attribute;
        $product->panjang = $request->panjang;
        $product->storage_bin = $request->storage_bin;
        $product->date = $request->date;

        // Save the updated product to the database
        $product->save();

        // Redirect back with a success message
        return redirect()->route('Packing-List.admin.gm')
            ->with('success', 'Product updated successfully!');
    }

    public function db_delete_gm(Request $request,$id){
        $data = DatabM::find($id);
        $data->delete();
        return redirect()->route('Packing-List.admin.gm')->with('success','Data berhasil diperbarui');
    }

    public function db_store_excel_gm(Request $request) {
        // dd($request->all());
        Excel::import(new DatabMImportExcel(), $request->file('excel'));
        return redirect()->back()->with('success', 'Database Baru Telah ditambahkan');
    }

    public function db_clear_gm(){
        $data = DatabM::where('storage_bin','WH-L03-COIL')->get();
        foreach ($data as $d){
            $same = DatabM::where('id',$d->id)->value('id');
            $gm = DatabM::find($same);
            $gm->delete();
        }
        return redirect()->route('Packing-List.admin.gm');
    }
    
}
