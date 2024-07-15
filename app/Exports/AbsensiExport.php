<?php

namespace App\Exports;

use App\Absen;
use App\AbsenSiswa;
use App\Guru;
use Maatwebsite\Excel\Concerns\FromArray;

class AbsensiExport implements FromArray
{
    protected $id;
    protected $tanggal_awal;
    protected $tanggal_akhir;

    public function __construct($id, $tanggal_awal, $tanggal_akhir)
    {
        $this->id = $id;
        $this->tanggal_awal = $tanggal_awal;
        $this->tanggal_akhir = $tanggal_akhir;
    }
    
    public function array(): array
    {
        // $absensi = Absen::where('guru_id', $this->id)->where('foto_akhir', '!=', null)
        //     ->get();
        //     dd($absensi);

        // return [
        //     [1, 2, 3],
        //     [4, 5, 6]
        // ];

        $rows = [];
        $absensi = Absen::with('guru')->where('guru_id', $this->id)
            ->whereDate('created_at', '>=', $this->tanggal_awal)
            ->whereDate('created_at', '<=', $this->tanggal_akhir)
            ->get();

        foreach ($absensi as $absen) {
            $timeFromCreatedAt = $absen->created_at->format('Y-m-d H:i');

            if (!isset($rows[$timeFromCreatedAt])) {
                $rows[$timeFromCreatedAt] = [
                    'absensiDetails' => [],
                    'studentAbsen' => [],
                ];
            }   

            $absensiDetailData = [
                'tanggal' => 'Tanggal: ' . $absen->created_at,
                'ruang' => 'Ruang: ' . $absen->ruang,
                'materi' => 'Materi: ' . $absen->materi,
                'keterangan' => 'Keterangan: ' . $absen->keterangan,
                'nama_guru' => 'Nama Guru: ' . $absen->guru->nama_guru,
            ];

            $rows[$timeFromCreatedAt]['absensiDetails'] = $absensiDetailData;

            $students = AbsenSiswa::where('absen_id', $absen->id)
                ->join('siswa', 'absen_siswa.siswa_id', '=', 'siswa.id')
                ->orderBy('siswa.nama_siswa', 'ASC')
                ->get();
                
            foreach ($students as $student) {
                $studentDetailData = [
                    'nama_siswa' => $student->nama_siswa,
                    'nis' => $student->nis,
                    'jenis_absen' => $student->jenis_absen,
                ];
                $rows[$timeFromCreatedAt]['studentAbsen'][] = $studentDetailData;
            }
        }

        $data = [];
        foreach ($rows as $row) {
            $absensiDetails = $row['absensiDetails'];
            $studentAbsen = $row['studentAbsen'];

            // $data[] = "Tanggal : " . $timeFromCreatedAt;
            $data[] = $absensiDetails;
            $data[] = ['Nama Siswa', 'NIS'];
            $data[] = $studentAbsen;
            $data[] = [''];
        }

        // Now, $rows will contain the organized data
        return $data;
    }
}
