<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengecekan extends Model
{
    use HasFactory;
    protected $table = 'pengecekan';

        protected $fillable = [
            'pembeda',
            'awal_muat',
            'awal_muat1',
            'kota_negara',
            'lantai',
            'dinding',
            'pengunci_kontainer',
            'sapu',
            'vacum',
            'disemprot',
            'choke',
            'stopper',
            'silica_gel',
            'sling',
            'fumigasi',
            'selesai_muat',
            'cuaca',
            'kondisi_ban',
            'kondisi_lantai',
            'rantai_webbing',
            'tonase',
            'terpal',
            'pegawai',
            'customer',
            'tare',
            'catatan',
            'tgl_gs',
            'no_mobil',
            'no_container',
            'tonase_tare',
        ];
    
    // Pada Model P dan M
public function isComplete()
{
    // Asumsikan $this->attribute adalah array atribut yang ingin dicek
    foreach ($this->attributes as $attribute) {
        if (is_null($attribute) || $attribute === '') {
            return false;
        }
    }
    return true;
}

}
