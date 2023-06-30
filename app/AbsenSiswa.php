<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AbsenSiswa extends Model
{
    protected $guarded = [];

    public function siswa()
    {
        return $this->belongsTo('App\Siswa')->withDefault();
    }

    public function jadwal()
    {
        return $this->belongsTo('App\Jadwal')->withDefault();
    }

    protected $table = 'absen_siswa';
}
