<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Modul extends Model
{
    protected $guarded = ['id'];

    public function mapel()
    {
        return $this->hasOne(Mapel::class, 'id', 'mapel_id');
    }

    public function guru()
    {
        // guru yang muncul di modul tidak sesuai??
        return $this->belongsTo(Guru::class, 'guru_id');
    }
}