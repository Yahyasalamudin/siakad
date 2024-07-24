<?php

namespace App\Http\Controllers;

use App\CleaningService;
use App\JadwalCS;
use Illuminate\Http\Request;

class CleaningServiceController extends Controller
{
    public function dashboard()
    {
        // $aktivitas = AktivitasTambahan::latest()->get();
        $hari = date('w');
        $jam = date('H:i:s', strtotime('-10 minutes'));
        $jadwalcs = JadwalCS::OrderBy('jam_mulai')->OrderBy('jam_selesai')
            ->where('hari_id', $hari)->where('jam_selesai', '>=', $jam)->get();

        return view('cs.home', compact('jadwalcs'));
    }

    public function index()
    {
        $aktivitas = CleaningService::latest()->get();

        return view('cs.aktivitas_tambahan.index', compact('aktivitas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kegiatan' => 'required',
            'foto' => 'required',
        ]);

        $foto = $request->foto;
        $new_foto = date('siHdmY') . "_" . $foto->getClientOriginalName();
        $foto->move(public_path('uploads/kegiatan/'), $new_foto);
        $nameFoto = 'uploads/kegiatan/' . $new_foto;

        CleaningService::create([
            'kegiatan' => $request->kegiatan,
            'foto' => $nameFoto,
            'user_id' => auth()->user()->id
        ]);

        return redirect()->back()->with('success', 'Aktivitas berhasil ditambahkan');
    }

    public function destroy($id)
    {
        CleaningService::find($id)->delete();

        return redirect()->back()->with('success', 'Aktivitas berhasil dihapus');
    }
}