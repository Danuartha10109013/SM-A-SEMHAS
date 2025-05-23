<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KapasitasM extends Model
{
    use HasFactory;

    protected $table = 'kapasitas';

    protected $fillable = [
        'name',
        'jenis',
        'division',
    ];
}
