<?php

namespace App\Imports;

use App\Models\MapCoil;
use App\Models\MapCoilTruck;
use App\Models\Pengecekan;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use App\Models\Shipment;
use Illuminate\Support\Facades\Log;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class ExcelImport implements ToCollection, ToModel
{
    private $current = 0;

    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        // Handle the collection if needed
    }

    public function model(array $row)
    {
        $this->current++;
    
        if ($this->current > 1) { // Skip the header row
            // Convert Excel serial date to PHP DateTime object if necessary
            $date = $row[1];
            $formattedDate = $this->formatDate($date);
            
            // Prepare the shipment data
            $shipmentData = [
                'no_gs' => $row[0] ?? null,
                'tgl_gs' => $formattedDate,
                'no_so' => $row[2] ?? null,
                'no_po' => $row[3] ?? null,
                'no_do' => $row[4] ?? null,
                'no_container' => $row[5] ?? null,
                'no_seal' => $row[6] ?? null,
                'no_mobil' => $row[7] ?? null,
                'forwarding' => $row[8] ?? null,
                'kepada' => $row[9] ?? null, // Ensure this is filled
                'alamat_pengirim' => $row[10] ?? null,
                'alamat_tujuan' => $row[11] ?? null,
                'tare' => $row[12] ?? null,
            ];
            // dd($shipmentData);
    
            // Validate the required fields
            if ($this->validateShipmentData($shipmentData)) {
                $shipment = new Shipment();
                $shipment->fill($shipmentData);
                $shipment->save();
    
                // Create related records
                $this->createRelatedRecords($row[0]);
            } else {
                Log::warning('Missing required shipment data.', ['row' => $row]);
            }
        }
    }
    

    private function formatDate($date)
    {
        if (is_numeric($date)) {
            $date = Date::excelToDateTimeObject($date);
            return $date->format('Y-m-d');
        }
        return date('Y-m-d', strtotime($date));
    }

    private function validateShipmentData(array $data)
    {
        return !empty($data['no_gs']) && !empty($data['no_po']) && !empty($data['no_so']);
    }

    private function createRelatedRecords($no_gs)
    {
        $pengecekan = new Pengecekan;
        $pengecekan->no_gs = $no_gs;
        $pengecekan->save();

        $mapcoil = new MapCoil;
        $mapcoil->no_gs = $no_gs;
        $mapcoil->save();

        $mapcoilTruck = new MapCoilTruck;
        $mapcoilTruck->no_gs = $no_gs;
        $mapcoilTruck->save();
    }
}
