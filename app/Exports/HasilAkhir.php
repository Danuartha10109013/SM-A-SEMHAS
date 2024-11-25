<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\FromView;

class HasilAkhir implements FromView, ShouldAutoSize
{
    use Exportable;

    private $ket;
    private $search;
    private $sort;
    private $direction;
    private $tableAlias;

    public function __construct($ket, $search = null, $sort = 'attribute', $direction = 'asc')
    {
        $this->ket = $ket;
        $this->search = $search;
        $this->sort = $sort;
        $this->direction = $direction;

        // Tentukan alias tabel untuk kolom sort
        $this->tableAlias = in_array($sort, ['attribute', 'another_datab_column']) ? 'datab' : 'scan';
    }

    public function view(): View
    {
        $query = DB::table('datab')
            ->join('scan', 'datab.attribute', '=', 'scan.attribute')
            ->select('datab.*', 'scan.*');

        if ($this->ket) {
            $query->where('scan.keterangan', $this->ket);
        }

        if ($this->search) {
            $query->where('datab.attribute', 'LIKE', '%' . $this->search . '%');
        }

        $query->orderBy($this->tableAlias . '.' . $this->sort, $this->direction);

        $data = $query->get();

        return view('Packing-List.pages.admin.hasil.export', compact('data'));
    }
}
