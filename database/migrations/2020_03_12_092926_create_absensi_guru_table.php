<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAbsensiGuruTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('absensi_guru', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('guru_id');
            $table->string('guru_tamu')->nullable();
            $table->string('agensi')->nullable();
            $table->integer('jadwal_id');
            $table->string('ruang');
            $table->text('materi');
            $table->enum('keterangan', ['terlambat', 'tepat_waktu']);
            $table->string('foto_awal');
            $table->string('foto_akhir')->nullable();
            $table->enum('status', ['dikonfirmasi', 'ditolak', 'proses'])->default('proses');
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
        Schema::dropIfExists('absensi_guru');
    }
}