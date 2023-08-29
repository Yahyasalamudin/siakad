<?php

namespace App\Http\Controllers;

use App\UserMenu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menu = UserMenu::get();

        return view('admin.menu.index', compact('menu'));
    }

}