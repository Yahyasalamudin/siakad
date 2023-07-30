<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JadwalKaryawan extends Model
{
    protected $guarded = ['id'];
    protected $with = ['hari'];

    public function hari()
    {
        return $this->belongsTo(Hari::class, 'hari_id', 'id');
    }

    public function absen_karyawan()
    {
        return $this->hasMany(AbsenKaryawan::class, 'jadwal_id', 'id');
    }
}