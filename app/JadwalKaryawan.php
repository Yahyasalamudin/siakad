<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JadwalKaryawan extends Model
{
    protected $guarded = ['id'];

    public function hari()
    {
        return $this->belongsTo(Hari::class, 'hari_id', 'id');
    }
}