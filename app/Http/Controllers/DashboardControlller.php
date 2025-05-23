<?php

namespace App\Http\Controllers;

use App\Models\CoilDamageM;
use App\Models\CraneM;
use App\Models\CrcM;
use App\Models\DatabM;
use App\Models\EupM;
use App\Models\ForkliftM;
use App\Models\IngotM;
use App\Models\KendaraanM;
use App\Models\PackingL08M;
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
use Illuminate\Support\Facades\DB;

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
        $form = CraneM::count()+ForkliftM::count()+TraillerM::count()+CrcM::count()+IngotM::count()+ResinM::count()+EupM::count();
        $response = User::where('role','!=',1)->count();
        return view('Form-Check.index',compact('user','form','response'));
    }

    public function fc_pegawai(){
        $user = 'a';
        $form = CraneM::count()+ForkliftM::count()+TraillerM::count()+CrcM::count()+IngotM::count()+ResinM::count()+EupM::count();
        $response = User::where('role','!=',1)->count();
        return view('Form-Check.pages.pegawai.index',compact('form','response'));
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
        $data = KendaraanM::orderBy('created_at', 'desc')->get();
        return view('Kendaraan.pages.admin.index',compact('data'));
    }
    
    public function k_pegawai(){
        $records= KendaraanM::orderBy('created_at', 'desc')->get();
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
    
    public function coil_damage(Request $request) {
        // Get the distinct years from the 'coil_damage' table
        $years = DB::table('coil_damage')
                    ->select(DB::raw('YEAR(created_at) as year'))
                    ->distinct()
                    ->orderBy('year', 'desc') // Optional: order the years in descending order
                    ->paginate(10);
    
        // Get selected year from the request, or default to the current year
        $selectedYear = $request->input('year', date('Y'));
        
        // Get selected month from the request
        $month = $request->input('month');
    
        // Get search term from the request
        $search = $request->input('search');
    
        // Start query with year filter
        $query = DB::table('coil_damage')
                    ->whereYear('created_at', $selectedYear);
    
        // Apply month filter if provided
        if ($month) {
            $query->whereMonth('created_at', $month);
        }
    
        // Apply search filter if provided
        if ($search) {
            $query->where('attribute', 'like', '%' . $search . '%');
        }
    
        // Chart Data
        $chart = $query->selectRaw('MONTH(created_at) as month, COUNT(*) as total')
                        ->groupBy(DB::raw('MONTH(created_at)'))
                        ->get();
    
        // Fetch search data for the table
        $data = CoilDamageM::when($search, function($query) use ($search) {
            return $query->where('attribute', 'like', '%' . $search . '%');
        })->whereYear('created_at', $selectedYear)
          ->when($month, function($query) use ($month) {
              return $query->whereMonth('created_at', $month);
          })
          ->paginate(10);
    
        return view('Coil-Damage.pages.admin.index', [
            'years' => $years,
            'selectedYear' => $selectedYear,
            'chart' => $chart,
            'data' => $data,
            'selectedMonth' => $month,
            'search' => $search
        ]);
    }

    public function l_08(Request $request) {
        // Get the distinct years from the 'coil_damage' table
        $years = DB::table('packingl08')
                    ->select(DB::raw('YEAR(created_at) as year'))
                    ->distinct()
                    ->orderBy('year', 'desc') // Optional: order the years in descending order
                    ->paginate(10);
    
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
    
        // Chart Data
        $chart = $query->selectRaw('MONTH(created_at) as month, COUNT(*) as total')
                        ->groupBy(DB::raw('MONTH(created_at)'))
                        ->get();
    
        // Fetch search data for the table
        $data = PackingL08M::when($search, function($query) use ($search) {
            return $query->where('attribute', 'like', '%' . $search . '%');
        })->whereYear('created_at', $selectedYear)
          ->when($month, function($query) use ($month) {
              return $query->whereMonth('created_at', $month);
          })
          ->get();

          if($selectedYear){

              $data2 = DB::table('packingl08')
              ->selectRaw("DATE_FORMAT(created_at, '%Y-%m') AS month, `group`, COUNT(attribute) AS count")
              ->groupBy('month', 'group')
              ->orderBy('month')
              ->orderBy('group')->whereYear('created_at', $selectedYear)
              ->get();
          }else{
          $data2 = DB::table('packingl08')
          ->selectRaw("DATE_FORMAT(created_at, '%Y-%m') AS month, `group`, COUNT(attribute) AS count")
          ->groupBy('month', 'group')
          ->orderBy('month')
          ->orderBy('group')
          ->get();
          }
  
      $chartData = [];
      foreach ($data2 as $row) {
          $chartData[$row->month][$row->group] = $row->count;
      }

        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        if ($startDate && $endDate) {
            $dataToday = DB::table('packingl08')
                ->selectRaw("DATE_FORMAT(created_at, '%Y-%m-%d') AS date, `group`, COUNT(attribute) AS count")
                ->whereBetween('created_at', [$startDate, $endDate])
                ->groupBy('date', 'group')
                ->orderBy('date')
                ->orderBy('group')
                ->get();
        } else {
            $dataToday = DB::table('packingl08')
                ->selectRaw("DATE_FORMAT(created_at, '%Y-%m-%d') AS date, `group`, COUNT(attribute) AS count")
                ->whereDate('created_at', now()->toDateString())
                ->groupBy('date', 'group')
                ->orderBy('date')
                ->orderBy('group')
                ->get();
        }

        $chartDataToday = [];
        foreach ($dataToday as $row) {
            $chartDataToday[$row->date][$row->group] = $row->count;
        }

        if($startDate && $endDate ) {
            $data = PackingL08M::whereBetween('created_at', [$startDate, $endDate])->get();
        }

        return view('L-08.pages.admin.index', [
            'years' => $years,
            'selectedYear' => $selectedYear,
            'chart' => $chart,
            'data' => $data,
            'selectedMonth' => $month,
            'search' => $search,
            'chartData' => $chartData,
            'startDate' => $startDate,
            'endDate' => $endDate,
            'chartDataToday' => $chartDataToday,
        ]);
    }
    
    private function getRandomColor()
    {
        return sprintf('#%06X', mt_rand(0, 0xFFFFFF));
    }
    
    
}
