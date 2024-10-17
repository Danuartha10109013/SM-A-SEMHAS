<?php

namespace App\Imports;

use App\Models\Coil;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;

class ExcelKoilImport implements ToCollection, ToModel
{
    private $current = 0;

    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        // dd($collection);
    }

    public function model(array $row)
    {
        $this->current++;
        
        if ($this->current > 1) {
            // Convert Excel serial date to PHP DateTime object if necessary
            
            $count = Coil::where('kode_produk', $row[0])->count();
            if (empty($count)) {
                // dd($row);
                $coil = new Coil;
                $coil->kode_produk = $row[0];
                $coil->nama_produk = $row[1];
                $coil->berat_produk = $row[2];
                $coil->diameter_produk = $row[3];
                $coil->lebar_produk= $row[4];
                $coil->keterangan = $row[5];
                $coil->no_gs = $row[6];
                $coil->save();
            }
        }
    }
}
