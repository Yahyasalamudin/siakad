<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AbsenKaryawan extends Model
{
    protected $guarded = ['id'];
    protected $with = ['absen_karyawan', 'user'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function absen_karyawan()
    {
        return $this->belongsTo(JadwalKaryawan::class, 'jadwal_id', 'id');
    }
}