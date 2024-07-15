<?php

namespace App\Http\Controllers;

use App\Hari;
use App\JadwalCS;
use App\User;
use Illuminate\Http\Request;

class JadwalCSController extends Controller
{
    public function index()
    {
        $users = User::where('role', 'CS')->get();
        $hari = Hari::all();

        return view('admin.jadwal_cs.index', compact('users', 'hari'));
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

        JadwalCS::create(
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
        $cs = User::find($id);
        $jadwalcs = JadwalCS::where('user_id', $id)->get();

        return view('admin.jadwal_cs.show', compact('jadwalcs', 'cs'));
    }

    public function destroy($id)
    {
        $jadwal = JadwalCS::findorfail($id);
        $jadwal->delete();

        return redirect()->back()->with('warning', 'Data jadwal berhasil dihapus!)');
    }
}