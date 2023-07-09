<?php

use App\Guru;
use App\Jadwal;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PaketSeeder::class);
        $this->call(KelasSeeder::class);
        $this->call(GuruSeeder::class);
        $this->call(UsersSeeder::class);
        $this->call(HariSeeder::class);
        $this->call(SiswaSeeder::class);
        $this->call(MapelSeeder::class);
        $this->call(RuangSeeder::class);

        $guru_mapel = [
            [
                'guru_id' => 1,
                'mapel_id' => 1,
            ],
            [
                'guru_id' => 1,
                'mapel_id' => 2,
            ],
            [
                'guru_id' => 2,
                'mapel_id' => 3,
            ],
        ];
        foreach ($guru_mapel as $data) {
            $guru = Guru::find($data['guru_id']);
            $guru->mapel()->attach($data['mapel_id']);
        }

        $jadwals = [
            [
                'hari_id' => 5,
                'kelas_id' => 2,
                'mapel_id' => 2,
                'guru_id' => 2,
                'jam_mulai' => '16:28:00',
                'jam_selesai' => '18:28:00',
            ],
            [
                'hari_id' => 5,
                'kelas_id' => 1,
                'mapel_id' => 2,
                'guru_id' => 2,
                'jam_mulai' => '19:28:00',
                'jam_selesai' => '21:28:00',
            ]
        ];
        Jadwal::insert($jadwals);
    }
}