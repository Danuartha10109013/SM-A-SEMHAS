<?php

namespace App\Http\Controllers;

use App\Models\CraneM;
use App\Models\CrcM;
use App\Models\ForkliftM;
use App\Models\IngotM;
use App\Models\ResinM;
use App\Models\ShipA;
use App\Models\ShipB;
use App\Models\ShipC;
use App\Models\ShipD;
use App\Models\TraillerM;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

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
}
