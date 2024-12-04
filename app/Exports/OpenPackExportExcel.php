<?php
namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\FromView;

class OpenPackExportExcel implements FromView,ShouldAutoSize
{
    protected $data;
    protected $gm;
    protected $date;
    protected $jenis;
    protected $leader;
    protected $shift;
    use Exportable;


    public function __construct($data,$gm,$date,$leader,$shift)
    {
        $this->data = $data;
        $this->gm = $gm;
        $this->date = $date;
        $this->leader = $leader;
        $this->shift = $shift;
    }

    public function view() : View
    {
        return view('Open-Packing.pages.admin.packing.export', [
            'data' => $this->data,
            'gm' => $this->gm,
            'date' => $this->date,
            'jenis' => $this->jenis,
            'leader' => $this->leader,
            'shift' => $this->shift,
        ]);
    }
}