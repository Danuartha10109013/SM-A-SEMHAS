<?php

namespace App\Exports;

use App\Models\CoilDamageM;
use App\Models\CraneM;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\FromView;

class CoilDamageExportExcel implements FromView, ShouldAutoSize
{
    use Exportable;

    private $data;

    public function __construct()
    {
        $this->data = CoilDamageM::all();
    }

    public function view() : View
    {
        return view('Coil-Damage.pages.admin.export', [
            'data' => $this->data
        ]);
    }
}
