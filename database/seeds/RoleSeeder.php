<?php

use App\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['role' => 'Admin'],
            ['role' => 'Tata Usaha'],
            ['role' => 'Waka Kurikulum'],
            ['role' => 'Waka Sarpras'],
            ['role' => 'Pokja Kurikulum'],
            ['role' => 'Pokja Sarpras'],
            ['role' => 'Kaprogli'],
            ['role' => 'Guru'],
            ['role' => 'BK'],
            ['role' => 'CS'],
            ['role' => 'Satpam'],
        ];

        Role::insert($data);
    }
}