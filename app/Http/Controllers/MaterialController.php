<?php

namespace App\Http\Controllers;

use App\Exports\CrcExportExcel;
use App\Exports\IngotExportExcel;
use App\Exports\ResinExportExcel;
use App\Models\CraneM;
use App\Models\CrcM;
use App\Models\Crc_imageM;
use App\Models\Ingot_imageM;
use App\Models\IngotM;
use App\Models\Resin_imageM;
use App\Models\ResinM;
use App\Models\TraillerM;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class MaterialController extends Controller
{

    //CRC
    public function index_crc(Request $request) {
        $searchTerm = $request->input('search');
        $sort = $request->get('sort', 'id'); // Default sort by 'id'
        $direction = $request->get('direction', 'asc'); // Default direction 'asc'
    
        // Fetch data with search and sorting applied
        $query = CrcM::query();
    
        // Apply search if it exists
        if ($searchTerm) {
            $results = User::where('name', 'LIKE', '%' . $searchTerm . '%')->pluck('id');
            $query->whereIn('user_id', $results);
        }
    
        // Apply sorting
        if(Auth::user()->role == 0){
            // $data = ForkliftM::paginate(10); // 10 items per page
            $data = $query->orderBy($sort, $direction)->paginate(10);
        }else{
            $data = $query->where('user_id', Auth::user()->id)->orderBy($sort, $direction)->paginate(10);
            // $data = ForkliftM::where('user_id', Auth::user()->id)->paginate(10);
        }
        return view('Form-Check.pages.material.crc.index', compact('data','searchTerm', 'sort', 'direction'));
    }
    

    public function add_crc (){
        return view('Form-Check.pages.material.crc.add');
    }
    
    public function show_crc ($id){
        $submission = CrcM::find($id);
        return view('Form-Check.pages.material.crc.show',compact('submission'));
    }

    
    public function create_crc(Request $request)
    {
        
        // dd($request->all());
        // Validate the request
        $validated = $request->validate([
            'user_id' => 'required|integer',
            'shift_leader' => 'required|string',
            'date' => 'required|date',
            'supplier' => 'required|array',
            'ket_awal' => 'nullable|string',
            'cuaca' => 'nullable|string',
            'sesuai' => 'nullable|string',
            'baik' => 'nullable|string',
            'kering' => 'nullable|string',
            'kencang' => 'nullable|string',
            'jumlahin' => 'nullable|string',
            'wall' => 'nullable|string',
            'perganjalan' => 'nullable|string',
            'foto' => 'nullable|array',
            'foto1' => 'nullable|array',
            'foto2' => 'nullable|array',
            'foto3' => 'nullable|array',
            'foto4' => 'nullable|array',
            'foto5' => 'nullable|array',
            'foto6' => 'nullable|array',
            'foto7' => 'nullable|array',
        ]);

        $data = [
            'user_id' => $request->input('user_id'),
            'shift_leader' => $request->input('shift_leader'),
            'date' => $request->input('date'),
            'supplier' => json_encode($request->input('supplier')), // Convert array to JSON
            'ket_awal' => $request->input('ket_awal'),
            'cuaca' => $request->input('cuaca'),
            'keterangan' => $request->input('keterangan'),
            'sesuai' => $request->input('sesuai'),
            'keterangan1' => $request->input('keterangan1'),
            'baik' => $request->input('baik'),
            'keterangan2' => $request->input('keterangan2'),
            'kering' => $request->input('kering'),
            'keterangan3' => $request->input('keterangan3'),
            'kencang' => $request->input('kencang'),
            'keterangan4' => $request->input('keterangan4'),
            'jumlahin' => $request->input('jumlahin'),
            'keterangan5' => $request->input('keterangan5'),
            'alas' => $request->input('alas'),
            'keterangan6' => $request->input('keterangan6'),
            'wall' => $request->input('wall'),
            'keterangan7' => $request->input('keterangan7'),
            'perganjalan' => $request->input('perganjalan'),
        ];
    
        $crc = CrcM::create($data);
    
        try {
            $fileNames = [];
            $fileInputs = ['foto', 'foto1', 'foto2','foto3','foto4','foto5','foto6','foto7' ];
        
            foreach ($fileInputs as $inputName) {
                if ($request->hasFile($inputName)) {
                    $files = $request->file($inputName);
                    $uploadedFileNames = [];
        
                    foreach ($files as $file) {
                        if ($file instanceof \Illuminate\Http\UploadedFile && $file->isValid()) { // Validate the file
                            $date = now()->format('d-m-Y');
                            $name = $date . '/' . uniqid() . '.' . $file->getClientOriginalExtension();
                            $file->storeAs('crc', $name, 'public');
        
                            $uploadedFileNames[] = $name;
                        }
                    }
        
                    $fileNames[$inputName] = json_encode($uploadedFileNames);
                }
            }
        
            // Prepare data for database
            $crc_image_data = array_merge($fileNames, ['crc_id' => $crc->id]); // Add `crc_id` here
        
            // Save to database
            Crc_imageM::create($crc_image_data);
        } catch (Exception $e) {
            // Handle exception
            return response()->json(['error' => $e->getMessage()], 500);
        }
        
        if (Auth::user()->role == 0){
            return redirect()->route('Form-Check.admin.crc')->with('succes', 'Submission complite');
        }else{
            return redirect()->route('Form-Check.pegawai.crc')->with('succes', 'Submission complite');
        }
        
    }

    public function print_crc($id){

        $submission = CrcM::find($id);
        $same = $submission->id;
        $ids = Crc_imageM::where('crc_id',$same)->value('id');
        $foto= Crc_imageM::find($ids);
        // dd($foto);
        return view('Form-Check.pages.material.crc.print',compact('submission','foto'));
    }

    //INGOT
    public function index_ingot(Request $request) {
        $searchTerm = $request->input('search');
        $sort = $request->get('sort', 'id'); // Default sort by 'id'
        $direction = $request->get('direction', 'asc'); // Default direction 'asc'
    
        // Fetch data with search and sorting applied
        $query = IngotM::query();
    
        // Apply search if it exists
        if ($searchTerm) {
            $results = User::where('name', 'LIKE', '%' . $searchTerm . '%')->pluck('id');
            $query->whereIn('user_id', $results);
        }
    
        // Apply sorting
        if(Auth::user()->role == 0){
            // $data = ForkliftM::paginate(10); // 10 items per page
            $data = $query->orderBy($sort, $direction)->paginate(10);
        }else{
            $data = $query->where('user_id', Auth::user()->id)->orderBy($sort, $direction)->paginate(10);
            // $data = ForkliftM::where('user_id', Auth::user()->id)->paginate(10);
        }
        return view('Form-Check.pages.material.ingot.index', compact('data','searchTerm', 'sort', 'direction'));
    }
    
    public function add_ingot (){
        return view('Form-Check.pages.material.ingot.add');
    }
    public function show_ingot ($id){
        
        return view('Form-Check.pages.material.ingot.add');
    }

    public function create_ingot(Request $request)
    {
        
        // dd($request->all());
        // Validate the request
        $validated = $request->validate([
            'user_id' => 'required|integer',
            'shift_leader' => 'required|string',
            'date' => 'required|date',
            'time' => 'required|date_format:H:i',
            'supplier' => 'required|array',
            'jenis' => 'nullable|string',

            'cuaca' => 'nullable|string',
            'foto' => 'nullable|array',
            'keterangan' => 'nullable|string',

            'sesuai' => 'nullable|string',
            'foto1' => 'nullable|array',
            'keterangan1' => 'nullable|string',

            'kering' => 'nullable|string',
            'foto3' => 'nullable|array',
            'keterangan3' => 'nullable|string',
            
            'jumlahin' => 'nullable|string',
            'foto5' => 'nullable|array',
            'keterangan5' => 'nullable|string',

        ]);

        $data = [
            'user_id' => $request->input('user_id'),
            'shift_leader' => $request->input('shift_leader'),
            'date' => $request->input('date'),
            'time' => $request->input('time'),
            'supplier' => json_encode($request->input('supplier')), // Convert array to JSON
            'jenis' => $request->input('jenis'),

            'cuaca' => $request->input('cuaca'),
            'keterangan' => $request->input('keterangan'),

            'sesuai' => $request->input('sesuai'),
            'keterangan1' => $request->input('keterangan1'),

            'kering' => $request->input('kering'),
            'keterangan3' => $request->input('keterangan3'),

            'jumlahin' => $request->input('jumlahin'),
            'keterangan5' => $request->input('keterangan5'),

        ];
    
        $crc = IngotM::create($data);
    
        try {
            $fileNames = [];
            $fileInputs = ['foto', 'foto1','foto3','foto5'];
        
            foreach ($fileInputs as $inputName) {
                if ($request->hasFile($inputName)) {
                    $files = $request->file($inputName);
                    $uploadedFileNames = [];
        
                    foreach ($files as $file) {
                        if ($file instanceof \Illuminate\Http\UploadedFile && $file->isValid()) { // Validate the file
                            $date = now()->format('d-m-Y');
                            $name = $date . '/' . uniqid() . '.' . $file->getClientOriginalExtension();
                            $file->storeAs('ingot', $name, 'public');
        
                            $uploadedFileNames[] = $name;
                        }
                    }
        
                    $fileNames[$inputName] = json_encode($uploadedFileNames);
                }
            }
        
            // Prepare data for database
            $crc_image_data = array_merge($fileNames, ['ingot_id' => $crc->id]); // Add `crc_id` here
        
            // Save to database
            Ingot_imageM::create($crc_image_data);
        } catch (Exception $e) {
            // Handle exception
            return response()->json(['error' => $e->getMessage()], 500);
        }
        
        if (Auth::user()->role == 0){
            return redirect()->route('Form-Check.admin.ingot')->with('succes', 'Submission complite');
        }else{
            return redirect()->route('Form-Check.pegawai.ingot')->with('succes', 'Submission complite');
        }
        
    }

    public function print_ingot($id){
        $submission= IngotM::find($id);
        $same = $submission->id;
        $ids = Ingot_imageM::where('ingot_id',$same)->value('id');
        $foto= Ingot_imageM::find($ids);
        // dd($foto);

        return view('Form-Check.pages.material.ingot.print',compact('submission','foto'));
    }
    public function print_resin($id){
        $submission= ResinM::find($id);
        $same = $submission->id;
        $ids = Resin_imageM::where('resin_id',$same)->value('id');
        $foto= Resin_imageM::find($ids);
        // dd($ids);

        return view('Form-Check.pages.material.resin.print',compact('submission','foto'));
    }
    
        //RESIN
        public function index_resin(Request $request) {
            $searchTerm = $request->input('search');
        $sort = $request->get('sort', 'id'); // Default sort by 'id'
        $direction = $request->get('direction', 'asc'); // Default direction 'asc'
    
        // Fetch data with search and sorting applied
        $query = ResinM::query();
    
        // Apply search if it exists
        if ($searchTerm) {
            $results = User::where('name', 'LIKE', '%' . $searchTerm . '%')->pluck('id');
            $query->whereIn('user_id', $results);
        }
    
        // Apply sorting
        if(Auth::user()->role == 0){
            // $data = ForkliftM::paginate(10); // 10 items per page
            $data = $query->orderBy($sort, $direction)->paginate(10);
        }else{
            $data = $query->where('user_id', Auth::user()->id)->orderBy($sort, $direction)->paginate(10);
            // $data = ForkliftM::where('user_id', Auth::user()->id)->paginate(10);
        }
            return view('Form-Check.pages.material.resin.index', compact('data','searchTerm', 'sort', 'direction'));
        }
        
        public function add_resin (){
            return view('Form-Check.pages.material.resin.add');
        }

        public function create_resin(Request $request)
    {
        
        // dd($request->all());
        // Validate the request
        $validated = $request->validate([
            'user_id' => 'required|integer',
            'shift_leader' => 'required|string',
            'date' => 'required|date',
            'time' => 'required|date_format:H:i',
            'supplier' => 'required|array',
            'jenis' => 'nullable|string',

            'cuaca' => 'nullable|string',
            'foto' => 'nullable|array',
            'keterangan' => 'nullable|string',

            'sesuai' => 'nullable|string',
            'foto1' => 'nullable|array',
            'keterangan1' => 'nullable|string',

            'kering' => 'nullable|string',
            'foto3' => 'nullable|array',
            'keterangan3' => 'nullable|string',
            
            'jumlahin' => 'nullable|string',
            'foto5' => 'nullable|array',
            'keterangan5' => 'nullable|string',
           
            'drum' => 'nullable|string',
            'foto5' => 'nullable|array',
            'keterangan6' => 'nullable|string',

        ]);

        $data = [
            'user_id' => $request->input('user_id'),
            'shift_leader' => $request->input('shift_leader'),
            'date' => $request->input('date'),
            'time' => $request->input('time'),
            'supplier' => json_encode($request->input('supplier')), // Convert array to JSON
            'jenis' => $request->input('jenis'),

            'cuaca' => $request->input('cuaca'),
            'keterangan' => $request->input('keterangan'),

            'sesuai' => $request->input('sesuai'),
            'keterangan1' => $request->input('keterangan1'),

            'kering' => $request->input('kering'),
            'keterangan3' => $request->input('keterangan3'),

            'jumlahin' => $request->input('jumlahin'),
            'keterangan5' => $request->input('keterangan5'),
            
            'drum' => $request->input('drum'),
            'keterangan6' => $request->input('keterangan6'),

        ];
    
        $crc = ResinM::create($data);
        // dd($crc->id);
        try {
            $fileNames = [];
            $fileInputs = ['foto', 'foto1','foto3','foto5','foto6'];
        
            foreach ($fileInputs as $inputName) {
                if ($request->hasFile($inputName)) {
                    $files = $request->file($inputName);
                    $uploadedFileNames = [];
        
                    foreach ($files as $file) {
                        if ($file instanceof \Illuminate\Http\UploadedFile && $file->isValid()) { // Validate the file
                            $date = now()->format('d-m-Y');
                            $name = $date . '/' . uniqid() . '.' . $file->getClientOriginalExtension();
                            $file->storeAs('resin', $name, 'public');
        
                            $uploadedFileNames[] = $name;
                        }
                    }
        
                    $fileNames[$inputName] = json_encode($uploadedFileNames);
                }
            }
        
            // Prepare data for database
            $crc_image_data = array_merge($fileNames, ['resin_id' => $crc->id]); 
        
            // Save to database
            Resin_imageM::create($crc_image_data);
        } catch (Exception $e) {
            // Handle exception
            return response()->json(['error' => $e->getMessage()], 500);
        }
        
        if (Auth::user()->role == 0){
            return redirect()->route('Form-Check.admin.resin')->with('succes', 'Submission complite');
        }else{
            return redirect()->route('Form-Check.pegawai.resin')->with('succes', 'Submission complite') ;
        }
        
    }

    public function destroy_crc($id){
        $data = CrcM::find($id);
        $data->delete();
        return redirect()->back()->with('success', 'Data berhasil Dihapus');
    }
    public function destroy_ingot($id){
        $data = IngotM::find($id);
        $data->delete();
        return redirect()->back()->with('success', 'Data berhasil Dihapus');
    }
    public function destroy_resin($id){
        $data = ResinM::find($id);
        $data->delete();
        return redirect()->back()->with('success', 'Data berhasil Dihapus');
    }


    public function resin_export(){
        $date = now()->format('d-m-Y'); 
        return Excel::download(new ResinExportExcel, $date . '_Resin.xlsx');
    }
    public function ingot_export(){
        $date = now()->format('d-m-Y'); 
        return Excel::download(new IngotExportExcel, $date . '_Resin.xlsx');
    }
    public function crc_export(){
        $date = now()->format('d-m-Y'); 
        return Excel::download(new CrcExportExcel, $date . '_Resin.xlsx');
    }
}
