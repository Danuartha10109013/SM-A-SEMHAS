<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IngotM extends Model
{
    // Specify the table name
    protected $table = 'ingot';

    // Define the fillable fields
    protected $fillable = [
        'user_id',
        'shift_leader',
        'jalan',
        'date',
        'time',
        'supplier',
        'jenis',
        'cuaca',
        'keterangan',
        'sesuai',
        'keterangan1',
        'kering',
        'keterangan3',
        'jumlahin',
        'keterangan5',
    ];
}
