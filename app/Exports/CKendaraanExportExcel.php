<?php

namespace App\Exports;

use App\Models\KendaraanM;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\FromView;

class CKendaraanExportExcel implements FromView, ShouldAutoSize
{
    use Exportable;

    private $data;

    public function __construct()
    {
        $this->data = KendaraanM::all();
    }

    public function view() : View
    {
        return view('Kendaraan.pages.admin.export', [
            'data' => $this->data
        ]);
    }
}
