<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserMenu extends Model
{
    protected $guarded = ['id'];

    public function sub_menu()
    {
        return $this->hasMany(UserMenu::class, 'menu_id', 'id');
    }
}