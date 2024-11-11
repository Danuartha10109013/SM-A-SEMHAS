<?php

namespace App\Http\Controllers;

use App\Models\SuratM;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SIKController extends Controller
{
    public function index(Request $request)
{
    // Get the filter value from the request or set default to 'all'
    $filter = $request->get('filter', 'all');
    $query = SuratM::where('status', '!=', '0');

    // Today filter
    if ($filter == 'today') {
        $today = now()->toDateString();
        $data = $query->where('date', $today)->get();
    }
    // Month filter
    elseif ($filter == 'month') {
        $monthStart = now()->startOfMonth()->toDateString();
        $monthEnd = now()->endOfMonth()->toDateString();
        $data = $query->whereBetween('date', [$monthStart, $monthEnd])->get();
    }
    // Year filter
    elseif ($filter == 'year') {
        $yearStart = now()->startOfYear()->toDateString();
        $yearEnd = now()->endOfYear()->toDateString();
        $data = $query->whereBetween('date', [$yearStart, $yearEnd])->get();
    }
    // All filter (default case)
    elseif ($filter == 'all'){
        $data = SuratM::all();
    }
    else{
        $today = now()->toDateString();
        $data = $query->where('date', $today)->get();
    }

    return view('Surat-Izin-Keluar.pages.index', compact('data'));
}


    public function add(){
        $today = now()->toDateString();
        $currentMonth = now()->format('m'); // Get the current month in 2 digits format (e.g., '11' for November)
        
        // Get the last record for today, but grouped by the current month
        $lastSik = SuratM::whereMonth('created_at', $currentMonth)
                         ->orderByDesc('created_at')
                         ->first();
    
        // If the last record exists and it's from the same month, increment the last number
        $lastNumber = $lastSik ? (int) substr($lastSik->kode, 3, 3) : 0;
    
        // Reset to 0 if it's a new month
        if ($lastSik && $lastSik->created_at->format('m') !== $currentMonth) {
            $lastNumber = 0;
        }
    
        // Generate new code
        $newKodeNumber = str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);
        
        $kode = $newKodeNumber . '/sik/' . $today . '/tml';
        return view('Surat-Izin-Keluar.pages.cc', compact('kode'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'kode_sik' => 'required|string',
            'bagian' => 'required|string',
            'no_kendaraan' => 'required|string',
            'pengemudi' => 'required|string',
            'muatan' => 'required|string',
            'pemberi_izin' => 'required|string',
            'signature' => 'nullable|string', 
        ]);

        $suratIzinKeluar = new SuratM();
        $suratIzinKeluar->date = $request->input('date');
        $suratIzinKeluar->status = 0;
        $suratIzinKeluar->kode_sik = $request->input('kode_sik');
        $suratIzinKeluar->bagian = $request->input('bagian');
        $suratIzinKeluar->no_kendaraan = $request->input('no_kendaraan');
        $suratIzinKeluar->pengemudi = $request->input('pengemudi');
        $suratIzinKeluar->muatan = $request->input('muatan');
        $suratIzinKeluar->keperluan = $request->input('keperluan');
        $suratIzinKeluar->pemberi_izin = $request->input('pemberi_izin');
        
        if ($request->has('signature')) {
            $signatureData = $request->input('signature');
            $signatureData = str_replace('data:image/png;base64,', '', $signatureData);
            $signatureData = base64_decode($signatureData);

            $signatureFileName = 'signature_' . time() . '.png';
            Storage::disk('public')->put('signatures/' . $signatureFileName, $signatureData);

            $suratIzinKeluar->pemberi_izin_ttd = 'storage/signatures/' . $signatureFileName;
        }

        $suratIzinKeluar->save();

        return redirect()->route('sik')->with('success', 'Surat Izin Keluar created successfully!');
    }
    
}
