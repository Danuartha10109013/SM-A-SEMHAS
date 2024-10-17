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
        Schema::create('packing', function (Blueprint $table) {
            $table->id();
            $table->string('so');
            $table->string('attribute')->unique();
            $table->integer('b_label');
            $table->integer('b_aktual');
            $table->integer('selisih');
            $table->integer('persentase');
            $table->integer('stiker')->nullable();
            $table->integer('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('packing');
    }
};
