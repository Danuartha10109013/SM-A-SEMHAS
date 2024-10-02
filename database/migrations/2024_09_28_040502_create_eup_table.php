<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEupTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eup', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');  // Foreign key to the users table
            $table->date('date');  // Date of the pallet check
            $table->string('jenis');  // Type of check
            $table->text('kaki_pallet')->nullable();  // Conditions of pallet legs (stored as | separated)
            $table->string('permukaan_pallet')->nullable();  // Surface condition of the pallet
            $table->string('ketebalan_pallet')->nullable();  // Thickness condition of the pallet
            $table->string('paku_pallet')->nullable();  // Nail condition on the pallet
            $table->string('keluar_pallet')->nullable();  // Nail protrusion condition
            $table->string('sesuai');  // Whether it meets warehouse standards
            $table->string('action');  // Actions taken (received, rejected, replaced, etc.)
            $table->text('foto7')->nullable();  // File paths for uploaded photos, stored as | separated
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('eup');
    }
}
