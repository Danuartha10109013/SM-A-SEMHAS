<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResinM extends Model
{
    protected $table = 'resin';

    protected $fillable = [
        'user_id',
        'shift_leader',
        'date',
        'time',
        'supplier',
        'jenis',
        'cuaca',
        'keterangan',
        'sesuai',
        'kering',
        'jumlahin',
        'drum',
        'keterangan1',
        'keterangan3',
        'keterangan5',
        'keterangan6',
    ];


}
