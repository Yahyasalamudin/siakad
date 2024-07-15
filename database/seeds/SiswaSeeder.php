<?php

use App\Siswa;
use Illuminate\Database\Seeder;

class SiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'no_induk' => 89102,
                'nis' => 21803192,
                'nama_siswa' => 'Hamzah',
                'jk' => 'L',
                'tmp_lahir' => 'Jember',
                'tgl_lahir' => '2005-06-20',
                'foto' => '',
                'kelas_id' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'no_induk' => 22933,
                'nis' => 8943284230,
                'nama_siswa' => 'Wildan',
                'jk' => 'L',
                'tmp_lahir' => 'Jember',
                'tgl_lahir' => '2005-06-20',
                'foto' => '',
                'kelas_id' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'no_induk' => 12323,
                'nis' => 312983210,
                'nama_siswa' => 'Rendy',
                'jk' => 'L',
                'tmp_lahir' => 'Jember',
                'tgl_lahir' => '2005-06-20',
                'foto' => '',
                'kelas_id' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'no_induk' => 82319,
                'nis' => 391203210,
                'nama_siswa' => 'Dwi Khusnul',
                'jk' => 'P',
                'tmp_lahir' => 'Jember',
                'tgl_lahir' => '2005-12-22',
                'foto' => '',
                'kelas_id' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'no_induk' => 91238,
                'nis' => 12321932,
                'nama_siswa' => 'Yahya',
                'jk' => 'L',
                'tmp_lahir' => 'Jember',
                'tgl_lahir' => '2005-06-20',
                'foto' => '',
                'kelas_id' => 2,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'no_induk' => 38210,
                'nis' => 3120983210,
                'nama_siswa' => 'Ripan',
                'jk' => 'L',
                'tmp_lahir' => 'Lumajang',
                'tgl_lahir' => '2005-06-20',
                'foto' => '',
                'kelas_id' => 2,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'no_induk' => 23123,
                'nis' => 983120831,
                'nama_siswa' => 'Wahyu',
                'jk' => 'L',
                'tmp_lahir' => 'Jember',
                'tgl_lahir' => '2005-06-20',
                'foto' => '',
                'kelas_id' => 2,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ];

        Siswa::insert($data);
    }
}