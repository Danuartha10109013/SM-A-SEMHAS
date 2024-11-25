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
        Schema::create('rekap', function (Blueprint $table) {
            $table->id();
            $table->string('attribute')->unique();
            $table->string('no_so');
            $table->string('layout');
            $table->string('desc');
            $table->string('net');
            $table->string('gross');
            $table->string('length');
            $table->string('type');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rekap');
    }
};
