<?php

namespace App\Http\Controllers;

use App\Guru;
use App\Modul;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Auth;

class ModulController extends Controller
{
    public function index()
    {
        $modul = Modul::latest()->get();
        $guru = Guru::where('id_card', Auth::user()->id_card)->first();

        return view('guru.modul.index', compact('modul', 'guru'));
    }

    public function show($id)
    {
        $id = Crypt::decrypt($id);
        $modul = Modul::findorfail($id);
        return response()->file(public_path($modul->file_modul));
        // return view('guru.modul.show', compact('modul'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'semester' => 'required',
            'mapel' => 'required',
            'file_modul' => 'required',
        ]);

        $file_modul = $request->file_modul;
        $new_file_modul = date('siHdmY') . "_" . $file_modul->getClientOriginalName();
        $file_modul->move('uploads/modul/', $new_file_modul);
        $name_file_modul = 'uploads/modul/' . $new_file_modul;

        Modul::create([
            'tahun' => now()->format('Y'),
            'guru_id' => auth()->user()->id,
            'mapel_id' => $request->mapel,
            'semester' => $request->semester,
            'file_modul' => $name_file_modul,
        ]);

        return redirect()->back()->with('success', 'Modul berhasil ditambahkan');
    }

    public function destroy($id)
    {
        Modul::find($id)->delete();

        return redirect()->back()->with('success', 'Aktivitas berhasil dihapus');
    }
}