<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JadwalCS extends Model
{
    protected $guarded = ['id'];
    protected $table = 'jadwal_cs';

    public function hari()
    {
        return $this->belongsTo(Hari::class, 'hari_id', 'id');
    }
}