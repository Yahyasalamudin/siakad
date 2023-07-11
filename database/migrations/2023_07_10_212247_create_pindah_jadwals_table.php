<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePindahJadwalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pindah_jadwals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('jadwal_id');
            $table->integer('hari_id');
            $table->integer('kelas_id');
            $table->integer('mapel_id');
            $table->integer('guru_id');
            $table->time('jam_mulai');
            $table->time('jam_selesai');
            $table->integer('status_request')->default(0);
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
        Schema::dropIfExists('pindah_jadwals');
    }
}