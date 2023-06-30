<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AbsenSiswa extends Model
{
    protected $fillable = ['siswa_id', 'jenis_absen', 'jadwal_id'];

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
