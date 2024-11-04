<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KendaraanM extends Model
{
    use HasFactory;

    protected $table = 'kendaraan';
    protected $fillable = [
        'no_urut', 'nama_ekspedisi', 'no_mobil', 'no_kontainer', 'tujuan', 
        'nama_sopir', 'helm', 'celana_panjang', 'baju_lengan_panjang', 'sepatu', 
        'sim', 'masa_berlaku_sim', 'stnk', 'masa_berlaku_stnk', 'kir', 
        'masa_berlaku_kir', 'surat_pengantar_ekspedisi', 'segel', 
        'ket_nama_ekspedisi', 'ket_no_mobil', 'ket_no_kontainer', 'ket_tujuan', 
        'ket_nama_sopir', 'ket_helm', 'ket_celana_panjang', 'ket_baju_lengan_panjang', 
        'ket_sepatu', 'ket_sim', 'ket_masa_berlaku_sim', 'ket_stnk', 'ket_masa_berlaku_stnk', 
        'ket_kir', 'ket_masa_berlaku_kir', 'ket_surat_pengantar_ekspedisi', 
        'ket_segel', 'user_id','no_kontainer_foto','no_mobil_foto','jam','tanggal'
    ];
    
}
