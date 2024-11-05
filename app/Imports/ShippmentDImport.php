<?php

namespace App\Imports;

use App\Models\ShipB;
use App\Models\ShipD;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;

class ShippmentDImport implements ToCollection,ToModel
{
    private $current = 0;
    private $satuan_berat;
    private $newType;

    /**
    * @param Collection $collection
    */
    public function __construct($satuan_berat,$newType)
    {
        $this->satuan_berat = $satuan_berat;
        $this->newType = $newType;
    }
    public function collection(Collection $collection)
    {
        // $this->current++;
        // // Mengabaikan baris header jika perlu
        // if ($this->current > 1) {
            // dd($collection);
        // }
    }
    public function model(array $row)
    {
        $this->current++;
        // Mengabaikan baris header jika perlu
        if ($this->current > 1) {
            $count = ShipD::where('atribute', $row[0])->count();
            // dd($row);
            if (empty($count)) {
                $shipa = new ShipD;
                $shipa->atribute = $row[0];
                $shipa->unicode = $row[1];
                $shipa->destination = $row[2];
                $shipa->size = $row[3];
                $shipa->type = $row[4];
                $shipa->save();


            }
            
            
        }
    }
}
