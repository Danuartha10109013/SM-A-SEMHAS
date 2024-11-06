<?php

namespace App\Exports;

use App\Models\EupM;
use App\Models\IngotM;
use App\Models\KendaraanM;
use App\Models\ResinM;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\FromView;

class IngotExportExcel implements FromView, ShouldAutoSize
{
    use Exportable;

    private $data;

    public function __construct()
    {
        $this->data = IngotM::all();
    }

    public function view() : View
    {
        return view('Form-Check.pages.material.ingot.export', [
            'data' => $this->data
        ]);
    }
}
