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
        Schema::create('packingl08', function (Blueprint $table) {
            $table->id();
            $table->string('attriibute')->unique();
            $table->string('kondisi');
            $table->string('group');
            $table->string('layout_kontainer');
            $table->string('no_sales');
            $table->string('user_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('packingl08');
    }
};
