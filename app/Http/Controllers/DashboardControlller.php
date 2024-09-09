<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class DashboardControlller extends Controller
{
    public function index(){
        return view('pegawai.index');
    }
}
