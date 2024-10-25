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
        Schema::create('hasil_list', function (Blueprint $table) {
            $table->id();
            $table->string('kode');
            $table->string('attribute')->unique();
            $table->string('nama_produk');
            $table->integer('qty');
            $table->string('uom');
            $table->string('storage_bin');
            $table->date('date');
            $table->string('user_id');
            $table->string('panjang');
            $table->string('kondisi');
            $table->string('tujuan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hasil_list');
    }
};
