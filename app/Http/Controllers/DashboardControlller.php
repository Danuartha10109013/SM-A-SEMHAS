<?php

namespace App\Http\Controllers;

use App\Models\CraneM;
use App\Models\CrcM;
use App\Models\DatabM;
use App\Models\ForkliftM;
use App\Models\IngotM;
use App\Models\KendaraanM;
use App\Models\PackingM;
use App\Models\ResinM;
use App\Models\ScanLayoutM;
use App\Models\ScanM;
use App\Models\ShipA;
use App\Models\ShipB;
use App\Models\ShipC;
use App\Models\ShipD;
use App\Models\TraillerM;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardControlller extends Controller
{
    public function index(){
        $a = ShipA::distinct('type')->count('type');
        $b = ShipB::distinct('type')->count('type');

        $a_count = ShipA::count();
        $b_count = ShipB::count();
        $c_count = ShipC::count();
        $d_count = ShipD::count();
        $total = $a_count + $b_count;
        $totalcolection = $a + $b ;
        // dd($data);
        return view('pegawai.index', compact('a_count','b_count','c_count','d_count', 'total','totalcolection'));
    }

    public function fcindex(){
        $user = 'a';
        $form = CraneM::count()+ForkliftM::count()+TraillerM::count()+CrcM::count()+IngotM::count()+ResinM::count();
        $response = User::where('role','!=',1)->count();
        return view('Form-Check.index',compact('user','form','response'));
    }

    public function fc_pegawai(){
        return view('Form-Check.pages.pegawai.index');
    }
    public function op_admin(){
        $form = PackingM::all()->count();
        $gm = PackingM::distinct('gm')->count('gm');

        $formattedDate = PackingM::min('created_at');
        $response = Carbon::parse($formattedDate)->format('d-m-Y');        
        return view('Open-Packing.pages.admin.index',compact('gm','form','response'));
    }
    public function sp_admin(){
        $form = PackingM::all()->count();
        $gm = PackingM::distinct('gm')->count('gm');

        $formattedDate = PackingM::min('created_at');
        $response = Carbon::parse($formattedDate)->format('d-m-Y');        
        return view('Supply-Bahan.pages.admin.index',compact('gm','form','response'));
    }
    public function pl_admin(){
        $form = DatabM::all()->count();
        $gm = ScanM::distinct('keterangan')->count('keterangan');

        $formattedDate = DatabM::min('created_at');
        $response = Carbon::parse($formattedDate)->format('d-m-Y');        
        return view('Packing-List.pages.admin.index',compact('gm','form','response'));
    }

    public function k_admin(){
        $data = KendaraanM::all();
        return view('Kendaraan.pages.admin.index',compact('data'));
    }
    
    public function k_pegawai(){
        $records= KendaraanM::all();
        return view('Kendaraan.pages.pegawai.index',compact('records'));

    }

    public function a_scan(){
        $data = ScanLayoutM::all();
        if(Auth::user()->role == 0){
            return view('Scan-Layout.pages.admin.index',compact('data'));
        }else{
            return view('Scan-Layout.pages.pegawai.index',compact('data'));
        }

    }
}
