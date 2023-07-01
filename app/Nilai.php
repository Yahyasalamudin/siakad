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

    protected $table = 'nilai';
}
