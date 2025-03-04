<?php

namespace App\Imports;

use App\Models\ShipB;
use App\Models\ShipE;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;

class ShippmentEImport implements ToCollection,ToModel
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
        //     dd($collection);
        // }
    }
    public function model(array $row)
    {
        // dd($row);
        $this->current++;
        // Mengabaikan baris header jika perlu
        if ($this->current > 1) {
            $count = ShipE::where('attribute', $row[1])->count();
            // dd($row);
            if (empty($count)) {
                $shipa = new ShipE;
                $shipa->attribute = $row[1];
                $shipa->no_so = $row[0];
                $shipa->name = $row[2];
                $shipa->pod = $row[3];
                $shipa->product = $row[4];
                $shipa->weight = $row[5];
                $shipa->satuan_berat = $this->satuan_berat;
                $shipa->save();


            }
            
            
        }
    }
}
