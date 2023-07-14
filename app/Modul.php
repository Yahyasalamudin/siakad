<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Modul extends Model
{
    protected $guarded = ['id'];

    public function mapel()
    {
        return $this->hasMany(Mapel::class, 'id', 'mapel_id');
    }

    public function guru()
    {
        return $this->hasMany(Guru::class, 'id');
    }
}