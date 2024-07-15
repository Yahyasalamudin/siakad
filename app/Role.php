<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $guarded = ['id'];

    public function menu()
    {
        return $this->belongsToMany(UserMenu::class, 'role_menu_access', 'role_id', 'menu_id');
    }
}