<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateForkliftTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('forklift', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // Assuming this is a foreign key to users table
            $table->string('shift_leader');
            $table->string('jenis_forklift');
            $table->string('shift');
            $table->date('date');
            $table->string('awal');
            $table->string('horn');
            $table->string('mundur');
            $table->string('sein');
            $table->string('rotating');
            $table->string('stop');
            $table->string('utama');
            $table->string('connector');
            $table->string('accu');
            $table->string('parking');
            $table->string('brake');
            $table->string('akhir');
            $table->string('oil');
            $table->string('raulic');
            $table->string('chain');
            $table->string('allhose');
            $table->string('steering');
            $table->string('belts');
            $table->string('cooland');
            $table->string('transmisi');
            $table->string('ban');
            $table->string('fork');
            $table->string('teba');
            $table->text('catatan')->nullable(); // Nullable for optional fields
            $table->string('mtc')->nullable();

            // Optional fields (starting with 'ket_')
            $table->string('ket_awal')->nullable();
            $table->string('ket_horn')->nullable();
            $table->string('ket_mundur')->nullable();
            $table->string('ket_sein')->nullable();
            $table->string('ket_rotating')->nullable();
            $table->string('ket_stop')->nullable();
            $table->string('ket_utama')->nullable();
            $table->string('ket_connector')->nullable();
            $table->string('ket_acuu')->nullable();
            $table->string('ket_parking')->nullable();
            $table->string('ket_brake')->nullable();
            $table->string('ket_oil')->nullable();
            $table->string('ket_raulic')->nullable();
            $table->string('ket_chain')->nullable();
            $table->string('ket_allhose')->nullable();
            $table->string('ket_steering')->nullable();
            $table->string('ket_belts')->nullable();
            $table->string('ket_cooland')->nullable();
            $table->string('ket_transmisi')->nullable();
            $table->string('ket_ban')->nullable();
            $table->string('ket_fork')->nullable();
            $table->string('ket_teba')->nullable();

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
        Schema::dropIfExists('crane_checklists');
    }
}
