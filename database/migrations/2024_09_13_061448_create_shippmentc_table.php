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
        Schema::create('shippmentc', function (Blueprint $table) {
            $table->id();
            $table->string('atribute')->unique();
            $table->string('unicode');
            $table->string('pod');
            $table->string('product');
            $table->string('size');
            $table->integer('gros');
            $table->integer('net');
            $table->string('satuan_berat');
            $table->string('type');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shippmenta');
    }
};
