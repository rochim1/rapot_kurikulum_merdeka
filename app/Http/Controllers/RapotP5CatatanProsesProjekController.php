<?php

namespace App\Http\Controllers;

use App\Models\KelolaKelas;
use App\Models\KelompokProjek;
use App\Models\RapotP5CatatanProsesProjek;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RapotP5CatatanProsesProjekController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $kelompokProjek = KelompokProjek::

        $title = 'Rapot Catatan Proses Projek';
        return view('rapot_p5.catatan_proses_projek.pilih_kelompok_projek', compact('kelola_kelas', 'title'));
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
    public function show(RapotP5CatatanProsesProjek $rapotP5CatatanProsesProjek)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RapotP5CatatanProsesProjek $rapotP5CatatanProsesProjek)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, RapotP5CatatanProsesProjek $rapotP5CatatanProsesProjek)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RapotP5CatatanProsesProjek $rapotP5CatatanProsesProjek)
    {
        //
    }
}
