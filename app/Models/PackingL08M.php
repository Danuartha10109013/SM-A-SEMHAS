<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PackingL08M extends Model
{
    use HasFactory;

    protected $table = 'packingl08';

    protected $fillable =[
        'attriibute',
        'kondisi',
        'group',
        'layout_kontainer',
        'no_sales',
        'user_id',
    ];
    
}
