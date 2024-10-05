<?php

namespace App\Exports;

use App\Models\CraneM;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\FromView;

class CraneExportExcel implements FromView, ShouldAutoSize
{
    use Exportable;

    private $data;

    public function __construct()
    {
        $this->data = CraneM::all();
    }

    public function view() : View
    {
        return view('Form-Check.pages.crane.export', [
            'data' => $this->data
        ]);
    }
}
