<?php

use App\UserMenu;
use Illuminate\Database\Seeder;

class UserMenuSeeder extends Seeder
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
                'title' => 'Dashboard',
                'icon' => 'fas fa-home',
                'menu_id' => null,
                'route' => null,
                'route_param' => null,
            ],
            [
                'title' => 'Dashboard',
                'icon' => 'fas fa-home',
                'menu_id' => '1',
                'route' => "home",
                'route_param' => null,
            ],
            [
                'title' => 'Dashboard Admin',
                'icon' => 'fas fa-home',
                'menu_id' => '1',
                'route' => "admin.home",
                'route_param' => null,
            ],
            [
                'title' => 'Administrator',
                'icon' => 'fas fa-edit',
                'menu_id' => null,
                'route' => null,
                'route_param' => null,
            ],
            [
                'title' => 'Konsentrasi Keahlian',
                'icon' => 'fas fa-book',
                'menu_id' => '4',
                'route' => "paket.index",
                'route_param' => null,
            ],
            [
                'title' => 'Data Mapel',
                'icon' => 'fas fa-book',
                'menu_id' => '4',
                'route' => "mapel.index",
                'route_param' => null,
            ],
            [
                'title' => 'Data Kelas',
                'icon' => 'fas fa-home',
                'menu_id' => '4',
                'route' => "kelas.index",
                'route_param' => null,
            ],
            [
                'title' => 'Data Siswa',
                'icon' => 'fas fa-users',
                'menu_id' => '4',
                'route' => "siswa.index",
                'route_param' => null,
            ],
            [
                'title' => 'Data Jadwal Pelajaran',
                'icon' => 'fas fa-calendar-alt',
                'menu_id' => '4',
                'route' => "jadwal.index",
                'route_param' => null,
            ],
            [
                'title' => 'Data Jadwal CS',
                'icon' => 'fas fa-calendar-alt',
                'menu_id' => '4',
                'route' => "jadwal.karyawan.index",
                'route_param' => 'cs',
            ],
            [
                'title' => 'Data Jadwal Satpam',
                'icon' => 'fas fa-calendar-alt',
                'menu_id' => '4',
                'route' => "jadwal.karyawan.index",
                'route_param' => 'satpam',
            ],
            [
                'title' => 'Data Guru',
                'icon' => 'fas fa-users',
                'menu_id' => '4',
                'route' => "guru.index",
                'route_param' => null,
            ],
            [
                'title' => 'Data User',
                'icon' => 'fas fa-user-plus',
                'menu_id' => '4',
                'route' => "user.index",
                'route_param' => null,
            ],
            [
                'title' => 'View Trash',
                'icon' => 'fas fa-recycle',
                'menu_id' => null,
                'route' => null,
                'route_param' => null,
            ],
            [
                'title' => 'Trash Jadwal',
                'icon' => 'fas fa-calendar-alt',
                'menu_id' => '14',
                'route' => "jadwal.trash",
                'route_param' => null,
            ],
            [
                'title' => 'Trash Guru',
                'icon' => 'fas fa-users',
                'menu_id' => '14',
                'route' => "guru.trash",
                'route_param' => null,
            ],
            [
                'title' => 'Trash Kelas',
                'icon' => 'fas fa-home',
                'menu_id' => '14',
                'route' => "kelas.trash",
                'route_param' => null,
            ],
            [
                'title' => 'Trash Siswa',
                'icon' => 'fas fa-users',
                'menu_id' => '14',
                'route' => "siswa.trash",
                'route_param' => null,
            ],
            [
                'title' => 'Trash Mapel',
                'icon' => 'fas fa-book',
                'menu_id' => '14',
                'route' => "mapel.trash",
                'route_param' => null,
            ],
            [
                'title' => 'Trash User',
                'icon' => 'fas fa-user',
                'menu_id' => '14',
                'route' => "user.trash",
                'route_param' => null,
            ],
            [
                'title' => 'Tukar Jadwal',
                'icon' => 'fas fa-clock',
                'menu_id' => null,
                'route' => null,
                'route_param' => null,
            ],
            [
                'title' => 'Request Tukar Jadwal',
                'icon' => 'fas fa-clock',
                'menu_id' => '21',
                'route' => "request.jadwal",
                'route_param' => null,
            ],
            [
                'title' => 'History Tukar Jadwal',
                'icon' => 'fas fa-history',
                'menu_id' => '21',
                'route' => "jadwal.history_tukar_jadwal",
                'route_param' => null,
            ],
            [
                'title' => 'Rekap Absensi',
                'icon' => 'fas fa-calendar-alt',
                'menu_id' => null,
                'route' => null,
                'route_param' => null,
            ],
            [
                'title' => 'Rekap Absensi Guru',
                'icon' => 'fas fa-chalkboard-teacher',
                'menu_id' => '24',
                'route' => "guru.absensi",
                'route_param' => null,
            ],
            [
                'title' => 'Rekap Absensi CS',
                'icon' => 'fas fa-broom',
                'menu_id' => '24',
                'route' => "karyawan.all",
                'route_param' => 'CS',
            ],
            [
                'title' => 'Rekap Absensi Satpam',
                'icon' => 'fas fa-user-shield',
                'menu_id' => '24',
                'route' => "karyawan.all",
                'route_param' => 'Satpam',
            ],
            [
                'title' => 'Penilaian Siswa',
                'icon' => 'fas fa-user',
                'menu_id' => null,
                'route' => "nilai.all",
                'route_param' => null,
            ],
            [
                'title' => 'Data Modul',
                'icon' => 'fas fa-file-alt',
                'menu_id' => null,
                'route' => "modul.all",
                'route_param' => null,
            ],
            [
                'title' => 'Pengumuman',
                'icon' => 'fas fa-clipboard',
                'menu_id' => null,
                'route' => "admin.pengumuman",
                'route_param' => null,
            ],
            [
                'title' => 'Data Menu User',
                'icon' => 'fas fa-user',
                'menu_id' => '4',
                'route' => "admin.menu",
                'route_param' => null,
            ],
            [
                'title' => 'Absensi Guru',
                'icon' => 'fas fa-calendar-check',
                'menu_id' => null,
                'route' => "guru.absensi",
                'route_param' => null,
            ],
        ];

        UserMenu::insert($data);
    }
}