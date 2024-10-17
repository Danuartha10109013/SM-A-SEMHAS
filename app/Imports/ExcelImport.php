<?php

namespace App\Imports;

use App\Models\MapCoil;
use App\Models\MapCoilTruck;
use App\Models\Pengecekan;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use App\Models\Shipment;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ExcelImport implements ToCollection, ToModel
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
            // Assuming $row[1] is the date field
            $date = $row[1];
            if (is_numeric($date)) {
                $date = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($date);
                $formattedDate = $date->format('Y-m-d');
            } else {
                // If already in a readable format
                $formattedDate = date('Y-m-d', strtotime($date));
            }

            $count = Shipment::where('no_gs', $row[0])->count();
            if (empty($count)) {
                $shipment = new Shipment;
                $shipment->no_gs = $row[0];
                $shipment->tgl_gs = $formattedDate;
                $shipment->no_so = $row[2];
                $shipment->no_po = $row[3];
                $shipment->no_do = $row[4];
                $shipment->no_container = $row[5];
                $shipment->no_seal = $row[6];
                $shipment->no_mobil = $row[7];
                $shipment->forwarding = $row[8];
                $shipment->kepada = $row[9];
                $shipment->alamat_pengirim = $row[10];
                $shipment->alamat_tujuan = $row[11];
                $shipment->save();

                $pengecekan = new Pengecekan;
                $pengecekan->no_gs = $row[0];
                $pengecekan->save();

                $mapcoil = new MapCoil;
                $mapcoil->no_gs = $row[0];
                $mapcoil->save();

                $mapcoil = new MapCoilTruck;
                $mapcoil->no_gs = $row[0];
                $mapcoil->save();
            }
        }
    }

}

