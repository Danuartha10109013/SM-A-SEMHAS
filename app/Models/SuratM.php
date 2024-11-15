<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratM extends Model
{
 
    use HasFactory;

    protected $table = 'surat';
    protected $fillable = [
        'kode_sik',
        'bagian',
        'keperluan',
        'no_kendaraan',
        'muatan',
        'divisi',
        'pemberi_izin',
        'pemberi_izin_ttd',
        'satpam',
        'satpam_ttd',
        'pengemudi',
        'pengemudi_ttd',
        'diizinkan',
        'date',
    ];
}
