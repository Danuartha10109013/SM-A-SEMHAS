<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ForkliftM extends Model
{
    use HasFactory;

    // Specify the table name if it's not following the Laravel naming convention
    protected $table = 'forklift';

    // Specify the fields that are mass assignable (fillable)
    protected $fillable = [
        'user_id',
        'shift_leader',
        'jenis_forklift',
        'shift',
        'date',
        'awal',
        'horn',
        'mundur',
        'sein',
        'rotating',
        'stop',
        'utama',
        'connector',
        'accu',
        'parking',
        'brake',
        'akhir',
        'oil',
        'raulic',
        'chain',
        'allhose',
        'steering',
        'belts',
        'cooland',
        'transmisi',
        'ban',
        'fork',
        'teba',
        'catatan',
        'mtc',
        'ket_awal',
        'ket_horn',
        'ket_mundur',
        'ket_sein',
        'ket_rotating',
        'ket_stop',
        'ket_utama',
        'ket_connector',
        'ket_acuu',
        'ket_parking',
        'ket_brake',
        'ket_oil',
        'ket_raulic',
        'ket_chain',
        'ket_allhose',
        'ket_steering',
        'ket_belts',
        'ket_cooland',
        'ket_transmisi',
        'ket_ban',
        'ket_fork',
        'ket_teba',
    ];

    // Optionally, define relationships (e.g., if the checklist is associated with a user)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
