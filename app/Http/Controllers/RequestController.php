<?php

namespace App\Http\Controllers;

use App\Guru;
use App\HistoryTukarJadwal;
use App\Jadwal;
use App\PindahJadwal;
use Illuminate\Http\Request;

class RequestController extends Controller
{
    public function index()
    {
        $jadwal = Jadwal::where('status_permintaan', 0)->where('tukar_jadwal_id', '!=', null)->get();

        return view('admin.guru.pindah-jadwal', compact('jadwal'));
    }

    public function show($id)
    {
        $id = decrypt($id);

        $jadwal = Jadwal::where('guru_id', $id)->where('tukar_jadwal_id', '!=', null)->where('status_permintaan', 0)->get();

        return view('admin.guru.show-pindah-jadwal', compact('jadwal'));
    }

    public function detail($id)
    {
        $id = decrypt($id);

        $data = Jadwal::find($id);

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
        $jadwal = Jadwal::find($request->jadwal_id);

        HistoryTukarJadwal::insert([
            'approval_user_id' => auth()->user()->id,
            'jadwal_id' => $jadwal->id,
            'tukar_jadwal_id' => $jadwal->tukar_jadwal_id,
            'status_permintaan' => $request->status == 'tolak' ? 0 : 1,
        ]);

        if ($request->status == 'tolak') {
            $jadwal->update([
                'tukar_jadwal_id' => null,
                'status_permintaan' => null
            ]);

            return redirect('/permintaan/guru')->with('error', 'Permintaan Telah Ditolak');
        } else {
            Jadwal::find($jadwal->tukar_jadwal_id)->update([
                'tukar_jadwal_id' => $jadwal->id,
                'status_permintaan' => 1,
            ]);

            $jadwal->update([
                'status_permintaan' => 1
            ]);

            return redirect('/permintaan/guru')->with('success', 'Permintaan sudah disetujui');
        }
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