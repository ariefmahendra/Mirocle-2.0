<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sensor_data_final', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('id_terapi');
            $table->text('waktu_mulai')->nullable();
            $table->text('waktu_selesai')->nullable();
            $table->text('rata_rata_detak_jantung')->nullable();
            $table->text('rata_rata_saturasi_oksigen')->nullable();
            $table->text('kalori_total')->nullable();
            $table->text('putaran_pedal');
            $table->text('durasi')->nullable();
            $table->timestamp('timestamp')->default(DB::raw('CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sensor_data_final');
    }
};
