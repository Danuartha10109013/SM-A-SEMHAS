<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResinImageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resin_image', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('resin_id');
            $table->json('foto')->nullable();
            $table->json('foto1')->nullable();
            $table->json('foto3')->nullable();
            $table->json('foto5')->nullable();
            $table->json('foto6')->nullable();
            
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('resin_id')->references('id')->on('resin')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('resin_image');
    }
}
