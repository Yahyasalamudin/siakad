<?php

namespace App\Http\Controllers;

use App\Guru;
use App\Jadwal;
use App\PindahJadwal;
use Illuminate\Http\Request;

class RequestController extends Controller
{
    public function index()
    {
        $pindahJadwal = PindahJadwal::get();

        foreach ($pindahJadwal as $pindah) {
            $guru = Guru::where('id', $pindah->guru_id)->get();
        }

        return view('admin.guru.pindah-jadwal', compact('guru'));
    }

    public function show($id)
    {
        $id = decrypt($id);

        $pindahJadwal = PindahJadwal::where('guru_id', $id)->get();

        return view('admin.guru.show-pindah-jadwal', compact('pindahJadwal'));
    }

    public function detail($id)
    {
        $id = decrypt($id);

        $data = PindahJadwal::find($id);

        return view('admin.guru.detail-pindah-jadwal', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function approve(Request $request)
    {
        $pindahJadwal = PindahJadwal::find($request->id_request);

        Jadwal::find($request->id)->update([
            'hari_id' => $pindahJadwal->hari_id,
            'jam_mulai' => $pindahJadwal->jam_mulai,
            'jam_selesai' => $pindahJadwal->jam_selesai
        ]);

        return redirect()->back()->with('success', 'Permintaan sudah disetujui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}