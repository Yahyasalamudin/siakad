<?php

namespace App\Http\Controllers;

use App\Role;
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
        $role = Role::get();
        $menu_all = UserMenu::get();

        return view('admin.menu.index', compact('role', 'menu_all'));
    }

    public function update(Request $request, $role_id)
    {
        $role = Role::with('menu')->find($role_id);
        $role->menu()->toggle($request->menu_id);
        $role->refresh();

        return response()->json(['success' => 'Hak akses user berhasil diupdate.', 'data' => $role]);
    }
}