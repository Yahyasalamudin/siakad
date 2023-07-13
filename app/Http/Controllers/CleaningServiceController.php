<?php

namespace App\Http\Controllers;

use App\CleaningService;
use Illuminate\Http\Request;

class CleaningServiceController extends Controller
{
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
        $foto->move('uploads/kegiatan/', $new_foto);
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