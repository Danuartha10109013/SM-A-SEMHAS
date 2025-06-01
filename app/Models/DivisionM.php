<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DivisionM extends Model
{
    use HasFactory;

    protected $table = 'division';

    protected $fillable = [
        'division',
        'keterangan',
        'status',
        'type',
    ];
}
