<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KondisiM extends Model
{
    use HasFactory;

    protected $table= 'kondisi';
    protected $fillable = [
        'kondisi',
        'type',
    ];
}
