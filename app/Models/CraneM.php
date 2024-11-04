<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CraneM extends Model
{
    // Specify the table name if it doesn't follow the Laravel naming convention
    protected $table = 'crane';

    // Define the fillable fields
    protected $fillable = [
        'user_id',
        'shift',
        'shift_leader',
        'jenis_crane',
        'date',
        'start',
        'ket_start',
        'switch',
        'ket_switch',
        'up',
        'ket_up',
        'down',
        'ket_down',
        'ctravel',
        'ket_ctravel',
        'ltravel',
        'ket_ltravel',
        'emergency',
        'ket_emergency',
        'speed1',
        'ket_speed1',
        'speed2',
        'ket_speed2',
        'block',
        'ket_block',
        'lockert',
        'ket_lockert',
        'wire',
        'ket_wire',
        'sltravel',
        'ket_sltravel',
        'sirinelt',
        'ket_sirinelt',
        'brakeno',
        'ket_brakeno',
        'brakeya',
        'ket_brakeya',
        'bcno',
        'ket_bcno',
        'bcya',
        'ket_bcya',
        'updno',
        'ket_updno',
        'updya',
        'ket_updya',
        'crcros',
        'ket_crcros',
        'catatan',
        'mtc'
    ];

    // Define the relationship with the User model (if you have a User model)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
