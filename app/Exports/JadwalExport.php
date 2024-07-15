<?php

namespace App\Exports;

use App\Jadwal;
use Maatwebsite\Excel\Concerns\FromCollection;

class JadwalExport implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $jadwal = Jadwal::join('hari', 'hari.id', '=', 'jadwal.hari_id')
            ->join('kelas', 'kelas.id', '=', 'jadwal.kelas_id')
            ->join('mapel', 'mapel.id', '=', 'jadwal.mapel_id')
            ->join('guru', 'guru.id', '=', 'jadwal.guru_id')
            ->select('hari.nama_hari', 'kelas.nama_kelas', 'mapel.nama_mapel', 'guru.nama_guru', 'jadwal.jam_mulai', 'jadwal.jam_selesai')
            ->get();
        return $jadwal;
    }
}