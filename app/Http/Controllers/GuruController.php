<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\Guru;
use App\Mapel;
use App\Jadwal;
use App\Absen;
use App\AbsenSiswa;
use App\Kehadiran;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Exports\GuruExport;
use App\Imports\GuruImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use App\Nilai;
use App\Siswa;
use Carbon\Carbon;

class GuruController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mapel = Mapel::orderBy('nama_mapel')->get();
        $max = Guru::max('id_card');
        return view('admin.guru.index', compact('mapel', 'max'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'id_card' => 'required',
            'nama_guru' => 'required',
            'mapel_id' => 'required',
            'kode' => 'required|string|unique:guru|min:2|max:3',
            'jk' => 'required'
        ]);

        if ($request->foto) {
            $foto = $request->foto;
            $new_foto = date('siHdmY') . "_" . $foto->getClientOriginalName();
            $foto->move('uploads/guru/', $new_foto);
            $nameFoto = 'uploads/guru/' . $new_foto;
        } else {
            if ($request->jk == 'L') {
                $nameFoto = 'uploads/guru/35251431012020_male.webp';
            } else {
                $nameFoto = 'uploads/guru/23171022042020_female.jpg';
            }
        }

        $guru = Guru::create([
            'id_card' => $request->id_card,
            'nip' => $request->nip,
            'nama_guru' => $request->nama_guru,
            'kode' => $request->kode,
            'jk' => $request->jk,
            'telp' => $request->telp,
            'tmp_lahir' => $request->tmp_lahir,
            'tgl_lahir' => $request->tgl_lahir,
            'foto' => $nameFoto
        ]);

        foreach ($request->mapel_id as $mapel_id) {
            $guru->mapel()->attach($guru->id, ['mapel_id' => $mapel_id]);
        }

        return redirect()->back()->with('success', 'Berhasil menambahkan data guru baru!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $id = Crypt::decrypt($id);
        $guru = Guru::findorfail($id);
        return view('admin.guru.details', compact('guru'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $id = Crypt::decrypt($id);
        $guru = Guru::findorfail($id);

        $mapel = Mapel::all();
        return view('admin.guru.edit', compact('guru', 'mapel'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nama_guru' => 'required',
            'mapel_id' => 'required',
            'jk' => 'required',
        ]);

        $guru = Guru::findorfail($id);
        $user = User::where('id_card', $guru->id_card)->first();
        if ($user) {
            $user_data = [
                'name' => $request->nama_guru
            ];
            $user->update($user_data);
        }
        $guru_data = [
            'nama_guru' => $request->nama_guru,
            'jk' => $request->jk,
            'telp' => $request->telp,
            'tmp_lahir' => $request->tmp_lahir,
            'tgl_lahir' => $request->tgl_lahir
        ];

        $guru->mapel()->detach();
        foreach ($request->mapel_id as $mapel_id) {
            $guru->mapel()->attach($guru->id, ['mapel_id' => $mapel_id]);
        }

        $guru->update($guru_data);

        return redirect()->route('guru.index')->with('success', 'Data guru berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $guru = Guru::findorfail($id);
        $countJadwal = Jadwal::where('guru_id', $guru->id)->count();
        if ($countJadwal >= 1) {
            $jadwal = Jadwal::where('guru_id', $guru->id)->delete();
        } else {
        }
        $countUser = User::where('id_card', $guru->id_card)->count();
        if ($countUser >= 1) {
            $user = User::where('id_card', $guru->id_card)->delete();
        }
        $guru->delete();
        return redirect()->route('guru.index')->with('warning', 'Data guru berhasil dihapus! (Silahkan cek trash data guru)');
    }

    public function trash()
    {
        $guru = Guru::onlyTrashed()->get();
        return view('admin.guru.trash', compact('guru'));
    }

    public function restore($id)
    {
        $id = Crypt::decrypt($id);
        $guru = Guru::withTrashed()->findorfail($id);
        $countJadwal = Jadwal::withTrashed()->where('guru_id', $guru->id)->count();
        if ($countJadwal >= 1) {
            $jadwal = Jadwal::withTrashed()->where('guru_id', $guru->id)->restore();
        } else {
        }
        $countUser = User::withTrashed()->where('id_card', $guru->id_card)->count();
        if ($countUser >= 1) {
            $user = User::withTrashed()->where('id_card', $guru->id_card)->restore();
        } else {
        }
        $guru->restore();
        return redirect()->back()->with('info', 'Data guru berhasil direstore! (Silahkan cek data guru)');
    }

    public function kill($id)
    {
        $guru = Guru::withTrashed()->findorfail($id);
        $countJadwal = Jadwal::withTrashed()->where('guru_id', $guru->id)->count();
        if ($countJadwal >= 1) {
            $jadwal = Jadwal::withTrashed()->where('guru_id', $guru->id)->forceDelete();
        } else {
        }
        $countUser = User::withTrashed()->where('id_card', $guru->id_card)->count();
        if ($countUser >= 1) {
            $user = User::withTrashed()->where('id_card', $guru->id_card)->forceDelete();
        } else {
        }
        $guru->forceDelete();
        return redirect()->back()->with('success', 'Data guru berhasil dihapus secara permanent');
    }

    public function ubah_foto($id)
    {
        $id = Crypt::decrypt($id);
        $guru = Guru::findorfail($id);
        return view('admin.guru.ubah-foto', compact('guru'));
    }

    public function update_foto(Request $request, $id)
    {
        $this->validate($request, [
            'foto' => 'required'
        ]);

        $guru = Guru::findorfail($id);
        $foto = $request->foto;
        $new_foto = date('s' . 'i' . 'H' . 'd' . 'm' . 'Y') . "_" . $foto->getClientOriginalName();
        $guru_data = [
            'foto' => 'uploads/guru/' . $new_foto,
        ];
        $foto->move('uploads/guru/', $new_foto);
        $guru->update($guru_data);

        return redirect()->route('guru.index')->with('success', 'Berhasil merubah foto!');
    }

    public function mapel($id)
    {
        $id = Crypt::decrypt($id);
        $mapel = Mapel::findorfail($id);
        $guru = Guru::whereHas('mapel', function ($query) use ($id) {
            $query->where('mapel_guru.mapel_id', $id);
        })->orderBy('kode', 'asc')->get();
        return view('admin.guru.show', compact('mapel', 'guru'));
    }

    public function absen(Request $request)
    {
        dd('test');
        $kelas_id = $request->kelas_id;
        $jadwal_id = $request->jadwal_id;

        $siswa = Siswa::where('kelas_id', $kelas_id)
            ->orderBy('nama_siswa', 'ASC')
            ->get();

        return view('guru.absen', compact('siswa', 'jadwal_id'));
    }

    public function absen_guru(Request $request, $id)
    {
        $id = decrypt($id);
        $absensi = Absen::where('guru_id', $id)->get();

        dd($absensi);

        return view('guru.absen_show', compact('absensi'));
    }

    public function absen_detail(Request $request, $id)
    {
        $kelas_id = Crypt::decrypt($request->kelas_id);
        $jadwal_id = Crypt::decrypt($request->jadwal_id);

        $siswa = AbsenSiswa::where('jadwal_id', $jadwal_id)
            ->join('siswa', 'absen_siswa.siswa_id', '=', 'siswa.id')
            ->orderBy('siswa.nama_siswa', 'ASC')
            ->get();

        $absensi = Absen::where('jadwal_id', $jadwal_id)->first();

        return view('guru.absensi_detail', compact('siswa', 'absensi'));
    }

    public function simpan(Request $request)
    {
        $this->validate($request, [
            'foto' => 'required',
            'ruang' => 'required',
        ]);

        if ($request->request_guru_tamu != null) {
            $this->validate($request, [
                'guru_tamu' => 'required',
                'agensi' => 'required',
            ]);
        }

        $user = auth()->user();

        if ($request->foto) {
            $foto = $request->foto;
            $new_foto = date('siHdmY') . "_" . $foto->getClientOriginalName();
            $foto->move('uploads/absensi/', $new_foto);
            $nameFoto = 'uploads/absensi/' . $new_foto;
        }

        Absen::create([
            'guru_id' => $user->guru($user->id_card)->id,
            'guru_tamu' => $request->guru_tamu,
            'agensi' => $request->agensi,
            'jadwal_id' => $request->jadwal_id,
            'ruang' => $request->ruang,
            'foto' => $nameFoto
        ]);

        foreach ($request->input as $input) {
            AbsenSiswa::insert([
                'siswa_id' => $input['siswa_id'],
                'jenis_absen' => isset($input['jenis_absen']) ? $input['jenis_absen'] : 'Hadir',
                'jadwal_id' => $request->jadwal_id,
                'ruang' => $request->ruang,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
        }

        return redirect('home')->with('success', 'Anda telah berhasil absen');
    }

    public function absensi()
    {
        $guru = Guru::all();
        return view('admin.guru.absen', compact('guru'));
    }

    public function kehadiran($id)
    {
        $id = Crypt::decrypt($id);
        $guru = Guru::findorfail($id);
        $absen = Absen::orderBy('tanggal', 'desc')->where('guru_id', $id)->get();
        return view('admin.guru.kehadiran', compact('guru', 'absen'));
    }

    public function export_excel()
    {
        return Excel::download(new GuruExport, 'guru.xlsx');
    }

    public function import_excel(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);
        $file = $request->file('file');
        $nama_file = rand() . $file->getClientOriginalName();
        $file->move('file_guru', $nama_file);
        Excel::import(new GuruImport, public_path('/file_guru/' . $nama_file));
        return redirect()->back()->with('success', 'Data Guru Berhasil Diimport!');
    }

    public function deleteAll()
    {
        $guru = Guru::all();
        if ($guru->count() >= 1) {
            Guru::whereNotNull('id')->delete();
            Guru::withTrashed()->whereNotNull('id')->forceDelete();
            return redirect()->back()->with('success', 'Data table guru berhasil dihapus!');
        } else {
            return redirect()->back()->with('warning', 'Data table guru kosong!');
        }
    }
}
