<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoryTukarJadwalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('history_tukar_jadwals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('approval_user_id');
            $table->integer('jadwal_id');
            $table->integer('tukar_jadwal_id');
            $table->tinyInteger('status_permintaan');
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
        Schema::dropIfExists('history_tukar_jadwals');
    }
}