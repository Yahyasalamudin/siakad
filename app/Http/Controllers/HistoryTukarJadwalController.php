<?php

namespace App\Http\Controllers;

use App\HistoryTukarJadwal;
use Illuminate\Http\Request;

class HistoryTukarJadwalController extends Controller
{
    public function index()
    {
        $jadwal = HistoryTukarJadwal::get();
        return view('admin.jadwal.history_tukar_jadwal.index', compact('jadwal'));
    }

    public function show($id)
    {
        $id = decrypt($id);

        $jadwal = HistoryTukarJadwal::whereHas('jadwal', function ($query) use ($id) {
            $query->where('guru_id', $id);
        })->get();

        return view('admin.jadwal.history_tukar_jadwal.show', compact('jadwal'));
    }

    public function detail($id)
    {
        $id = decrypt($id);

        $data = HistoryTukarJadwal::find($id);

        return view('admin.jadwal.history_tukar_jadwal.detail', compact('data'));
    }
}