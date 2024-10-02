<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TraillerM extends Model
{
    use HasFactory;

    protected $table = 'trailler';

    protected $fillable = [
        'user_id',
        'shift_leader',
        'mtc_name',
        'jenis_forklift',
        'date',
        'carrier', 'ket_carrier',
        'rantai', 'ket_rantai',
        'ban', 'ket_ban',
        'cadangan', 'ket_cadangan',
        'sein', 'ket_sein',
        'rotating', 'ket_rotating',
        'stop', 'ket_stop',
        'utama', 'ket_utama',
        'kota', 'ket_kota',
        'connector', 'ket_connector',
        'accu', 'ket_accu',
        'coolant', 'ket_coolant',
        'parking', 'ket_parking',
        'brake', 'ket_brake',
        'horn', 'ket_horn',
        'mundur', 'ket_mundur',
        'clamp', 'ket_clamp',
        'terpal', 'ket_terpal',
        'rantai_pe', 'ket_rantai_pe',
        'ganjal', 'ket_ganjal',
        'pallet', 'ket_pallet',
        'apar', 'ket_apar',
        'p3k', 'ket_p3k',
        'fancing', 'ket_fancing',
        'triangle', 'ket_triangle',
        'tools', 'ket_tools',
        'catatan'
    ];
}
