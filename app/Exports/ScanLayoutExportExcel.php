<?php

namespace App\Exports;

use App\Models\EupM;
use App\Models\IngotM;
use App\Models\KendaraanM;
use App\Models\ResinM;
use App\Models\ScanLayoutM;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\FromView;

class ScanLayoutExportExcel implements FromView, ShouldAutoSize
{
    use Exportable;

    private $data;

    public function __construct()
    {
        $this->data = ScanLayoutM::all();
    }

    public function view() : View
    {
        return view('Scan-Layout.pages.admin.export', [
            'data' => $this->data
        ]);
    }
}
