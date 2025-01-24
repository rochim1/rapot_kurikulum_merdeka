<?php

namespace App\Http\Controllers;

use App\Models\KelolaKelas;
use App\Models\RapotP5;
use App\Models\Siswa;
use Illuminate\Http\Request;

class RapotP5Controller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $kelola_kelas = KelolaKelas::with('kelas')
            ->where('id_tahun_ajaran', session('id_tahun_ajaran'))
            ->where('id_guru', auth()->user()->id)
            ->get();

        $kelola_kelas->each(function ($kelola) {
            $kelola->siswa = Siswa::whereIn('id_siswa', $kelola->daftar_id_siswa)->where('status', 'active')->get();
        });

        // tema
        $mataPelajaran = MataPelajaran::orderBy('kelompok', 'ASC')
        ->orderBy('nama_mata_pelajaran', 'ASC')
        ->get();

        $id_tema = null;

        return view('rapot.nilai.index', compact(
            'kelola_kelas',
            'mataPelajaran',
            'tujuan_pembelajaran',
            'id_mata_pelajaran',
            'mataPelajaranSelected',
            'title'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(RapotP5 $rapotP5)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RapotP5 $rapotP5)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, RapotP5 $rapotP5)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RapotP5 $rapotP5)
    {
        //
    }
}
