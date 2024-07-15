<?php

namespace App\Imports;

use App\Jadwal;
use App\Hari;
use App\Kelas;
use App\Mapel;
use App\Guru;
use App\Ruang;
use Maatwebsite\Excel\Concerns\ToModel;

class JadwalImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $hari = Hari::where('nama_hari', $row[0])->first();
        $kelas = Kelas::where('nama_kelas', $row[1])->first();
        $mapel = Mapel::where('nama_mapel', $row[2])->first();
        $guru = Guru::where('nama_guru', $row[3])->first();

        if (
            $hari != null &&
            $kelas != null &&
            $mapel != null &&
            $guru != null
        ) {
            if ($guru->mapel->contains($mapel->id)) {
                return new Jadwal([
                    'hari_id' => $hari->id,
                    'kelas_id' => $kelas->id,
                    'mapel_id' => $mapel->id,
                    'guru_id' => $guru->id,
                    'jam_mulai' => $row[4],
                    'jam_selesai' => $row[5],
                    'ruang' => $row[6],
                ]);
            }
        }
    }
}