<?php

namespace App\Http\Controllers;

use App\User;
use App\Hari;
use App\JadwalKaryawan;
use Illuminate\Http\Request;

class JadwalKaryawanController extends Controller
{
    public function index($role)
    {
        $users = User::where('role', $role)->get();
        $hari = Hari::all();

        return view('admin.jadwal_karyawan.index', compact('users', 'hari', 'role'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'user_id' => 'required',
            'tempat' => 'required',
            'hari_id' => 'required',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
        ]);

        JadwalKaryawan::create(
            [
                'user_id' => $request->user_id,
                'tempat' => $request->tempat,
                'hari_id' => $request->hari_id,
                'jam_mulai' => $request->jam_mulai,
                'jam_selesai' => $request->jam_selesai,
            ]
        );

        return redirect()->back()->with('success', 'Data jadwal berhasil diperbarui!');
    }

    public function show($id)
    {
        $id = decrypt($id);
        $karyawan = User::find($id);
        $jadwal = JadwalKaryawan::where('user_id', $id)->get();

        return view('admin.jadwal_karyawan.show', compact('jadwal', 'karyawan'));
    }

    public function destroy($id)
    {
        $jadwal = JadwalKaryawan::findorfail($id);
        $jadwal->delete();

        return redirect()->back()->with('warning', 'Data jadwal berhasil dihapus!)');
    }
}
