<?php

namespace App\Imports;

use App\Models\ShipA;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;

class ShippmentAImport implements ToCollection,ToModel
{
    private $current = 0;
    private $satuan_berat;

    /**
    * @param Collection $collection
    */
    public function __construct($satuan_berat,$newType)
    {
        $this->satuan_berat = $satuan_berat;
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
            $count = ShipA::where('atribute', $row[0])->count();
            // dd($count);
            if (empty($count)) {
                $shipa = new ShipA;
                $shipa->atribute = $row[0];
                $shipa->unicode = $row[1];
                $shipa->size = $row[2];
                $shipa->weight = $row[3];
                $shipa->destination = $row[4];
                $shipa->satuan_berat = $this->satuan_berat;
                $shipa->type = $row[5];
                $shipa->save();


            }
            
            
        }
    }
}
