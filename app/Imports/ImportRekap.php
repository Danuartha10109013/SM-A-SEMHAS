<?php

namespace App\Imports;

use App\Models\Coil;
use App\Models\RekapM;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;

class ImportRekap implements ToModel
{
    private $current = 0;
    private $keterangan; // Declare the class property

    public function __construct($keterangan)
    {
        $this->keterangan = $keterangan; // Assign the constructor value to the class property
    }

    public function model(array $row)
    {
        $this->current++;

        // Skip the header row
        if ($this->current === 1) {
            return null;
        }

        // Ensure 'attribute' column is not empty
        if (empty($row[3])) {
            return null; // Skip rows with empty 'attribute'
        }

        // Check if the attribute already exists in the RekapM table
        $attributeExists = RekapM::where('attribute', $row[3])->exists();
        if ($attributeExists) {
            return null; // Skip rows where the attribute already exists
        }

        // Save valid data
        return new RekapM([
            'attribute' => $row[3],
            'no_so' => $row[2],
            'layout' => $row[1],
            'desc' => $row[4],
            'net' => $row[5],
            'gross' => $row[6],
            'length' => $row[7],
            'type' => $row[8],
            'keterangan' => $this->keterangan, // Use $this->keterangan to access the passed value
        ]);
    }
}
