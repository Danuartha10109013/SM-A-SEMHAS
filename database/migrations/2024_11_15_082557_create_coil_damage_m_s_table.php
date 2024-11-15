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
        Schema::create('coil_damage', function (Blueprint $table) {
            $table->id();
            $table->string('attribute')->unique();
            $table->string('user_id');
            $table->string('berat_coil');
            $table->string('jenis_handling');
            $table->string('foto');
            $table->string('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coil_damage');
    }
};
