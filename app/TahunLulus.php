<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class TahunLulus extends Model
{
    protected $guarded = ['id'];

    protected $table = 'graduation_years';
}