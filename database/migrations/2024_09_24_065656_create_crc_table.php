<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('crc', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('user_id'); // assuming user relation
        $table->string('shift_leader');
        $table->date('date');
        $table->json('supplier')->nullable(); // for the supplier array
        $table->string('other_supplier')->nullable();
        $table->text('ket_awal')->nullable();
        $table->string('cuaca')->nullable(); // this might be an enum in a more structured scenario
        $table->json('foto')->nullable(); // array of photos
        $table->text('keterangan')->nullable();
        $table->boolean('sesuai')->nullable();
        $table->json('foto1')->nullable();
        $table->text('keterangan1')->nullable();
        $table->boolean('baik')->nullable();
        $table->json('foto2')->nullable();
        $table->text('keterangan2')->nullable();
        $table->boolean('kering')->nullable();
        $table->json('foto3')->nullable();
        $table->text('keterangan3')->nullable();
        $table->boolean('kencang')->nullable();
        $table->json('foto4')->nullable();
        $table->text('keterangan4')->nullable();
        $table->boolean('jumlahin')->nullable();
        $table->json('foto5')->nullable();
        $table->text('keterangan5')->nullable();
        $table->boolean('alas')->nullable();
        $table->json('foto6')->nullable();
        $table->text('keterangan6')->nullable();
        $table->boolean('wall')->nullable();
        $table->json('foto7')->nullable();
        $table->text('keterangan7')->nullable();
        $table->string('perganjalan')->nullable();

        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('crc');
    }
};
