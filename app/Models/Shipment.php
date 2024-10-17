<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipment extends Model
{
    use HasFactory;

    // Menentukan nama tabel secara eksplisit
    protected $table = 'shipment';

    // Menentukan kolom yang dapat diisi (mass assignable)
    protected $fillable = [
        'no_gs',
        'tgl_gs',
        'no_so',
        'no_po',
        'no_do',
        'no_container',
        'no_seal',
        'no_mobil',
        'forwarding',
        'Kepada',
        'alamat_pengirim',
        'alamat_tujuan',
    ];

    // Primary key disesuaikan dengan tipe data
    protected $primaryKey = 'id';

    // Mengaktifkan timestamps
    public $timestamps = true;
}
