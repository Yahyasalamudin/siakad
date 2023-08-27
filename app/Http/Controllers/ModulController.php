<?php

namespace App\Http\Controllers;

use App\Guru;
use App\Mapel;
use App\Modul;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Auth;

class ModulController extends Controller
{
    public function index(Request $request)
    {
        $guru = Guru::where('id_card', Auth::user()->id_card)->first();
        $mapel = $guru->mapel()->get();

        $tanggal_awal = $request->tanggal_awal ?: now();
        $tanggal_akhir = $request->tanggal_akhir ?: now();
        $mapel_id = $request->mapel;
        $modul = Modul::where('guru_id', $guru->id)
            ->when($mapel_id, function ($query) use ($mapel_id) {
                $query->where('mapel_id', $mapel_id);
            })
            ->whereDate('created_at', '>=', $tanggal_awal)
            ->whereDate('created_at', '<=', $tanggal_akhir)
            ->get();

        return view('guru.modul.index', compact('modul', 'guru', 'mapel'));
    }

    public function show(Request $request)
    {
        $guru = Guru::all();

        $tanggal_awal = $request->tanggal_awal ?: now();
        $tanggal_akhir = $request->tanggal_akhir ?: now();
        $guru_id = $request->guru;
        $mapel_id = $request->mapel;
        // dd($guru_id);
        // dd($mapel_id);
        $modul = Modul::
            when($mapel_id, function ($query) use ($guru_id) {
                $query->where('guru_id', $guru_id);
            })
            ->when($mapel_id, function ($query) use ($mapel_id) {
                $query->where('mapel_id', $mapel_id);
            })
            ->whereDate('created_at', '>=', $tanggal_awal)
            ->whereDate('created_at', '<=', $tanggal_akhir)
            ->get();

        return view('admin.modul.index', compact('modul', 'guru'));
    }

    public function get_mapel_guru($id)
    {
        $guru = Guru::find($id);
        $mapel = $guru->mapel;

        return json_encode($mapel);
    }

    public function show_file($id)
    {
        $id = Crypt::decrypt($id);
        $modul = Modul::findorfail($id);
        return response()->file(public_path($modul->file_modul));
    }

    public function store(Request $request)
    {
        $guru = Guru::where('id_card', Auth::user()->id_card)->first();

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
            'guru_id' => $guru->id,
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