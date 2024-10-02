<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTraillerTable extends Migration
{
    public function up()
    {
        Schema::create('trailler', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('shift_leader')->nullable();
            $table->string('mtc_name')->nullable();
            $table->string('jenis_forklift')->nullable();
            $table->date('date')->nullable();
            $table->string('carrier')->nullable();
            $table->string('ket_carrier')->nullable();
            $table->string('rantai')->nullable();
            $table->string('ket_rantai')->nullable();
            $table->string('ban')->nullable();
            $table->string('ket_ban')->nullable();
            $table->string('cadangan')->nullable();
            $table->string('ket_cadangan')->nullable();
            $table->string('sein')->nullable();
            $table->string('ket_sein')->nullable();
            $table->string('rotating')->nullable();
            $table->string('ket_rotating')->nullable();
            $table->string('stop')->nullable();
            $table->string('ket_stop')->nullable();
            $table->string('utama')->nullable();
            $table->string('ket_utama')->nullable();
            $table->string('kota')->nullable();
            $table->string('ket_kota')->nullable();
            $table->string('connector')->nullable();
            $table->string('ket_connector')->nullable();
            $table->string('accu')->nullable();
            $table->string('ket_accu')->nullable();
            $table->string('coolant')->nullable();
            $table->string('ket_coolant')->nullable();
            $table->string('parking')->nullable();
            $table->string('ket_parking')->nullable();
            $table->string('brake')->nullable();
            $table->string('ket_brake')->nullable();
            $table->string('horn')->nullable();
            $table->string('ket_horn')->nullable();
            $table->string('mundur')->nullable();
            $table->string('ket_mundur')->nullable();
            $table->string('clamp')->nullable();
            $table->string('ket_clamp')->nullable();
            $table->string('terpal')->nullable();
            $table->string('ket_terpal')->nullable();
            $table->string('ganjal')->nullable();
            $table->string('ket_ganjal')->nullable();
            $table->string('pallet')->nullable();
            $table->string('ket_pallet')->nullable();
            $table->string('apar')->nullable();
            $table->string('ket_apar')->nullable();
            $table->string('p3k')->nullable();
            $table->string('ket_p3k')->nullable();
            $table->string('fancing')->nullable();
            $table->string('ket_fancing')->nullable();
            $table->string('triangle')->nullable();
            $table->string('ket_triangle')->nullable();
            $table->string('tools')->nullable();
            $table->string('ket_tools')->nullable();
            $table->text('catatan')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('trailler');
    }
}

