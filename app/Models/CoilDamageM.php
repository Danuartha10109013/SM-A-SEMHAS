<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CoilDamageM extends Model
{
    use HasFactory;

    protected $table = 'coil_damage';

    protected $fillable = [
        'attribute',
        'berat_coil',
        'jenis_handling',
        'foto',
        'keterangan',
        'user_id',
    ];
}
