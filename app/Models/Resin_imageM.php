<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Resin_imageM extends Model
{
    // Specify the table name
    protected $table = 'resin_image';

    protected $fillable = [
        'resin_id',
        'foto',
        'foto1',
        'foto3',
        'foto5',
        'foto6',
    ];
}
