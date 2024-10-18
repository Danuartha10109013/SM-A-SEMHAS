<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScanM extends Model
{
    use HasFactory;

    protected $table = 'scan';
    protected $fillable=[
        'user_id',
        'attribute',
        'panjang',
        'kondisi',
        'tujuan',
        'keterangan',
    ];
}
