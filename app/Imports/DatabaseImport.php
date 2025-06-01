<?php
namespace App\Imports;

use App\Models\DatabM;
use App\Models\ShipA;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;

class DatabaseImport implements ToCollection, ToModel
{
    private $current = 0;
    private $added = 0;
    private $existing = 0;
    private $skipped = 0;

    public function collection(Collection $collection)
    {
        // Optional, handle preview or header
    }

    public function model(array $row)
    {
        $this->current++;

        if ($this->current > 2) {
            if (!empty($row[1])) {
                $exists = DatabM::where('attribute', $row[11])->exists();

                if (!$exists && strpos($row[12], '10-CBT') !== false) {
                    $data = new DatabM;
                    $data->kode = $row[1];
                    $data->nama_produk = $row[2];
                    $data->qty = str_replace(',', '', $row[9]);
                    $data->uom = $row[10];
                    $data->attribute = $row[11];
                    $data->storage_bin = $row[12];
                    $date = \DateTime::createFromFormat('d/m/Y', $row[17]);
                    $data->date = $date ? $date->format('Y-m-d') : null;
                    $data->user_id = Auth::user()->id;
                    $data->save();

                    $this->added++;
                } else {
                    $this->existing++;
                }
            } else {
                $this->skipped++;
                Log::warning("Skipped row (missing kode): " . json_encode($row));
            }
        }
    }

    public function getSummary()
    {
        return [
            'added' => $this->added,
            'existing' => $this->existing,
            'skipped' => $this->skipped,
        ];
    }
}
