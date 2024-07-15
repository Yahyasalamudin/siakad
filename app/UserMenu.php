<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserMenu extends Model
{
    protected $guarded = ['id'];

    public function role()
    {
        return $this->belongsToMany(Role::class, 'role_menu_access', 'menu_id', 'role_id');
    }

    public function sub_menu()
    {
        return $this->hasMany(UserMenu::class, 'menu_id', 'id');
    }
}