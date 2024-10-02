<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ingot_imageM extends Model
{
    // Specify the table name
    protected $table = 'ingot_image';

    // Define the fillable fields
    protected $fillable = [
        'ingot_id',
        'foto',
        'foto1',
        'foto3',
        'foto5',
    ];
}
