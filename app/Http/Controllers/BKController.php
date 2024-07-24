<?php

namespace App\Http\Controllers;

use App\Guru;
use App\Kelas;
use App\KonselingSiswa;
use App\Siswa;
use App\User;
use Illuminate\Http\Request;
use GuzzleHttp\Psr7\Request as HttpRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class BKController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        // 'date_start' => "17-05-2023",
        //         'date_end' => "31-05-2023",
        return view('bk.absensi_siswa');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'tgl_konseling' => 'required',
            'jenis_konseling' => 'required',
            'kelas' => 'required',
        ]);

        if ($request->jenis_konseling == 'pribadi') {
            $this->validate($request, [
                'siswa' => 'required',
            ]);
        }

        $user = auth()->user();

        $nameFoto = null;
        if ($request->foto) {
            $foto = $request->foto;
            $new_foto = date('siHdmY') . "_" . $foto->getClientOriginalName();
            $foto->move(public_path('uploads/bk/'), $new_foto);
            $nameFoto = 'uploads/bk/' . $new_foto;
        }

        $konseling = KonselingSiswa::create([
            'tgl_konseling' => $request->tgl_konseling,
            'jenis_konseling' => $request->jenis_konseling,
            'kelas' => $request->kelas,
            'siswa' => $request->siswa,
            'foto_kegiatan' => $nameFoto,
        ]);

        Session::flash('success', 'Data nilai berhasil dimasukkan');
        return response()->json(['redirect_url' => route('bk.konseling')]);
    }

    public function create()
    {
        $kelas = Kelas::all();
        return view('bk.konseling_siswa', compact('kelas'));
    }

    public function get_kelas()
    {
        $client = new \GuzzleHttp\Client();
        $response = $client->get('http://localhost/absensi_mulu/api/kelas');

        $jsonResponse = json_decode($response->getBody(), true);
        $data = $jsonResponse['data'];

        return json_encode($data);
    }

    public function get_siswa_from_api()
    {
        $client = new \GuzzleHttp\Client();
        $response = $client->get('http://localhost/absensi_mulu/api/siswa', [
            'query' => [
                'id_kelas' => request('id_kelas'),
            ]
        ]);

        $jsonResponse = json_decode($response->getBody(), true);
        $data = $jsonResponse['data'];

        return json_encode($data);
    }

    public function get_siswa(Request $request)
    {
        $client = new \GuzzleHttp\Client();
        $data = Siswa::where('kelas_id', $request->kelas_id)->get();

        return json_encode($data);
    }

    public function get_absensi_siswa()
    {
        $client = new \GuzzleHttp\Client();
        $response = $client->get('http://localhost/absensi_mulu/api/absensi', [
            'query' => [
                'pilih_kelas' => request('pilih_kelas'),
                'pilih_siswa' => request('pilih_siswa'),
                'date_start' => "17-05-2023",
                'date_end' => "31-05-2023",
            ]
        ]);

        $jsonResponse = json_decode($response->getBody(), true);
        $siswa = $jsonResponse['data'];

        return json_encode($siswa);
    }

    public function get_konseling_siswa()
    {
        $konseling = KonselingSiswa::all();
        return json_encode($konseling);
    }

    public function edit_tingkatan_kelas(Request $request, $id)
    {
        User::find($id)->update([
            'tingkatan_kelas' => $request->tingkatan_kelas,
        ]);

        return redirect()->back()->with('success', 'Berhasil mengedit tingkatan kelas');
    }
}