<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DatabM extends Model
{
    use HasFactory;

    // Specify the table name if it's different from the plural form of the model name
    protected $table = 'datab';

    // Define the fillable attributes to allow mass assignment
    protected $fillable = [
        'kode',
        'nama_produk',
        'qty',
        'uom',
        'attribute',
        'storage_bin',
        'date',
        'user_id',
        'kode',
        'panjang',
    ];

}
