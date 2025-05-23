<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShftM extends Model
{
    use HasFactory;
    protected $table = 'shift';

    protected $fillable = [
        'shift',
        'description',
    ];
}
