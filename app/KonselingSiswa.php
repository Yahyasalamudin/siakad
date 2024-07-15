<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KonselingSiswa extends Model
{
    protected $guarded = ['id'];
    protected $with = ['siswa', 'kelas'];

    public function siswa()
    {
        return $this->belongsTo('App\Siswa', 'siswa', 'id')->withDefault();
    }

    public function kelas()
    {
        return $this->belongsTo('App\Kelas', 'kelas', 'id')->withDefault();
    }
}