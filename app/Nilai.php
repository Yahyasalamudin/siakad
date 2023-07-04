<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    protected $guarded = [];

    public function guru()
    {
        return $this->belongsTo('App\Guru')->withDefault();
    }

    public function siswa()
    {
        return $this->belongsToMany(Siswa::class, 'nilai_siswa', 'nilai_id', 'siswa_id')
            ->withPivot('nilai');
    }


    protected $table = 'nilai';
}
