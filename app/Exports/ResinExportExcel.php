<?php

namespace App\Exports;

use App\Models\EupM;
use App\Models\KendaraanM;
use App\Models\ResinM;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\FromView;

class ResinExportExcel implements FromView, ShouldAutoSize
{
    use Exportable;

    private $data;

    public function __construct()
    {
        $this->data = ResinM::all();
    }

    public function view() : View
    {
        return view('Form-Check.pages.material.resin.export', [
            'data' => $this->data
        ]);
    }
}
