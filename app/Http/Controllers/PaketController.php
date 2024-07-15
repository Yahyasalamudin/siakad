<?php

namespace App\Http\Controllers;

use App\Paket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class PaketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paket = Paket::OrderBy('ket', 'asc')->get();
        return view('admin.paket.index', compact('paket'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->id != '') {
            $this->validate($request, [
                'ket' => 'required|min:6',
            ]);
        } else {
            $this->validate($request, [
                'ket' => 'required|unique:paket|min:6',
            ]);
        }

        Paket::updateOrCreate(
            [
                'id' => $request->id
            ],
            [
                'ket' => $request->ket,
            ]
        );

        return redirect()->back()->with('success', 'Data paket berhasil diperbarui!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $paket = Paket::findorfail($id);
        // $countJadwal = Jadwal::where('paket_id', $paket->id)->count();
        // if ($countJadwal >= 1) {
        //     Jadwal::where('paket_id', $paket->id)->delete();
        // } else {
        // }
        // $countSiswa = Siswa::where('paket_id', $paket->id)->count();
        // if ($countSiswa >= 1) {
        //     Siswa::where('paket_id', $paket->id)->delete();
        // } else {
        // }
        $paket->delete();
        return redirect()->back()->with('warning', 'Data paket berhasil dihapus! (Silahkan cek trash data paket)');
    }

    public function trash()
    {
        $paket = Paket::onlyTrashed()->get();
        return view('admin.paket.trash', compact('paket'));
    }

    public function restore($id)
    {
        $id = Crypt::decrypt($id);
        $paket = Paket::withTrashed()->findorfail($id);
        // $countJadwal = Jadwal::withTrashed()->where('paket_id', $paket->id)->count();
        // if ($countJadwal >= 1) {
        //     Jadwal::withTrashed()->where('paket_id', $paket->id)->restore();
        // } else {
        // }
        // $countSiswa = Siswa::withTrashed()->where('paket_id', $paket->id)->count();
        // if ($countSiswa >= 1) {
        //     Siswa::withTrashed()->where('paket_id', $paket->id)->restore();
        // } else {
        // }
        $paket->restore();
        return redirect()->back()->with('info', 'Data paket berhasil direstore! (Silahkan cek data paket)');
    }

    public function kill($id)
    {
        $paket = Paket::withTrashed()->findorfail($id);
        // $countJadwal = Jadwal::withTrashed()->where('paket_id', $paket->id)->count();
        // if ($countJadwal >= 1) {
        //     Jadwal::withTrashed()->where('paket_id', $paket->id)->forceDelete();
        // } else {
        // }
        // $countSiswa = Siswa::withTrashed()->where('paket_id', $paket->id)->count();
        // if ($countSiswa >= 1) {
        //     Siswa::withTrashed()->where('paket_id', $paket->id)->forceDelete();
        // } else {
        // }
        $paket->forceDelete();
        return redirect()->back()->with('success', 'Data paket berhasil dihapus secara permanent');
    }

    public function getEdit(Request $request)
    {
        $paket = Paket::where('id', $request->id)->get();
        foreach ($paket as $val) {
            $newForm[] = array(
                'id' => $val->id,
                'ket' => $val->ket,
            );
        }
        return response()->json($newForm);
    }
}
