<?php

namespace App\Http\Controllers;

use App\Models\CraneM;
use App\Models\CrcM;
use App\Models\Crc_imageM;
use App\Models\Ingot_imageM;
use App\Models\IngotM;
use App\Models\Resin_imageM;
use App\Models\ResinM;
use App\Models\TraillerM;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MaterialController extends Controller
{

    //CRC
    public function index_crc() {
        if(Auth::user()->role == 0){
            $data = CrcM::paginate(10); // 10 items per page
        }else{
            $data = CrcM::where('user_id', Auth::user()->id)->paginate(10);
        }
        return view('Form-Check.pages.material.crc.index', compact('data'));
    }
    

    public function add_crc (){
        return view('Form-Check.pages.material.crc.add');
    }
    
    public function show_crc ($id){
        $data = CrcM::find($id);
        return view('Form-Check.pages.material.crc.show',compact('data'));
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

    //INGOT
    public function index_ingot() {
        if(Auth::user()->role == 0){
            $data = IngotM::paginate(10); // 10 items per page
        }else{
            $data = IngotM::where('user_id', Auth::user()->id)->paginate(10);
        } // 10 items per page
        return view('Form-Check.pages.material.ingot.index', compact('data'));
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

        //RESIN
        public function index_resin() {
            if(Auth::user()->role == 0){
                $data = ResinM::paginate(10); // 10 items per page
            }else{
                $data = ResinM::where('user_id', Auth::user()->id)->paginate(10);
            } // 10 items per page
            return view('Form-Check.pages.material.resin.index', compact('data'));
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
}
