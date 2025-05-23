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
        Schema::create('kondisi', function (Blueprint $table) {
            $table->id();
            $table->string('kondisi')->nullable();
            $table->json('type')->nullable();
            $table->timestamps();
        });
        Schema::create('group', function (Blueprint $table) {
            $table->id();
            $table->string('group')->nullable();
            $table->json('type')->nullable();
            $table->timestamps();
        });
        Schema::create('tujuan', function (Blueprint $table) {
            $table->id();
            $table->string('tujuan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kondisi');
    }
};
