<?php

namespace App\Http\Controllers;

use App\Models\ShipA;
use App\Models\ShipB;
use App\Models\ShipC;
use App\Models\ShipD;
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
}
