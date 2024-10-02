<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CrcM extends Model
{
    use HasFactory;

    protected $table = 'crc';

    // Specify which fields can be mass-assigned
    protected $fillable = [
        'user_id',
        'shift_leader',
        'date',
        'supplier',
        'ket_awal',
        'cuaca',
        'keterangan',
        'sesuai',
        'keterangan1',
        'baik',
        'keterangan2',
        'kering',
        'keterangan3',
        'kencang',
        'keterangan4',
        'jumlahin',
        'keterangan5',
        'alas',
        'keterangan6',
        'wall',
        'keterangan7',
        'perganjalan'
    ];

    // You can add relationships here if necessary, for example:
    // public function images() {
    //     return $this->hasMany(Crc_imageM::class, 'crc_id');
    // }
}
