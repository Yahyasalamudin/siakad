<?php

use App\UserMenu;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuNaikKelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $result = UserMenu::insert([
            'title' => 'Naik Kelas',
            'icon' => 'fas fa-user',
            'menu_id' => null,
            'route' => "siswa.naik_kelas",
            'route_param' => null,
        ]);

        DB::table('role_menu_access')->insert(['role_id' => 5, 'menu_id' => $result->id]);
    }
}
