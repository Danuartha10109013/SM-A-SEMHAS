<?php

namespace App\Imports;

use App\Models\DatabM;
use App\Models\ShipA;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;

class DatabaseImport implements ToCollection,ToModel
{
    private $current = 0;
    private $satuan_berat;

    /**
    * @param Collection $collection
    */
    
    public function collection(Collection $collection)
    {
        $this->current++;
        // Mengabaikan baris header jika perlu
        // if ($this->current > 1) {
        //     dd($collection);
        // }
    }
    public function model(array $row)
    {
        $this->current++;
        // Skip the header row
        if ($this->current > 2) {
            // Check if $row[1] (kode) is not null or empty
            if (!empty($row[1])) {
                $count = DatabM::where('attribute', $row[11])->count();
                // dd(strpos($row[12], '10-CBT'));
                // Only insert if 'attribute' doesn't already exist
                if ($count == 0 &&  strpos($row[12], '10-CBT') !== false) {
                    $data = new DatabM;
                    $data->kode = $row[1]; // Ensure this is not null
                    $data->nama_produk = $row[2];
                    $data->qty = str_replace(',', '', $row[9]); // Remove any commas from the qty value
                    $data->uom = $row[10];
                    $data->attribute = $row[11];
                    $data->storage_bin = $row[12];
                    $date = \DateTime::createFromFormat('d/m/Y', $row[17]); // Assuming row[8] is the date
                    $data->date = $date ? $date->format('Y-m-d') : null;
                    $data->user_id = Auth::user()->id;
                    $data->save();
                }
            } else {
                // Handle the case where 'kode' is missing, e.g., log an error or skip the row
                // You can use logging or throw an exception to catch these cases.
                \Log::warning("Row skipped due to missing 'kode': " . json_encode($row));
            }
        }
    }
}
