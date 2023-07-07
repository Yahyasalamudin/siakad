<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    protected $guarded = [];
    protected $with = ['siswa', 'kelas'];

    public function guru()
    {
        return $this->belongsTo('App\Guru')->withDefault();
    }

    public function kelas()
    {
        return $this->belongsTo('App\Kelas', 'tingkat_kelas', 'id')->withDefault();
    }

    public function siswa()
    {
        return $this->belongsToMany(Siswa::class, 'nilai_siswa', 'nilai_id', 'siswa_id')
            ->withPivot('nilai');
    }


    protected $table = 'nilai';
}
