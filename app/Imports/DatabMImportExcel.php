<?php

namespace App\Imports;

use App\Models\DatabM;
use App\Models\ShipA;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class DatabMImportExcel implements ToCollection,ToModel
{
    private $current = 0;
    private $satuan_berat;

    /**
    * @param Collection $collection
    */
    
    public function collection(Collection $collection)
    {
        $this->current++;
        }
        public function model(array $row)
        {
        $this->current++;
        if ($this->current > 4) {
            $count = DatabM::where('attribute', $row[8])->count();
            if (empty($count)) {
                $data = new DatabM();
                $data->kode = $row[5];
                $data->nama_produk = $row[6];
                $data->qty = str_replace(',', '', $row[11]); // Remove commas from qty
                $data->uom = $row[12];
                $data->attribute = $row[8];
                $data->storage_bin = $row[3];
                $data->panjang = $row[9];

                // Convert Excel date format to 'Y-m-d'
                $data->date = is_numeric($row[10]) 
                    ? Date::excelToDateTimeObject($row[10])->format('Y-m-d') 
                    : null;

                $data->user_id = Auth::user()->id;
                $data->save();
            }
            
        }
    }
}
