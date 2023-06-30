<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'id' => 1,
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'Admin',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        User::insert([
            'name' => 'Dedi Setyono M.Pd.',
            'email' => 'dedi@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'Guru',
            'id_card' => '00001',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        User::insert([
            'name' => 'Faruk Mardoko M.Pd.',
            'email' => 'farukh@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'Guru',
            'id_card' => '00002',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
    }
}
