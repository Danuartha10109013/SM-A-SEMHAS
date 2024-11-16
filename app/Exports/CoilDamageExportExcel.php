<?php
namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\FromView;

class CoilDamageExportExcel implements FromView,ShouldAutoSize
{
    protected $data;
    use Exportable;


    public function __construct($data)
    {
        $this->data = $data;
    }

    public function view() : View
    {
        return view('Coil-Damage.pages.admin.export', [
            'data' => $this->data
        ]);
    }
}