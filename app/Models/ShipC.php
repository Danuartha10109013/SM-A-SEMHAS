<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShipC extends Model
{
    use HasFactory;

    // Specify the table name
    protected $table = 'shippmentc';

    // Define the fillable fields
    protected $fillable = [
        'atribute',
        'unicode',
        'pod',
        'product',
        'size',
        'gros',
        'net',
        'satuan_berat',
        'type'
    ];
}
