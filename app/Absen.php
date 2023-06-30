<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Absen extends Model
{
    protected $guarded = [''];

    public function guru()
    {
        return $this->belongsTo('App\Guru')->withDefault();
    }

    public function kehadiran()
    {
        return $this->belongsTo('App\Kehadiran')->withDefault();
    }

    protected $table = 'absensi_guru';
}
