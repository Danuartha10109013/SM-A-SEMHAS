<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShipE extends Model
{
    use HasFactory;

    protected $table = 'shippmente';

    // Define the fillable fields
    protected $fillable = [
        'attribute',
        'no_so',
        'name',
        'pod',
        'product',
        'weight',
        'satuan_berat',
    ];
}
