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
        Schema::create('packing_detail', function (Blueprint $table) {
            $table->id();
            $table->string('packing_id');
            $table->string('attribute');
            $table->string('b_label');
            $table->string('b_aktual');
            $table->string('selisih');
            $table->string('persentase');
            $table->string('stiker');
            $table->string('keterangan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('packing_detail');
    }
};
