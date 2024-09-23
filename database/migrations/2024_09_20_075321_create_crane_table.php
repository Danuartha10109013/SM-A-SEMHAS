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
        Schema::create('crane', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('shift_leader');
            $table->string('jenis_crane');
            $table->date('date');
            $table->string('start');
            $table->string('ket_start')->nullable();
            $table->string('switch');
            $table->string('ket_switch')->nullable();
            $table->string('up');
            $table->string('ket_up')->nullable();
            $table->string('down');
            $table->string('ket_down')->nullable();
            $table->string('ctravel');
            $table->string('ket_ctravel')->nullable();
            $table->string('ltravel');
            $table->string('ket_ltravel')->nullable();
            $table->string('emergency');
            $table->string('ket_emergency')->nullable();
            $table->string('speed1');
            $table->string('ket_speed1')->nullable();
            $table->string('speed2');
            $table->string('ket_speed2')->nullable();
            $table->string('block');
            $table->string('ket_block')->nullable();
            $table->string('lockert');
            $table->string('ket_lockert')->nullable();
            $table->string('wire');
            $table->string('ket_wire')->nullable();
            $table->string('sltravel');
            $table->string('ket_sltravel')->nullable();
            $table->string('sirinelt');
            $table->string('ket_sirinelt')->nullable();
            $table->string('brakeno');
            $table->string('ket_brakeno')->nullable();
            $table->string('brakeya');
            $table->string('ket_brakeya')->nullable();
            $table->string('bcno');
            $table->string('ket_bcno')->nullable();
            $table->string('bcya');
            $table->string('ket_bcya')->nullable();
            $table->string('updno');
            $table->string('ket_updno')->nullable();
            $table->string('updya');
            $table->string('ket_updya')->nullable();
            $table->string('crcros');
            $table->string('ket_crcros')->nullable();
            $table->text('catatan')->nullable();
            $table->string('mtc');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('crane');
    }
};
