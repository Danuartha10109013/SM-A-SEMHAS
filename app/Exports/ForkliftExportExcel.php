<?php

namespace App\Exports;

use App\Models\CraneM;
use App\Models\ForkliftM;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\FromView;

class ForkliftExportExcel implements FromView, ShouldAutoSize
{
    use Exportable;

    private $data;

    public function __construct()
    {
        $this->data = ForkliftM::all();
    }

    public function view() : View
    {
        return view('Form-Check.pages.forklift.export', [
            'data' => $this->data
        ]);
    }
}
