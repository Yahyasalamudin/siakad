<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNilaiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nilai', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('guru_id');
            $table->string('semester');
            $table->string('tingkat_kelas');
            $table->enum('jenis_rombel', ['reguler', 'mapel_pilihan']);
            $table->string('mapel');
            $table->string('konten');
            $table->string('tujuan_pembelajaran');
            $table->string('materi');
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
        Schema::dropIfExists('nilai');
    }
}
