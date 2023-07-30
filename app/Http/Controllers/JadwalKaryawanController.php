<?php

namespace App\Http\Controllers;

use App\User;
use App\Hari;
use App\JadwalKaryawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

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

    public function edit($id)
    {
        $id = Crypt::decrypt($id);

        $jadwal = JadwalKaryawan::findorfail($id);
        $karyawan = User::find($jadwal->user_id);
        $hari = Hari::all();

        return view('admin.jadwal_karyawan.edit', compact('jadwal', 'hari', 'karyawan'));
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
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
        ]);

        JadwalKaryawan::find($id)->update(
            [
                'hari_id' => $request->hari_id,
                'jam_mulai' => $request->jam_mulai,
                'jam_selesai' => $request->jam_selesai,
            ]
        );

        return redirect()->back()->with('success', 'Data jadwal berhasil diperbarui!');
    }

    public function show_hari($id)
    {
        $id = decrypt($id);
        $karyawan = User::find($id);
        $hari = Hari::get();

        return view('admin.jadwal_karyawan.show_hari', compact('hari', 'karyawan'));
    }

    public function show($id, $user_id)
    {
        $hari_id = decrypt($id);
        $user_id = decrypt($user_id);

        $karyawan = User::find($user_id);
        $jadwal = JadwalKaryawan::where('hari_id', $hari_id)->where('user_id', $user_id)->get();

        return view('admin.jadwal_karyawan.show', compact('jadwal', 'karyawan'));
    }

    public function destroy($id)
    {
        $jadwal = JadwalKaryawan::findorfail($id);
        $jadwal->delete();

        return redirect()->back()->with('warning', 'Data jadwal berhasil dihapus!)');
    }
}