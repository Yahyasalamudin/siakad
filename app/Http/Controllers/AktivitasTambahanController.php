<?php

namespace App\Http\Controllers;

use App\AktivitasTambahan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class AktivitasTambahanController extends Controller
{
    public function index(Request $request)
    {
        $user_id = $request->user_id != null ? Crypt::decrypt($request->user_id) : auth()->user()->id;
        $aktivitas = AktivitasTambahan::where('user_id', $user_id)->get();

        return view('aktivitas_tambahan.index', compact('aktivitas', 'user_id'));
    }

    // public function aktivitas_tambahan_all(Request $request)
    // {
    //     $aktivitas = AktivitasTambahan::where('user_id', $request->user_id)->where('status', $request->status)->get();

    //     return json_encode($aktivitas);
    // }

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