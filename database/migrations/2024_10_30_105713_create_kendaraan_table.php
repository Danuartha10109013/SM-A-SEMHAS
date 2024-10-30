<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('kendaraan', function (Blueprint $table) {
            $table->id();

            $table->string('no_urut');
            $table->string('nama_ekspedisi');
            $table->string('no_mobil');
            $table->string('no_kontainer');
            $table->string('tujuan');
            $table->string('nama_sopir');
            $table->string('helm');
            $table->string('celana_panjang');
            $table->string('baju_lengan_panjang');
            $table->string('sepatu');
            $table->string('sim');
            $table->string('masa_berlaku_sim');
            $table->string('stnk');
            $table->string('masa_berlaku_stnk');
            $table->string('kir');
            $table->string('masa_berlaku_kir');
            $table->string('surat_pengantar_ekspedisi');
            $table->string('segel');

            $table->string('ket_nama_ekspedisi');
            $table->string('ket_no_mobil');
            $table->string('ket_no_kontainer');
            $table->string('ket_tujuan');
            $table->string('ket_nama_sopir');
            $table->string('ket_helm');
            $table->string('ket_celana_panjang');
            $table->string('ket_baju_lengan_panjang');
            $table->string('ket_sepatu');
            $table->string('ket_sim');
            $table->date('ket_masa_berlaku_sim');
            $table->string('ket_stnk');
            $table->date('ket_masa_berlaku_stnk');
            $table->string('ket_kir');
            $table->date('ket_masa_berlaku_kir');
            $table->string('ket_surat_pengantar_ekspedisi');
            $table->string('ket_segel');
            $table->string('user_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kendaraan');
    }
};
