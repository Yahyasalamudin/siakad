<?php

namespace App\Http\Controllers;

use App\AbsenSiswa;
use App\Guru;
use App\Kelas;
use App\Nilai;
use App\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class NilaiController extends Controller
{
    public function index()
    {
        $guru = Guru::where('id_card', Auth::user()->id_card)->first();
        $kelas = Kelas::all();
        $tahun = Nilai::select(DB::raw('YEAR(created_at) as tahun'))->groupBy(DB::raw('YEAR(created_at)'))->get();

        return view('guru.nilai.show', compact('guru', 'kelas', 'tahun'));
    }

    public function show()
    {
        $guru = Guru::all();
        $kelas = Kelas::all();
        $tahun = Nilai::select(DB::raw('YEAR(created_at) as tahun'))->groupBy(DB::raw('YEAR(created_at)'))->get();

        return view('admin.nilai.show', compact('guru', 'kelas', 'tahun'));
    }

    public function get_mapel_guru($id)
    {
        $guru = Guru::find($id);
        $mapel = $guru->mapel;

        return json_encode($mapel);
    }

    public function get_nilai_siswa(Request $request)
    {
        $nilai_siswa = Nilai::whereYear('created_at', $request->tahun)
            ->where('semester', $request->semester)
            ->where('tingkat_kelas', $request->tingkat_kelas)
            ->where('jenis_penilaian', $request->jenis_penilaian)
            ->where('jenis_rombel', $request->jenis_rombel)
            ->where('mapel', $request->mapel)
            ->get();

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

        if ($request->jenis_penilaian == 'submatif') {
            $validator = $this->validate($request, [
                'input.*.nilai' => 'required',
            ], ['input.*.nilai.required' => 'Data nilai harus dimasukkan']);

            // $validator = Validator::make($request->all(), [
            //     'input.*.nilai' => 'required',
            // ]);

            // if ($validator->fails()) {
            //     Session::flash('error', 'Data nilai harus dimasukkan');
            // }
        }

        // foreach ($request->input as $input) {
        //     if ($input['nilai'] == null) {

        //     }
        // }

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

        $nilai->update(['jenis_penilaian' => $request->jenis_penilaian]);

        Session::flash('success', 'Data nilai berhasil dimasukkan');
        return response()->json(['redirect_url' => route('nilai.index')]);
    }

    public function edit($id)
    {
        $guru = Guru::where('id_card', Auth::user()->id_card)->first();
        $kelas = Kelas::all();
        $nilai = Nilai::find($id);
        return view('guru.nilai.edit', compact('guru', 'kelas', 'nilai'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'konten' => 'required',
            'tujuan_pembelajaran' => 'required',
            'materi' => 'required',
        ]);

        $user = auth()->user();

        $nilai = Nilai::find($id);

        if ($nilai->jenis_penilaian == 'submatif') {
            $this->validate($request, [
                'input.*.nilai' => 'required',
            ], ['input.*.nilai.required' => 'Data nilai harus dimasukkan']);
        }

        $nilai->update([
            'konten' => $request->konten,
            'tujuan_pembelajaran' => $request->tujuan_pembelajaran,
            'materi' => $request->materi,
        ]);

        $nilai->siswa()->detach();
        foreach ($request->input as $input) {
            $nilai->siswa()->attach($input['siswa_id'], ['nilai' => $input['nilai']]);
        }

        Session::flash('success', 'Data nilai berhasil diupdate');
        return response()->json(['redirect_url' => route('nilai.edit', $id)]);
    }

    public function all()
    {
        dd('tes');
        $guru = Guru::where('id_card', Auth::user()->id_card)->first();
        $kelas = Kelas::all();
        $tahun = Nilai::select(DB::raw('YEAR(created_at) as tahun'))->groupBy(DB::raw('YEAR(created_at)'))->get();

        return view('guru.nilai.all', compact('guru', 'kelas', 'tahun'));
    }
}