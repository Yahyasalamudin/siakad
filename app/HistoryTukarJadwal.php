<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HistoryTukarJadwal extends Model
{
    protected $guarded = ['id'];
    protected $with = ['jadwal', 'tukar_jadwal'];

    public function user()
    {
        return $this->belongsTo(User::class, 'approval_user_id', 'id');
    }

    public function jadwal()
    {
        return $this->belongsTo(Jadwal::class, 'jadwal_id', 'id');
    }

    public function tukar_jadwal()
    {
        return $this->belongsTo(Jadwal::class, 'tukar_jadwal_id', 'id');
    }
}