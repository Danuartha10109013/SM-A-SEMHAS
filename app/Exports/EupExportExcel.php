<?php

namespace App\Exports;

use App\Models\EupM;
use App\Models\KendaraanM;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\FromView;

class EupExportExcel implements FromView, ShouldAutoSize
{
    use Exportable;

    private $data;

    public function __construct()
    {
        $this->data = EupM::all();
    }

    public function view() : View
    {
        return view('Form-Check.pages.eup.export', [
            'data' => $this->data
        ]);
    }
}
