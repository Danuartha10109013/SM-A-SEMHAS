<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplyM extends Model
{
    use HasFactory;
    protected $table = 'supply';
    protected $fillable = [
        'shift_leader',
        'created_at',
        'shift',
        'supply',
        'foto',
        'user_id',
        'catatan',
    ];
}
