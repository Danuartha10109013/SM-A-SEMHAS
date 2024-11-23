<?php

namespace App\Exports;

use App\Models\DatabM;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\FromView;

class HasilAkhir implements FromView, ShouldAutoSize
{
    use Exportable;

    private $data;

    public function __construct($ket)
    {
        if ($ket == null){
            $this->data = DatabM::join('scan', 'datab.attribute', '=', 'scan.attribute')
                ->select('datab.*', 'scan.*')
                ->get();
        }else{
            $this->data = DatabM::join('scan', 'datab.attribute', '=', 'scan.attribute')
                ->select('datab.*', 'scan.*')
                ->where('scan.keterangan', $ket)
                ->get();
        }

    }

    public function view(): View
    {
        // Debug jika data tidak sesuai
        // dd($this->data);

        return view('Packing-List.pages.admin.hasil.export', [
            'data' => $this->data,
        ]);
    }
}
