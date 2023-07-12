<?php

namespace App\Http\Controllers;

use App\AbsenSiswa;
use App\Guru;
use App\Kelas;
use App\Nilai;
use App\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class NilaiController extends Controller
{
    public function index()
    {
        $guru = Guru::where('id_card', Auth::user()->id_card)->first();
        $kelas = Kelas::all();
        // $nilai_siswa = Nilai::find(decrypt($id));
        $tahun = Nilai::select(DB::raw('YEAR(created_at) as tahun'))->groupBy(DB::raw('YEAR(created_at)'))->get();

        return view('guru.nilai.show', compact('guru', 'kelas', 'tahun'));

        // $guru = Guru::where('id_card', Auth::user()->id_card)->first();
        // $nilai = Nilai::where('guru_id', $guru->id)->get();

        // return view('guru.nilai.index', compact('nilai', 'guru'));
    }

    public function get_nilai_siswa(Request $request)
    {
        $nilai_siswa = Nilai::whereYear('created_at', $request->tahun)
            ->where('semester', $request->semester)
            ->where('tingkat_kelas', $request->tingkat_kelas)
            ->where('jenis_rombel', $request->jenis_rombel)
            ->where('mapel', $request->mapel)
            ->first();

        return json_encode($nilai_siswa);
    }

    public function get_siswa()
    {
        $siswa = Siswa::where('kelas_id', request('kelas_id'))->get();
        return json_encode($siswa);
    }

    public function create()
    {
        $guru = Guru::where('id_card', Auth::user()->id_card)->first();
        $kelas = Kelas::all();
        return view('guru.nilai.create', compact('guru', 'kelas'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'semester' => 'required',
            'tingkat_kelas' => 'required',
            'jenis_rombel' => 'required',
            'mapel' => 'required',
            'konten' => 'required',
            'tujuan_pembelajaran' => 'required',
            'materi' => 'required',
        ]);

        $user = auth()->user();

        $nilai = Nilai::create([
            'guru_id' => $user->guru($user->id_card)->id,
            'semester' => $request->semester,
            'tingkat_kelas' => $request->tingkat_kelas,
            'jenis_rombel' => $request->jenis_rombel,
            'mapel' => $request->mapel,
            'konten' => $request->konten,
            'tujuan_pembelajaran' => $request->tujuan_pembelajaran,
            'materi' => $request->materi,
        ]);

        foreach ($request->input as $input) {
            $nilai->siswa()->attach($input['siswa_id'], ['nilai' => $input['nilai']]);
        }

        Session::flash('success', 'Data nilai berhasil dimasukkan');
        return response()->json(['redirect_url' => route('nilai.index')]);
    }

    public function show($id)
    {
        $guru = Guru::where('id_card', Auth::user()->id_card)->first();
        $kelas = Kelas::all();
        $nilai_siswa = Nilai::find(decrypt($id));
        dd($nilai_siswa);

        return view('guru.nilai.show', compact('guru', 'nilai_siswa', 'kelas'));
    }
}