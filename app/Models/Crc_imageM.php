<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Crc_imageM extends Model
{
    protected $table = "crc_image";

    protected $fillable = [
        'crc_id',
        'foto',
        'foto1',
        'foto2',
        'foto3',
        'foto4',
        'foto5',
        'foto6',
        'foto7',
    ];
}
