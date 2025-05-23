<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrailerNameM extends Model
{
    use HasFactory;

    protected $table = 'trailler_name';
    protected $fillable = [
        'no_mobil',
        'pengguna',
    ];
}
