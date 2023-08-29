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
            'id_card' => '00001',
            'nip' => 123123,
            'nama_guru' => "Arif Hidayat M.Pd.",
            'tmk' => "2023-07-12",
            'jk' => "L",
            'telp' => "082123123123",
            'tmp_lahir' => "Jember",
            'tgl_lahir' => "1994-09-12",
            'foto' => "uploads/guru/35251431012020_male.webp",
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        DB::table('guru')->insert([
            'id_card' => '00002',
            'nip' => 123123,
            'nama_guru' => "Ahmad Mardoko M.Pd.",
            'tmk' => "2023-07-12",
            'jk' => "L",
            'telp' => "082123123124",
            'tmp_lahir' => "Jember",
            'tgl_lahir' => "1994-09-12",
            'foto' => "uploads/guru/35251431012020_male.webp",
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        DB::table('guru')->insert([
            'id_card' => '00003',
            'nip' => 123123,
            'nama_guru' => "Drs. Agus Siswantono, M.Psi.",
            'tmk' => "2023-07-12",
            'jk' => "L",
            'telp' => "082123123124",
            'tmp_lahir' => "Jember",
            'tgl_lahir' => "1994-09-12",
            'foto' => "uploads/guru/35251431012020_male.webp",
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('guru')->insert([
            'id_card' => '00004',
            'nip' => 123123,
            'nama_guru' => "Yayang Wahyu Pradana P, S.Pd.",
            'tmk' => "2023-07-12",
            'jk' => "L",
            'telp' => "082123123124",
            'tmp_lahir' => "Jember",
            'tgl_lahir' => "1994-09-12",
            'foto' => "uploads/guru/35251431012020_male.webp",
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('guru')->insert([
            'id_card' => '00005',
            'nip' => 123123,
            'nama_guru' => "Brama Jaya Kumbara, M.Pd.",
            'tmk' => "2023-07-12",
            'jk' => "L",
            'telp' => "082123123124",
            'tmp_lahir' => "Jember",
            'tgl_lahir' => "1994-09-12",
            'foto' => "uploads/guru/35251431012020_male.webp",
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('guru')->insert([
            'id_card' => '00006',
            'nip' => 123123,
            'nama_guru' => "Laily Fitriyani, S.Pd.",
            'tmk' => "2023-07-12",
            'jk' => "L",
            'telp' => "082123123124",
            'tmp_lahir' => "Jember",
            'tgl_lahir' => "1994-09-12",
            'foto' => "uploads/guru/35251431012020_male.webp",
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('guru')->insert([
            'id_card' => '00007',
            'nip' => 123123,
            'nama_guru' => "Eka Mayasari, S.SI",
            'tmk' => "2023-07-12",
            'jk' => "L",
            'telp' => "082123123124",
            'tmp_lahir' => "Jember",
            'tgl_lahir' => "1994-09-12",
            'foto' => "uploads/guru/35251431012020_male.webp",
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('guru')->insert([
            'id_card' => '00008',
            'nip' => 123123,
            'nama_guru' => "Hikmah Nuar Ilmiati, S.Pd.",
            'tmk' => "2023-07-12",
            'jk' => "L",
            'telp' => "082123123124",
            'tmp_lahir' => "Jember",
            'tgl_lahir' => "1994-09-12",
            'foto' => "uploads/guru/35251431012020_male.webp",
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('guru')->insert([
            'id_card' => '00009',
            'nip' => 123123,
            'nama_guru' => "Amarlian Bil Qisthi Agustin, S.Pd.",
            'tmk' => "2023-07-12",
            'jk' => "L",
            'telp' => "082123123124",
            'tmp_lahir' => "Jember",
            'tgl_lahir' => "1994-09-12",
            'foto' => "uploads/guru/35251431012020_male.webp",
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('guru')->insert([
            'id_card' => '00010',
            'nip' => 123123,
            'nama_guru' => "Dyaning Dhamayanti, S.Kep.",
            'tmk' => "2023-07-12",
            'jk' => "L",
            'telp' => "082123123124",
            'tmp_lahir' => "Jember",
            'tgl_lahir' => "1994-09-12",
            'foto' => "uploads/guru/35251431012020_male.webp",
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('guru')->insert([
            'id_card' => '00011',
            'nip' => 123123,
            'nama_guru' => "Santi Della Mahardika, S.Kep.",
            'tmk' => "2023-07-12",
            'jk' => "L",
            'telp' => "082123123124",
            'tmp_lahir' => "Jember",
            'tgl_lahir' => "1994-09-12",
            'foto' => "uploads/guru/35251431012020_male.webp",
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('guru')->insert([
            'id_card' => '00012',
            'nip' => 123123,
            'nama_guru' => "Febriana Risdianti Isman, S,Farm.",
            'tmk' => "2023-07-12",
            'jk' => "L",
            'telp' => "082123123124",
            'tmp_lahir' => "Jember",
            'tgl_lahir' => "1994-09-12",
            'foto' => "uploads/guru/35251431012020_male.webp",
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('guru')->insert([
            'id_card' => '00013',
            'nip' => 123123,
            'nama_guru' => "Hermastuti Ayu Nur Santoso, S.Pd.",
            'tmk' => "2023-07-12",
            'jk' => "L",
            'telp' => "082123123124",
            'tmp_lahir' => "Jember",
            'tgl_lahir' => "1994-09-12",
            'foto' => "uploads/guru/35251431012020_male.webp",
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('guru')->insert([
            'id_card' => '00014',
            'nip' => 123123,
            'nama_guru' => "Sri Puji Astutik, S.Pd.",
            'tmk' => "2023-07-12",
            'jk' => "L",
            'telp' => "082123123124",
            'tmp_lahir' => "Jember",
            'tgl_lahir' => "1994-09-12",
            'foto' => "uploads/guru/35251431012020_male.webp",
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('guru')->insert([
            'id_card' => '00015',
            'nip' => 123123,
            'nama_guru' => "Laili Yunita, S.PdI.",
            'tmk' => "2023-07-12",
            'jk' => "L",
            'telp' => "082123123124",
            'tmp_lahir' => "Jember",
            'tgl_lahir' => "1994-09-12",
            'foto' => "uploads/guru/35251431012020_male.webp",
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('guru')->insert([
            'id_card' => '00016',
            'nip' => 123123,
            'nama_guru' => "Diyan Novianti, S.Pd.",
            'tmk' => "2023-07-12",
            'jk' => "L",
            'telp' => "082123123124",
            'tmp_lahir' => "Jember",
            'tgl_lahir' => "1994-09-12",
            'foto' => "uploads/guru/35251431012020_male.webp",
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('guru')->insert([
            'id_card' => '00017',
            'nip' => 123123,
            'nama_guru' => "Clip Anggara Saputra, S.Pd.",
            'tmk' => "2023-07-12",
            'jk' => "L",
            'telp' => "082123123124",
            'tmp_lahir' => "Jember",
            'tgl_lahir' => "1994-09-12",
            'foto' => "uploads/guru/35251431012020_male.webp",
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('guru')->insert([
            'id_card' => '00018',
            'nip' => 123123,
            'nama_guru' => "Nailir Rokhmah, S.Pd.",
            'tmk' => "2023-07-12",
            'jk' => "L",
            'telp' => "082123123124",
            'tmp_lahir' => "Jember",
            'tgl_lahir' => "1994-09-12",
            'foto' => "uploads/guru/35251431012020_male.webp",
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('guru')->insert([
            'id_card' => '00019',
            'nip' => 123123,
            'nama_guru' => "Astri Nur Aini, A.Md. A.K.",
            'tmk' => "2023-07-12",
            'jk' => "L",
            'telp' => "082123123124",
            'tmp_lahir' => "Jember",
            'tgl_lahir' => "1994-09-12",
            'foto' => "uploads/guru/35251431012020_male.webp",
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('guru')->insert([
            'id_card' => '00020',
            'nip' => 123123,
            'nama_guru' => "M. Rahman Fiqi Satriya, S.Psi.",
            'tmk' => "2023-07-12",
            'jk' => "L",
            'telp' => "082123123124",
            'tmp_lahir' => "Jember",
            'tgl_lahir' => "1994-09-12",
            'foto' => "uploads/guru/35251431012020_male.webp",
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('guru')->insert([
            'id_card' => '00021',
            'nip' => 123123,
            'nama_guru' => "Meirisa Isdiana Dewi, S.Kep.Ners.",
            'tmk' => "2023-07-12",
            'jk' => "L",
            'telp' => "082123123124",
            'tmp_lahir' => "Jember",
            'tgl_lahir' => "1994-09-12",
            'foto' => "uploads/guru/35251431012020_male.webp",
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('guru')->insert([
            'id_card' => '00022',
            'nip' => 123123,
            'nama_guru' => "Dhara Ayu Prasetyorini, S.Kep.Ners.",
            'tmk' => "2023-07-12",
            'jk' => "L",
            'telp' => "082123123124",
            'tmp_lahir' => "Jember",
            'tgl_lahir' => "1994-09-12",
            'foto' => "uploads/guru/35251431012020_male.webp",
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('guru')->insert([
            'id_card' => '00023',
            'nip' => 123123,
            'nama_guru' => "Bagus Rahmadtullah, S.Kom.",
            'tmk' => "2023-07-12",
            'jk' => "L",
            'telp' => "082123123124",
            'tmp_lahir' => "Jember",
            'tgl_lahir' => "1994-09-12",
            'foto' => "uploads/guru/35251431012020_male.webp",
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('guru')->insert([
            'id_card' => '00024',
            'nip' => 123123,
            'nama_guru' => "Helmi Banurisman, S.Pd.",
            'tmk' => "2023-07-12",
            'jk' => "L",
            'telp' => "082123123124",
            'tmp_lahir' => "Jember",
            'tgl_lahir' => "1994-09-12",
            'foto' => "uploads/guru/35251431012020_male.webp",
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('guru')->insert([
            'id_card' => '00025',
            'nip' => 123123,
            'nama_guru' => "Buni Fitria Sintawati, S.Kep.",
            'tmk' => "2023-07-12",
            'jk' => "L",
            'telp' => "082123123124",
            'tmp_lahir' => "Jember",
            'tgl_lahir' => "1994-09-12",
            'foto' => "uploads/guru/35251431012020_male.webp",
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('guru')->insert([
            'id_card' => '00026',
            'nip' => 123123,
            'nama_guru' => "Sofyan Adi Wiguna. A.Md. Kes",
            'tmk' => "2023-07-12",
            'jk' => "L",
            'telp' => "082123123124",
            'tmp_lahir' => "Jember",
            'tgl_lahir' => "1994-09-12",
            'foto' => "uploads/guru/35251431012020_male.webp",
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('guru')->insert([
            'id_card' => '00027',
            'nip' => 123123,
            'nama_guru' => "Amarnia Rahmawati, A.Md. Kep.",
            'tmk' => "2023-07-12",
            'jk' => "L",
            'telp' => "082123123124",
            'tmp_lahir' => "Jember",
            'tgl_lahir' => "1994-09-12",
            'foto' => "uploads/guru/35251431012020_male.webp",
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('guru')->insert([
            'id_card' => '00028',
            'nip' => 123123,
            'nama_guru' => "Nila Rukmi Kusuma Ningrum, S.Pd.",
            'tmk' => "2023-07-12",
            'jk' => "L",
            'telp' => "082123123124",
            'tmp_lahir' => "Jember",
            'tgl_lahir' => "1994-09-12",
            'foto' => "uploads/guru/35251431012020_male.webp",
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('guru')->insert([
            'id_card' => '00029',
            'nip' => 123123,
            'nama_guru' => "Win Rizki Putra Gayo, S.Pd.",
            'tmk' => "2023-07-12",
            'jk' => "L",
            'telp' => "082123123124",
            'tmp_lahir' => "Jember",
            'tgl_lahir' => "1994-09-12",
            'foto' => "uploads/guru/35251431012020_male.webp",
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('guru')->insert([
            'id_card' => '00030',
            'nip' => 123123,
            'nama_guru' => "Indah Wahyuni. S.Pd.I",
            'tmk' => "2023-07-12",
            'jk' => "L",
            'telp' => "082123123124",
            'tmp_lahir' => "Jember",
            'tgl_lahir' => "1994-09-12",
            'foto' => "uploads/guru/35251431012020_male.webp",
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('guru')->insert([
            'id_card' => '00031',
            'nip' => 123123,
            'nama_guru' => "Muhammad Thoriq Abdul Azis, S.Pd.I",
            'tmk' => "2023-07-12",
            'jk' => "L",
            'telp' => "082123123124",
            'tmp_lahir' => "Jember",
            'tgl_lahir' => "1994-09-12",
            'foto' => "uploads/guru/35251431012020_male.webp",
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('guru')->insert([
            'id_card' => '00032',
            'nip' => 123123,
            'nama_guru' => "Imelda Famiasari Bintarti, S.Pd. Kons.",
            'tmk' => "2023-07-12",
            'jk' => "L",
            'telp' => "082123123124",
            'tmp_lahir' => "Jember",
            'tgl_lahir' => "1994-09-12",
            'foto' => "uploads/guru/35251431012020_male.webp",
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('guru')->insert([
            'id_card' => '00033',
            'nip' => 123123,
            'nama_guru' => "Marwah Sofwatul Qulub, S.Pi.",
            'tmk' => "2023-07-12",
            'jk' => "L",
            'telp' => "082123123124",
            'tmp_lahir' => "Jember",
            'tgl_lahir' => "1994-09-12",
            'foto' => "uploads/guru/35251431012020_male.webp",
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('guru')->insert([
            'id_card' => '00034',
            'nip' => 123123,
            'nama_guru' => "Winda Syafitri, S.Pd",
            'tmk' => "2023-07-12",
            'jk' => "L",
            'telp' => "082123123124",
            'tmp_lahir' => "Jember",
            'tgl_lahir' => "1994-09-12",
            'foto' => "uploads/guru/35251431012020_male.webp",
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('guru')->insert([
            'id_card' => '00035',
            'nip' => 123123,
            'nama_guru' => "Teguh Triyanto, M.Pd.",
            'tmk' => "2023-07-12",
            'jk' => "L",
            'telp' => "082123123124",
            'tmp_lahir' => "Jember",
            'tgl_lahir' => "1994-09-12",
            'foto' => "uploads/guru/35251431012020_male.webp",
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('guru')->insert([
            'id_card' => '00036',
            'nip' => 123123,
            'nama_guru' => "Amalina Tusholecha, S. Farm",
            'tmk' => "2023-07-12",
            'jk' => "L",
            'telp' => "082123123124",
            'tmp_lahir' => "Jember",
            'tgl_lahir' => "1994-09-12",
            'foto' => "uploads/guru/35251431012020_male.webp",
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('guru')->insert([
            'id_card' => '00037',
            'nip' => 123123,
            'nama_guru' => "Asri Wahyu Firdaus",
            'tmk' => "2023-07-12",
            'jk' => "L",
            'telp' => "082123123124",
            'tmp_lahir' => "Jember",
            'tgl_lahir' => "1994-09-12",
            'foto' => "uploads/guru/35251431012020_male.webp",
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('guru')->insert([
            'id_card' => '00038',
            'nip' => 123123,
            'nama_guru' => "Imas Bahrowi",
            'tmk' => "2023-07-12",
            'jk' => "L",
            'telp' => "082123123124",
            'tmp_lahir' => "Jember",
            'tgl_lahir' => "1994-09-12",
            'foto' => "uploads/guru/35251431012020_male.webp",
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('guru')->insert([
            'id_card' => '00039',
            'nip' => 123123,
            'nama_guru' => "Siti Fatmawati Rahayu",
            'tmk' => "2023-07-12",
            'jk' => "L",
            'telp' => "082123123124",
            'tmp_lahir' => "Jember",
            'tgl_lahir' => "1994-09-12",
            'foto' => "uploads/guru/35251431012020_male.webp",
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('guru')->insert([
            'id_card' => '00040',
            'nip' => 123123,
            'nama_guru' => "Busar",
            'tmk' => "2023-07-12",
            'jk' => "L",
            'telp' => "082123123124",
            'tmp_lahir' => "Jember",
            'tgl_lahir' => "1994-09-12",
            'foto' => "uploads/guru/35251431012020_male.webp",
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('guru')->insert([
            'id_card' => '00041',
            'nip' => 123123,
            'nama_guru' => "Aan Januria Candra Wijaya",
            'tmk' => "2023-07-12",
            'jk' => "L",
            'telp' => "082123123124",
            'tmp_lahir' => "Jember",
            'tgl_lahir' => "1994-09-12",
            'foto' => "uploads/guru/35251431012020_male.webp",
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('guru')->insert([
            'id_card' => '00042',
            'nip' => 123123,
            'nama_guru' => "Mochamad Ariyanto Addha",
            'tmk' => "2023-07-12",
            'jk' => "L",
            'telp' => "082123123124",
            'tmp_lahir' => "Jember",
            'tgl_lahir' => "1994-09-12",
            'foto' => "uploads/guru/35251431012020_male.webp",
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('guru')->insert([
            'id_card' => '00043',
            'nip' => 123123,
            'nama_guru' => "Candra Ayu Agustin",
            'tmk' => "2023-07-12",
            'jk' => "L",
            'telp' => "082123123124",
            'tmp_lahir' => "Jember",
            'tgl_lahir' => "1994-09-12",
            'foto' => "uploads/guru/35251431012020_male.webp",
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('guru')->insert([
            'id_card' => '00044',
            'nip' => 123123,
            'nama_guru' => "Qurrota Aini",
            'tmk' => "2023-07-12",
            'jk' => "L",
            'telp' => "082123123124",
            'tmp_lahir' => "Jember",
            'tgl_lahir' => "1994-09-12",
            'foto' => "uploads/guru/35251431012020_male.webp",
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('guru')->insert([
            'id_card' => '00045',
            'nip' => 123123,
            'nama_guru' => "Syarotul Aini, SH",
            'tmk' => "2023-07-12",
            'jk' => "L",
            'telp' => "082123123124",
            'tmp_lahir' => "Jember",
            'tgl_lahir' => "1994-09-12",
            'foto' => "uploads/guru/35251431012020_male.webp",
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('guru')->insert([
            'id_card' => '00046',
            'nip' => 123123,
            'nama_guru' => "Dewi Khasanah",
            'tmk' => "2023-07-12",
            'jk' => "L",
            'telp' => "082123123124",
            'tmp_lahir' => "Jember",
            'tgl_lahir' => "1994-09-12",
            'foto' => "uploads/guru/35251431012020_male.webp",
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('guru')->insert([
            'id_card' => '00047',
            'nip' => 123123,
            'nama_guru' => "Trianto",
            'tmk' => "2023-07-12",
            'jk' => "L",
            'telp' => "082123123124",
            'tmp_lahir' => "Jember",
            'tgl_lahir' => "1994-09-12",
            'foto' => "uploads/guru/35251431012020_male.webp",
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('guru')->insert([
            'id_card' => '00048',
            'nip' => 123123,
            'nama_guru' => "Dien Okyaviandri Islamiati. S. Or",
            'tmk' => "2023-07-12",
            'jk' => "L",
            'telp' => "082123123124",
            'tmp_lahir' => "Jember",
            'tgl_lahir' => "1994-09-12",
            'foto' => "uploads/guru/35251431012020_male.webp",
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('guru')->insert([
            'id_card' => '00049',
            'nip' => 123123,
            'nama_guru' => "Intan Rokhmatika Dwi Agustin, S.I.Kom",
            'tmk' => "2023-07-12",
            'jk' => "L",
            'telp' => "082123123124",
            'tmp_lahir' => "Jember",
            'tgl_lahir' => "1994-09-12",
            'foto' => "uploads/guru/35251431012020_male.webp",
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('guru')->insert([
            'id_card' => '00050',
            'nip' => 123123,
            'nama_guru' => "Mohammad Riski Maulana",
            'tmk' => "2023-07-12",
            'jk' => "L",
            'telp' => "082123123124",
            'tmp_lahir' => "Jember",
            'tgl_lahir' => "1994-09-12",
            'foto' => "uploads/guru/35251431012020_male.webp",
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('guru')->insert([
            'id_card' => '00051',
            'nip' => 123123,
            'nama_guru' => "Amil Nur Fatimah Purwoto, S. Farm",
            'tmk' => "2023-07-12",
            'jk' => "L",
            'telp' => "082123123124",
            'tmp_lahir' => "Jember",
            'tgl_lahir' => "1994-09-12",
            'foto' => "uploads/guru/35251431012020_male.webp",
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('guru')->insert([
            'id_card' => '00052',
            'nip' => 123123,
            'nama_guru' => "Cindy Aprilia Novita, S.M.",
            'tmk' => "2023-07-12",
            'jk' => "L",
            'telp' => "082123123124",
            'tmp_lahir' => "Jember",
            'tgl_lahir' => "1994-09-12",
            'foto' => "uploads/guru/35251431012020_male.webp",
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('guru')->insert([
            'id_card' => '00053',
            'nip' => 123123,
            'nama_guru' => "Yulia Sofia, S.M.",
            'tmk' => "2023-07-12",
            'jk' => "L",
            'telp' => "082123123124",
            'tmp_lahir' => "Jember",
            'tgl_lahir' => "1994-09-12",
            'foto' => "uploads/guru/35251431012020_male.webp",
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
    }
}