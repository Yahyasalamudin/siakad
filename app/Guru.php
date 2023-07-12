<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Guru extends Model
{
    use SoftDeletes;

    protected $fillable = ['id_card', 'nip', 'nama_guru', 'mapel_id', 'kode', 'jk', 'telp', 'tmp_lahir', 'tgl_lahir', 'foto'];

    public function mapel()
    {
        return $this->belongsToMany(Mapel::class, 'mapel_guru', 'guru_id', 'mapel_id');
    }

    public function pindahJadwal()
    {
        return $this->hasMany(PindahJadwal::class, 'guru_id', 'id');
    }

    protected $table = 'guru';
}
