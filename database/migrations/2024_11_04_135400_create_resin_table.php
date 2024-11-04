<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResinTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resin', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('shift_leader');
            $table->date('date');
            $table->time('time');
            $table->json('supplier'); // Stores array as JSON
            $table->string('jenis')->nullable();
            
            $table->string('cuaca')->nullable();
            $table->string('keterangan')->nullable();
            $table->string('sesuai')->nullable();
            $table->string('kering')->nullable();
            $table->string('jumlahin')->nullable();
            $table->string('drum')->nullable();

            $table->string('keterangan1')->nullable();
            $table->string('keterangan3')->nullable();
            $table->string('keterangan5')->nullable();
            $table->string('keterangan6')->nullable();

            $table->timestamps();

            // Foreign key constraint if `user_id` is a reference to users table
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('resin');
    }
}
