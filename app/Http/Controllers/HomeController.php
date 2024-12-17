<?php

namespace App\Http\Controllers;

use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $tahunAjaranId = session('nama_tahun_ajaran');
        if (!$tahunAjaranId) {
            return redirect()->route('login')->with('error', 'Tahun ajaran tidak ditemukan.');
        }
        $tahunAjaran = TahunAjaran::find($tahunAjaranId);
        if (!$tahunAjaran) {
            return redirect()->route('login')->with('error', 'Tahun ajaran tidak ditemukan.');
        }
        $jumlahSiswa = $tahunAjaran->siswa->count();
        return view('home', compact('jumlahSiswa', 'tahunAjaran'));
    }

}
