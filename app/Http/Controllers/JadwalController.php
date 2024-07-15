<?php

namespace App\Http\Controllers;

use App\HistoryTukarJadwal;
use App\Jadwal;
use App\Hari;
use App\Kelas;
use App\Guru;
use App\PindahJadwal;
use App\Siswa;
use App\Ruang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;
use App\Exports\JadwalExport;
use App\Imports\JadwalImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\PDF;
use Illuminate\Support\Facades\Auth;

class JadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hari = Hari::all();
        $kelas = Kelas::OrderBy('nama_kelas', 'asc')->get();
        $guru = Guru::OrderBy('nama_guru', 'asc')->get();
        return view('admin.jadwal.index', compact('hari', 'kelas', 'guru'));
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
            'hari_id' => 'required',
            'kelas_id' => 'required',
            'kode_jadwal' => 'required',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
        ]);

        $kode_jadwal = explode('-', $request->kode_jadwal);
        Jadwal::create(
            [
                'hari_id' => $request->hari_id,
                'kelas_id' => $request->kelas_id,
                'mapel_id' => $kode_jadwal[1],
                'guru_id' => $kode_jadwal[0],
                'jam_mulai' => $request->jam_mulai,
                'jam_selesai' => $request->jam_selesai,
            ]
        );

        return redirect()->back()->with('success', 'Data jadwal berhasil diperbarui!');
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
        $kelas = Kelas::findorfail($id);
        $jadwal = Jadwal::OrderBy('hari_id', 'asc')->OrderBy('jam_mulai', 'asc')->where('kelas_id', $id)->get();
        return view('admin.jadwal.show', compact('jadwal', 'kelas'));
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
        $jadwal = Jadwal::findorfail($id);
        $hari = Hari::all();
        $kelas = Kelas::all();
        $guru = Guru::OrderBy('nama_guru', 'asc')->get();
        return view('admin.jadwal.edit', compact('jadwal', 'hari', 'kelas', 'guru'));
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
            'hari_id' => 'required',
            'kelas_id' => 'required',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
        ]);

        Jadwal::find($id)->update(
            [
                'hari_id' => $request->hari_id,
                'kelas_id' => $request->kelas_id,
                'jam_mulai' => $request->jam_mulai,
                'jam_selesai' => $request->jam_selesai,
            ]
        );

        return redirect()->back()->with('success', 'Data jadwal berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $jadwal = Jadwal::findorfail($id);
        $jadwal->delete();

        return redirect()->back()->with('warning', 'Data jadwal berhasil dihapus! (Silahkan cek trash data jadwal)');
    }

    public function tukar_jadwal(Request $request)
    {
        Jadwal::find($request->jadwal_id)->update([
            'tukar_jadwal_id' => $request->tukar_jadwal_id,
            'status_permintaan' => 0
        ]);

        return redirect()->back()->with('success', 'Permintaan Pertukaran Jadwal Berhasil Dikirim');
    }

    public function trash()
    {
        $jadwal = Jadwal::onlyTrashed()->get();
        return view('admin.jadwal.trash', compact('jadwal'));
    }

    public function restore($id)
    {
        $id = Crypt::decrypt($id);
        $jadwal = Jadwal::withTrashed()->findorfail($id);
        $jadwal->restore();
        return redirect()->back()->with('info', 'Data jadwal berhasil direstore! (Silahkan cek data jadwal)');
    }

    public function kill($id)
    {
        $jadwal = Jadwal::withTrashed()->findorfail($id);
        $jadwal->forceDelete();
        return redirect()->back()->with('success', 'Data jadwal berhasil dihapus secara permanent');
    }

    public function view(Request $request)
    {
        $jadwal = Jadwal::OrderBy('hari_id', 'asc')->OrderBy('jam_mulai', 'asc')->where('kelas_id', $request->id)->get();
        foreach ($jadwal as $val) {
            $newForm[] = array(
                'hari' => $val->hari->nama_hari,
                'mapel' => $val->mapel->nama_mapel,
                'kelas' => $val->kelas->nama_kelas,
                'guru' => $val->guru->nama_guru,
                'jam_mulai' => $val->jam_mulai,
                'jam_selesai' => $val->jam_selesai,
            );
        }
        return response()->json($newForm);
    }

    public function jadwalSekarang(Request $request)
    {
        $user = auth()->user();

        $jadwal = Jadwal::OrderBy('jam_mulai')->OrderBy('jam_selesai')->OrderBy('kelas_id');
        // ->where('hari_id', $request->hari)->where('jam_selesai', '>=', $request->jam)

        if ($user->role == 'Guru') {
            $jadwal = $jadwal->where('guru_id', $user->guru($user->id_card)->id);
        }

        $jadwal = $jadwal->get();
        $count = $jadwal->count();

        foreach ($jadwal as $val) {
            $newForm[] = array(
                'mapel' => $val->mapel->nama_mapel,
                'kelas' => $val->kelas->nama_kelas,
                'guru' => $val->guru->nama_guru,
                'jam_mulai' => $val->jam_mulai,
                'jam_selesai' => $val->jam_selesai,
            );
        }

        $data = [
            'jadwalCount' => $count,
            'data' => !empty($newForm) ? $newForm : []
        ];

        return response()->json($data);
    }

    public function cetak_pdf(Request $request)
    {
        $jadwal = Jadwal::OrderBy('hari_id', 'asc')->OrderBy('jam_mulai', 'asc')->where('kelas_id', $request->id)->get();
        $kelas = Kelas::findorfail($request->id);
        $pdf = PDF::loadView('jadwal-pdf', ['jadwal' => $jadwal, 'kelas' => $kelas]);
        return $pdf->stream();
        // return $pdf->stream('jadwal-pdf.pdf');
    }

    public function guru()
    {
        $guru = Guru::where('id_card', Auth::user()->id_card)->first();
        $jadwal = Jadwal::orderBy('hari_id')->OrderBy('jam_mulai')->where('guru_id', $guru->id)->get();
        return view('guru.jadwal', compact('jadwal', 'guru'));
    }

    public function siswa()
    {
        $siswa = Siswa::where('no_induk', Auth::user()->no_induk)->first();
        $kelas = Kelas::findorfail($siswa->kelas_id);
        $jadwal = Jadwal::orderBy('hari_id')->OrderBy('jam_mulai')->where('kelas_id', $kelas->id)->get();
        return view('siswa.jadwal', compact('jadwal', 'kelas', 'siswa'));
    }

    public function export_excel()
    {
        return Excel::download(new JadwalExport, 'jadwal.xlsx');
    }

    public function import_excel(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);
        $file = $request->file('file');
        $nama_file = rand() . $file->getClientOriginalName();
        $file->move(public_path('file_jadwal'), $nama_file);
        Excel::import(new JadwalImport, public_path('/file_jadwal/' . $nama_file));
        return redirect()->back()->with('success', 'Data Siswa Berhasil Diimport!');
    }

    public function deleteAll()
    {
        $jadwal = Jadwal::all();
        if ($jadwal->count() >= 1) {
            Jadwal::whereNotNull('id')->delete();
            Jadwal::withTrashed()->whereNotNull('id')->forceDelete();
            return redirect()->back()->with('success', 'Data table jadwal berhasil dihapus!');
        } else {
            return redirect()->back()->with('warning', 'Data table jadwal kosong!');
        }
    }
}