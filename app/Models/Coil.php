<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coil extends Model
{
    use HasFactory;

    // Nama tabel jika tidak sesuai dengan konvensi penamaan Laravel
    protected $table = 'coil';

    // Kolom yang bisa diisi secara massal
    protected $fillable = [
        'kode_produk',
        'nama_produk',
        
        'berat_produk',
        'diameter_produk',
        'lebar_produk',
        
        'keterangan',
        'no_gs',
        'created_at',
        'updated_at'
    ];

    // Jika Anda ingin mengubah tipe data kolom tertentu atau membuat accessor/mutator
    // protected $casts = [
    //     'jumlah_produk' => 'integer',
    //     'berat_produk' => 'integer',
    //     'diameter_produk' => 'integer',
    //     'lebar_produk' => 'integer',
    //     // 'created_at' => 'datetime',
    //     // 'updated_at' => 'datetime',
    // ];

    // Contoh relasi
    // public function anotherModel()
    // {
    //     return $this->belongsTo(AnotherModel::class);
    // }
}
