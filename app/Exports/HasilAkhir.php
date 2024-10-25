<?php

namespace App\Exports;

use App\Models\DatabM;
use App\Models\ScanM;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\FromView;

class HasilAkhir implements FromView, ShouldAutoSize
{
    use Exportable;

    private $data;

    public function __construct()
    {
        // Menggabungkan tabel DatabM dan ScanM berdasarkan 'attribute'
        $this->data = DatabM::join('scan', 'datab.attribute', '=', 'scan.attribute')
            ->select('datab.*', 'scan.*') // Pilih kolom yang ingin ditampilkan
            ->get();
    }

    public function view() : View
    {
        return view('Packing-List.pages.admin.hasil.export', [
            'data' => $this->data,
        ]);
    }
}
