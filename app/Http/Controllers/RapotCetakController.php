<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\KelolaKelas;
use App\Models\Rapot;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class RapotCetakController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {       
            return $rapot = Rapot::with('kelas', 'TahunAjaran', 'siswa', 'guru')
            ->where('id_tahun_ajaran', session('id_tahun_ajaran'))
            ->where('id_guru', auth()->user()->id)
            ->get();
    
            $title = 'Rapot';
            $siswa =  Siswa::all();
            return view('rapot.cetak', compact('kelola_kelas', 'title', 'siswa'));
    }
}
