<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GuruSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('guru')->insert([
            'id' => 1,
            'id_card' => '00001',
            'nip' => 123123,
            'nama_guru' => "Dedi Setyono M.Pd.",
            'mapel_id' => 1,
            'kode' => "BSD001",
            'jk' => "L",
            'telp' => "082123123123",
            'tmp_lahir' => "Jember",
            'tgl_lahir' => "1994-09-12",
            'foto' => "",
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        DB::table('guru')->insert([
            'id' => 2,
            'id_card' => '00002',
            'nip' => 123123,
            'nama_guru' => "Faruk Mardoko M.Pd.",
            'mapel_id' => 2,
            'kode' => "PWB001",
            'jk' => "L",
            'telp' => "082123123124",
            'tmp_lahir' => "Jember",
            'tgl_lahir' => "1994-09-12",
            'foto' => "",
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
    }
}
