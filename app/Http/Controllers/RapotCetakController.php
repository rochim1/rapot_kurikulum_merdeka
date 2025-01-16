<?php

namespace App\Http\Controllers;

use App\Models\ProfilSekolah;
use App\Models\Rapot;
use App\Models\Siswa;

class RapotCetakController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {       
            $rapot = Rapot::with('kelas', 'TahunAjaran', 'siswa', 'guru', 'rapotEkstrakulikuler.ekstrakulikuler')
            ->where('id_tahun_ajaran', session('id_tahun_ajaran'))
            ->where('id_guru', auth()->user()->id)
            ->get();

            $profilSekolah = ProfilSekolah::find(1);
            $title = 'Rapot';
            $siswa = Siswa::all();
            return view('rapot.cetak.index', compact('siswa','title', 'rapot', 'profilSekolah'));
    }
}
