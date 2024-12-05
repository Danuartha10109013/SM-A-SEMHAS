<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RekapM extends Model
{
    use HasFactory;

    protected $table = 'rekap';

    protected $fillable = [
        'packing',
        'attribute',
        'no_so',
        'layout',
        'desc',
        'net',
        'gross',
        'length',
        'type',
        'keterangan',
        'checks',
    ];
}
