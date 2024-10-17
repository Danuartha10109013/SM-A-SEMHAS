<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MapCoil extends Model
{
    protected $table = 'mapcoil';
    protected $fillable = [
        'no_gs', 'a1', 'a2', 'a3', 'a4', 'a5',
        'b1', 'b2', 'b3', 'b4', 'b5',
        'c1', 'c2', 'c3', 'c4', 'c5',
         'a1_eye', 'a2_eye', 'a3_eye', 'a4_eye', 'a5_eye',
        'b1_eye', 'b2_eye', 'b3_eye', 'b4_eye', 'b5_eye',
        'c1_eye', 'c2_eye', 'c3_eye', 'c4_eye', 'c5_eye'
    ];

    // Pada Model P dan M
// public function isComplete()
// {
//     // Asumsikan $this->attribute adalah array atribut yang ingin dicek
//     foreach ($this->attributes as $attribute) {
//         if (is_null($attribute) || $attribute === '') {
//             return false;
//         }
//     }
//     return true;
// }

}
