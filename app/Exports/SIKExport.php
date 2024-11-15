<?php
namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SIKExport implements FromCollection, WithHeadings
{
    protected $data;

    // Constructor to accept the data passed from the controller
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        // Modify the collection to add 'created_at' as the timestamp
        return $this->data->map(function ($item) {
            return [
                $item->id,                          // ID
                $item->created_at,                   // TimeStamp -> Created at
                $item->date,                         // Date
                $item->kode_sik,                     // Kode Sik
                $item->status,                       // Status
                $item->bagian,                       // Bagian
                $item->keperluan,                    // Keperluan
                $item->no_kendaraan,                 // No Kendaraan
                $item->pemberi_izin,                 // Pemberi Izin
                $item->pemberi_izin_ttd,             // Pemberi Izin TTD
                $item->muatan,                       // Muatan
                $item->satpam,                       // Satpam
                $item->satpam_ttd,                   // Satpam TTD
                $item->pengemudi,                    // Pengemudi
                $item->pengemudi_ttd,                // Pengemudi TTD
                $item->diizinkan,                    // Diizinkan
                $item->created_at,                   // Created At
                $item->updated_at,                   // Updated At
            ];
        });
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'ID',                                // ID
            'TimeStamp',                         // TimeStamp -> Created at
            'Date',                               // Date
            'Kode Sik',                           // Kode Sik
            'Status',                             // Status
            'Bagian',                             // Bagian
            'Keperluan',                          // Keperluan
            'No Kendaraan',                       // No Kendaraan
            'Pemberi Izin',                       // Pemberi Izin
            'Pemberi Izin TTD',                   // Pemberi Izin TTD
            'Muatan',                             // Muatan
            'Satpam',                             // Satpam
            'Satpam TTD',                         // Satpam TTD
            'Pengemudi',                          // Pengemudi
            'Pengemudi TTD',                      // Pengemudi TTD
            'Diizinkan',                          // Diizinkan
            'Created At',                         // Created At
            'Updated At',                         // Updated At
        ];
    }
}
