<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShipB extends Model
{
    protected $table = 'shippmentb';
    protected $fillable = [
        'atribute',
        'manufactur',
        'product',
        'size',
        'gros',
        'net',
        'satuan_berat',
        'destination',
        'type',
    ];

}
