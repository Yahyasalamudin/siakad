<?php

namespace App\Http\Controllers;

use App\Guru;
use App\Nilai;
use App\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NilaiController extends Controller
{
    public function index()
    {
        $guru = Guru::where('id_card', Auth::user()->id_card)->first();
        $nilai = Nilai::where('guru_id', $guru->id)->first();

        return view('guru.nilai.index', compact('nilai', 'guru'));
    }

    public function create()
    {
        $siswa = Siswa::orderBy('nama_siswa', 'asc')->get();

        return view('guru.nilai.create', compact('siswa'));
    }

    public function store(Request $request)
    {
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
            $nilai->siswa()->create([
                'nilai_id' => $nilai->id,
                'siswa_id' => $input['siswa_id'],
                'nilai' => $input['nilai'],
            ]);
        }

        return redirect()->back()->with('success', 'Data nilai berhasil dimasukkan');
    }

    public function show($id)
    {
        Nilai::find($id);

        return view('guru.nilai.show');
    }
}
