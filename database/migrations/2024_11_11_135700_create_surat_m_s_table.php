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
        Schema::create('surat', function (Blueprint $table) {
            $table->id();
            $table->string('kode_sik')->unique();
            $table->string('bagian');
            $table->string('keperluan');
            $table->string('no_kendaraan');
            $table->string('pemberi_izin');
            $table->string('pemberi_izin_ttd');
            $table->string('muatan')->nullable();
            $table->string('satpam')->nullable();
            $table->string('satpam_ttd')->nullable();
            $table->string('pengemudi')->nullable();
            $table->string('pengemudi_ttd')->nullable();
            $table->timestamp('diizinkan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surat');
    }
};
