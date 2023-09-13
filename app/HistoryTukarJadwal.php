<?php

namespace App;

use Carbon\Traits\Timestamp;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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
        return $this->belongsTo(Jadwal::class, 'jadwal_id', 'id')->withTrashed();
    }

    public function tukar_jadwal()
    {
        return $this->belongsTo(Jadwal::class, 'tukar_jadwal_id', 'id');
    }
}