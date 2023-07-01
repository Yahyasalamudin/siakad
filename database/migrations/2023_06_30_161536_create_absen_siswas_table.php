<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAbsenSiswasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('absen_siswa', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('siswa_id');
            $table->string('jenis_absen');
            $table->integer('jadwal_id');
            $table->string('ruang');
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
        Schema::dropIfExists('absen_siswa');
    }
}
