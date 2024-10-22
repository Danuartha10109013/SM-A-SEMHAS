<?php

namespace App\Exports;

use App\Models\CraneM;
use App\Models\ForkliftM;
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
        $this->data = ScanM::all();

    }

    public function view() : View
    {
        return view('Packing-List.pages.admin.hasil.export', [
            'data' => $this->data
        ]);
    }
}
