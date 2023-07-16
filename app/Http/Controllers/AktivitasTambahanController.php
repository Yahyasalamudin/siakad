<?php

namespace App\Http\Controllers;

use App\AktivitasTambahan;
use Illuminate\Http\Request;

class AktivitasTambahanController extends Controller
{
    public function index()
    {
        $aktivitas = AktivitasTambahan::where('user_id', auth()->user()->id)->get();

        return view('aktivitas_tambahan.index', compact('aktivitas'));
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

        AktivitasTambahan::create([
            'kegiatan' => $request->kegiatan,
            'foto' => $nameFoto,
            'user_id' => auth()->user()->id
        ]);

        return redirect()->back()->with('success', 'Aktivitas berhasil ditambahkan');
    }

    public function destroy($id)
    {
        AktivitasTambahan::find($id)->delete();

        return redirect()->back()->with('success', 'Aktivitas berhasil dihapus');
    }
}