<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Guru extends Model
{
    use SoftDeletes;

    protected $table = 'guru';
    protected $fillable = ['id_card', 'nip', 'nama_guru', 'mapel_id', 'kode', 'jk', 'telp', 'tmp_lahir', 'tgl_lahir', 'foto'];

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function mapel()
    {
        return $this->belongsTo('App\Mapel')->withDefault();
    }
}
