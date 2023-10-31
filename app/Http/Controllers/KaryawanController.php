<?php

namespace App\Http\Controllers;

use App\AbsenKaryawan;
use App\JadwalKaryawan;
use App\Karyawan;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class KaryawanController extends Controller
{
    public function dashboard()
    {
        // $aktivitas = AktivitasTambahan::latest()->get();
        $hari = date('w');
        $jam = date('H:i:s', strtotime('-10 minutes'));
        $jadwal = JadwalKaryawan::OrderBy('jam_mulai')->OrderBy('jam_selesai')
            ->where('hari_id', $hari)->where('user_id', auth()->user()->id)->where('jam_selesai', '>=', $jam)->get();

        // $jadwal = JadwalKaryawan::OrderBy('jam_mulai')->OrderBy('jam_selesai')->get();

        return view('karyawan.home', compact('jadwal'));
    }

    public function index()
    {
        $aktivitas = Karyawan::latest()->get();

        return view('karyawan.aktivitas_tambahan.index', compact('aktivitas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kegiatan' => 'required',
            'foto' => 'required',
        ]);

        $foto = $request->foto;
        $new_foto = date('siHdmY') . "_" . $foto->getClientOriginalName();
        $foto->move('uploads/kegiatan/', $new_foto);
        $nameFoto = 'uploads/kegiatan/' . $new_foto;

        Karyawan::create([
            'kegiatan' => $request->kegiatan,
            'foto' => $nameFoto,
            'user_id' => auth()->user()->id
        ]);

        return redirect()->back()->with('success', 'Aktivitas berhasil ditambahkan');
    }

    public function destroy($id)
    {
        Karyawan::find($id)->delete();

        return redirect()->back()->with('success', 'Aktivitas berhasil dihapus');
    }

    public function absen(Request $request)
    {
        $id = auth()->user()->id;
        $jadwal_id = decrypt($request->jadwal_id);

        $jadwal = JadwalKaryawan::find($jadwal_id);

        return view('karyawan.absen', compact('jadwal'));
    }

    public function simpan_absen(Request $request)
    {
        $this->validate($request, [
            'foto_awal' => 'required',
            'foto_akhir' => 'required',
            'keterangan' => 'required',
        ]);

        $user = auth()->user();

        if ($request->foto_awal) {
            $fotoAwal = $request->foto_awal;
            $new_foto_awal = date('siHdmY') . "_" . $fotoAwal->getClientOriginalName();
            $fotoAwal->move('uploads/absensi-karyawan/', $new_foto_awal);
            $fotoAwalName = 'uploads/absensi-karyawan/' . $new_foto_awal;
        }

        if ($request->foto_akhir) {
            $fotoAkhir = $request->foto_akhir;
            $new_foto_akhir = date('siHdmY') . "_" . $fotoAkhir->getClientOriginalName();
            $fotoAkhir->move('uploads/absensi-karyawan/', $new_foto_akhir);
            $fotoAkhirName = 'uploads/absensi-karyawan/' . $new_foto_akhir;
        }

        AbsenKaryawan::create([
            'user_id' => $user->id,
            'jadwal_id' => $request->jadwal_id,
            'keterangan' => $request->keterangan,
            'foto_awal' => $fotoAwalName,
            'foto_akhir' => $fotoAkhirName,
        ]);

        return redirect('karyawan/dashboard')->with('success', 'Anda telah berhasil absen');
    }

    public function karyawan_all($role)
    {
        $karyawan = User::whereJsonContains('roles', $role)->get();

        return view('karyawan.karyawan-all', compact('karyawan', 'role'));
    }

    public function rekap_absen(Request $request)
    {
        $user_id = $request->user_id != null ? Crypt::decrypt($request->user_id) : auth()->user()->id;

        $tanggal_awal = $request->tanggal_awal ?: now();
        $tanggal_akhir = $request->tanggal_akhir ?: now();

        $karyawan = User::find($user_id);
        $absen_karyawan = AbsenKaryawan::where('user_id', $user_id)
            ->when($request->status, function ($query, $status) {
                return $query->where('status', $status);
            })
            ->whereDate('created_at', '>=', $tanggal_awal)
            ->whereDate('created_at', '<=', $tanggal_akhir)
            ->get();

        return view('karyawan.rekap-absen', compact('karyawan', 'absen_karyawan', 'user_id'));
    }

    public function get_rekap_absen(Request $request)
    {
        $karyawan = User::find($request->user_id);
        $absen_karyawan = AbsenKaryawan::where('user_id', $karyawan->id)
            ->where('status', $request->status)->get();

        return response()->json($absen_karyawan);
        // return json_encode($absen_karyawan);
    }

    public function konfirmasi_absen($id)
    {
        $absen_karyawan = AbsenKaryawan::find($id);
        $absen_karyawan->update(['status' => 'dikonfirmasi']);

        if ($absen_karyawan->status == 'dikonfirmasi') {
            return redirect()->back()->with('success', 'Absen berhasil dikonfirmasi.');
        }
        return redirect()->back()->with('error', 'Absen gagal dikonfirmasi.');
    }

    public function tolak_absen($id)
    {
        $absen_karyawan = AbsenKaryawan::find($id);
        $absen_karyawan->update(['status' => 'ditolak']);

        if ($absen_karyawan->status == 'ditolak') {
            return redirect()->back()->with('success', 'Absen berhasil ditolak.');
        }

        return redirect()->back()->with('error', 'Absen gagal ditolak.');
    }
}