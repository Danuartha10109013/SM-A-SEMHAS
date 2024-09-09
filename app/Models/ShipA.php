<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShipA extends Model
{
    protected $table = 'shippmenta';
    protected $fillable = [
        'atribute',
        'unicode',
        'size',
        'weight',
        'satuan_berat',
        'destination',
        'type',

    ];
}
