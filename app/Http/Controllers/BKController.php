<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BKController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        $siswa = '';
        return view('bk.absensi_siswa', compact('siswa'));
    }
}