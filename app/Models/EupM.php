<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EupM extends Model
{
    use HasFactory;

    // Define the table associated with this model
    protected $table = 'eup';

    // Specify the fields that are mass assignable
    protected $fillable = [
        'user_id',
        'date',
        'jenis',
        'kaki_pallet',
        'permukaan_pallet',
        'ketebalan_pallet',
        'paku_pallet',
        'keluar_pallet',
        'sesuai',
        'action',
        'foto7',
        'kaba_asimetris',
        'kaba_simteris',
        'papan_patah',
        'papan_pecah',
    ];

    // If `kaki_pallet` or `foto7` will store multiple values, you can handle it in your model using accessors/mutators
    // Example: Automatically explode/implode the pipe-separated values for kaki_pallet and foto7
    protected $casts = [
        'kaki_pallet' => 'array',  // Convert JSON string to array
        'foto7' => 'array'         // Convert JSON string to array
    ];

  
}
