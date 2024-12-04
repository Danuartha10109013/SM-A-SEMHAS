<?php

namespace App\Imports;

use App\Models\PackingDetailM;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;

class ImportGM implements ToModel
{
    private $current = 0;
    private $shift = 0;
    private $shift_leader = 0;

    public function __construct($shift,$shift_leader)
    {
        $this->shift = $shift;
        $this->shift_leader = $shift_leader;
    }

    public function model(array $row)
    {
        $this->current++;

        if ($this->current > 1) { // Skip the header row
            $count = PackingDetailM::where('attribute', $row[0])->count();
            
            if ($count == 0) { // Only add if record doesn't exist
                return new PackingDetailM([
                    'attribute' => $row[2],
                    'gm' => $row[10],
                    'b_label' => $row[6],
                    'operator' => Auth::user()->id,
                    'shift' => $this->shift,
                    'shift_leader' => $this->shift_leader,
                ]);
            }
        }

        return null; // No model to persist
    }
}
