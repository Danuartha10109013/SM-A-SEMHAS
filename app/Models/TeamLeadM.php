<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamLeadM extends Model
{
    use HasFactory;

    protected $table = 'team_leader';

    protected $fillable = [
        'name',
        'division',
        'active',
        'user_id',
        'type',
    ];
}
