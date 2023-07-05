<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AktivitasTambahan extends Model
{
    protected $guarded = [];
    protected $table = 'aktivitas_tambahans';

    public function user()
    {
        return $this->belongsTo(User::class)->withDefault();
    }
}
