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
        DB::table('users')->truncate();
        DB::table('users')->insert([
            'id' => 1,
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'Admin',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        DB::table('users')->insert([
            'name' => 'Pokja 1',
            'email' => 'pokja1@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'Pokja Kurikulum',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        DB::table('users')->insert([
            'name' => 'Pokja 2',
            'email' => 'pokja2@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'Pokja Sarpras',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        DB::table('users')->insert([
            'name' => 'Tri Mulyono',
            'email' => 'tri@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'BK',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        User::insert([
            'name' => 'Arif Hidayat M.Pd.',
            'email' => 'arif@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'Guru',
            'id_card' => '00001',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        User::insert([
            'name' => 'Ahmad Mardoko M.Pd.',
            'email' => 'ahmad@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'Guru',
            'id_card' => '00002',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        User::insert([
            'name' => "Drs. Agus Siswantono, M.Psi.",
            'email' => 'agussiswantono@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'Guru',
            'id_card' => '00003',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        User::insert([
            'name' => "Yayang Wahyu Pradana P, S.Pd.",
            'email' => 'yayangwahyu@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'Guru',
            'id_card' => '00004',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        User::insert([
            'name' => "Brama Jaya Kumbara, M.Pd.",
            'email' => 'bramajaya@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'Guru',
            'id_card' => '00005',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        User::insert([
            'name' => "Laily Fitriyani, S.Pd.",
            'email' => 'lailyfitriyani@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'Guru',
            'id_card' => '00006',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        User::insert([
            'name' => "Eka Mayasari, S.SI",
            'email' => 'ekamayasari@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'Guru',
            'id_card' => '00007',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        User::insert([
            'name' => "Hikmah Nuar Ilmiati, S.Pd.",
            'email' => 'hikmahnuar@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'Guru',
            'id_card' => '00008',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        User::insert([
            'name' => "Amarlian Bil Qisthi Agustin, S.Pd.",
            'email' => 'amarlianbil@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'Guru',
            'id_card' => '00009',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        User::insert([
            'name' => "Dyaning Dhamayanti, S.Kep.",
            'email' => 'dyaningdhamayanti@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'Guru',
            'id_card' => '00010',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        User::insert([
            'name' => "Santi Della Mahardika, S.Kep.",
            'email' => 'santidella@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'Guru',
            'id_card' => '00011',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        User::insert([
            'name' => "Febriana Risdianti Isman, S,Farm.",
            'email' => 'febrianarisdianti@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'Guru',
            'id_card' => '00012',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        User::insert([
            'name' => "Hermastuti Ayu Nur Santoso, S.Pd.",
            'email' => 'hermastutiayu@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'Guru',
            'id_card' => '00013',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        User::insert([
            'name' => "Sri Puji Astutik, S.Pd.",
            'email' => 'sripuji@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'Guru',
            'id_card' => '00014',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        User::insert([
            'name' => "Laili Yunita, S.PdI.",
            'email' => 'lailiyunita@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'Guru',
            'id_card' => '00015',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        User::insert([
            'name' => "Diyan Novianti, S.Pd.",
            'email' => 'diyannovianti@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'Guru',
            'id_card' => '00016',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        User::insert([
            'name' => "Clip Anggara Saputra, S.Pd.",
            'email' => 'clipanggara@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'Guru',
            'id_card' => '00017',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        User::insert([
            'name' => "Nailir Rokhmah, S.Pd.",
            'email' => 'nailirrokhmah@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'Guru',
            'id_card' => '00018',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        User::insert([
            'name' => "Astri Nur Aini, A.Md. A.K.",
            'email' => 'astrinur@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'Guru',
            'id_card' => '00019',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        User::insert([
            'name' => "M. Rahman Fiqi Satriya, S.Psi.",
            'email' => 'rahmanfiqi@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'Guru',
            'id_card' => '00020',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        User::insert([
            'name' => "Meirisa Isdiana Dewi, S.Kep.Ners.",
            'email' => 'meirisaisdiana@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'Guru',
            'id_card' => '00021',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        User::insert([
            'name' => "Dhara Ayu Prasetyorini, S.Kep.Ners.",
            'email' => 'dharaayu@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'Guru',
            'id_card' => '00022',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        User::insert([
            'name' => "Bagus Rahmadtullah, S.Kom.",
            'email' => 'bagusrahmadtullah@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'Guru',
            'id_card' => '00023',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        User::insert([
            'name' => "Helmi Banurisman, S.Pd.",
            'email' => 'helmibanurisman@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'Guru',
            'id_card' => '00024',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        User::insert([
            'name' => "Buni Fitria Sintawati, S.Kep.",
            'email' => 'bunifitria@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'Guru',
            'id_card' => '00025',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        User::insert([
            'name' => "Sofyan Adi Wiguna. A.Md. Kes",
            'email' => 'sofyanadi@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'Guru',
            'id_card' => '00026',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        User::insert([
            'name' => "Amarnia Rahmawati, A.Md. Kep.",
            'email' => 'amarniarahmawati@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'Guru',
            'id_card' => '00027',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        User::insert([
            'name' => "Nila Rukmi Kusuma Ningrum, S.Pd.",
            'email' => 'nilarukmi@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'Guru',
            'id_card' => '00028',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        User::insert([
            'name' => "Win Rizki Putra Gayo, S.Pd.",
            'email' => 'winrizki@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'Guru',
            'id_card' => '00029',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        User::insert([
            'name' => "Indah Wahyuni. S.Pd.I",
            'email' => 'indahwahyuni@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'Guru',
            'id_card' => '00030',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        User::insert([
            'name' => "Muhammad Thoriq Abdul Azis, S.Pd.I",
            'email' => 'muhammadthoriq@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'Guru',
            'id_card' => '00031',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        User::insert([
            'name' => "Imelda Famiasari Bintarti, S.Pd. Kons.",
            'email' => 'imeldafamiasari@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'Guru',
            'id_card' => '00032',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        User::insert([
            'name' => "Marwah Sofwatul Qulub, S.Pi.",
            'email' => 'marwahsofwatul@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'Guru',
            'id_card' => '00033',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        User::insert([
            'name' => "Winda Syafitri, S.Pd",
            'email' => 'windasyafitri@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'Guru',
            'id_card' => '00034',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        User::insert([
            'name' => "Teguh Triyanto, M.Pd.",
            'email' => 'teguhtriyanto@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'Guru',
            'id_card' => '00035',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        User::insert([
            'name' => "Amalina Tusholecha, S. Farm",
            'email' => 'amalinatusholecha@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'Guru',
            'id_card' => '00036',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        User::insert([
            'name' => "Asri Wahyu Firdaus",
            'email' => 'asriwahyu@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'Guru',
            'id_card' => '00037',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        User::insert([
            'name' => "Imas Bahrowi",
            'email' => 'imasbahrowi@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'Guru',
            'id_card' => '00038',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        User::insert([
            'name' => "Siti Fatmawati Rahayu",
            'email' => 'sitifatmawati@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'Guru',
            'id_card' => '00039',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        User::insert([
            'name' => "Busar",
            'email' => 'busar@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'Guru',
            'id_card' => '0004',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        User::insert([
            'name' => "Aan Januria Candra Wijaya",
            'email' => 'aanjanuria@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'Guru',
            'id_card' => '00041',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        User::insert([
            'name' => "Mochamad Ariyanto Addha",
            'email' => 'mochamadariyanto@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'Guru',
            'id_card' => '00042',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        User::insert([
            'name' => "Candra Ayu Agustin",
            'email' => 'candraayu@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'Guru',
            'id_card' => '00043',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        User::insert([
            'name' => "Qurrota Aini",
            'email' => 'qurrotaaini@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'Guru',
            'id_card' => '00044',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        User::insert([
            'name' => "Syarotul Aini, SH",
            'email' => 'syarotulaini@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'Guru',
            'id_card' => '00045',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        User::insert([
            'name' => "Dewi Khasanah",
            'email' => 'dewikhasanah@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'Guru',
            'id_card' => '00046',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        User::insert([
            'name' => "Trianto",
            'email' => 'trianto@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'Guru',
            'id_card' => '00047',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        User::insert([
            'name' => "Dien Okyaviandri Islamiati. S. Or",
            'email' => 'dienokyaviandri@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'Guru',
            'id_card' => '00048',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        User::insert([
            'name' => "Intan Rokhmatika Dwi Agustin, S.I.Kom",
            'email' => 'intanrokhmatika@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'Guru',
            'id_card' => '00049',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        User::insert([
            'name' => "Mohammad Riski Maulana",
            'email' => 'mohammadriski@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'Guru',
            'id_card' => '00050',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        User::insert([
            'name' => "Amil Nur Fatimah Purwoto, S. Farm",
            'email' => 'amilnur@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'Guru',
            'id_card' => '00051',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        User::insert([
            'name' => "Cindy Aprilia Novita, S.M.",
            'email' => 'cindyaprilia@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'Guru',
            'id_card' => '00052',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        User::insert([
            'name' => "Yulia Sofia, S.M.",
            'email' => 'yuliasofia@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'Guru',
            'id_card' => '00053',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        User::insert([
            'name' => 'Tri Hardiyanto M.Pd.',
            'email' => 'trihardiyanto@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'BK',
            'tingkatan_kelas' => '12',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        User::insert([
            'name' => 'Nikolas M.Pd.',
            'email' => 'nikolas@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'CS',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
    }
}