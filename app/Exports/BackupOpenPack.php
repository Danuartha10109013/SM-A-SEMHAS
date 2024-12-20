<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;


class BackupOpenPack implements FromView,ShouldAutoSize
{
    protected $data;
    protected $start;
    protected $end;
    use Exportable;

    public function __construct($data,$start,$end)
    {
        $this->data = $data;
        $this->start = $start;
        $this->end = $end;
    }

    public function view() : View
    {
        return view('Open-Packing.pages.admin.packing.backup', [
            'data' => $this->data,
            'start' => $this->start,
            'end' => $this->end,
        ]);
    }
}
    
