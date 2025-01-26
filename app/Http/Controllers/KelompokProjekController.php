<?php

namespace App\Http\Controllers;

use App\Models\DataProjek;
use App\Models\Kelas;
use App\Models\User;
use App\Models\KelompokProjek;
use App\Models\kelompokProjekDataProjek;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class KelompokProjekController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kelompokProjek = KelompokProjek::with(['tahunAjaran', 'kelas', 'user'])->paginate(10);
        $title = 'Kelompok Projek';
        return view('kelompok_projek.index', compact('kelompokProjek', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('kelompok_projek.create', [
            'title' => 'Tambah Kelompok Projek',
            'tahunAjaran' => TahunAjaran::orderBy('tahun_ajaran_awal', 'desc')->orderBy('tahun_ajaran_akhir', 'desc')->orderBy('semester', 'desc')->get(),
            'kelas' => Kelas::orderBy('kelas_tingkatan', 'asc')->orderBy('fase', 'asc')->orderBy('kelas_abjad', 'asc')->get(),
            'user' => User::role('walas')->orderBy('name')->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'nullable|string|max:255',
            'id_tahun_ajaran' => 'nullable|exists:tb_tahun_ajaran,id_tahun_ajaran',
            'id_kelas' => 'nullable|exists:tb_kelas,id_kelas',
            'id_user' => 'nullable|exists:users,id',
        ]);

        KelompokProjek::create([
            'nama' => $request->nama,  
            'id_tahun_ajaran' => $request->id_tahun_ajaran,
            'id_kelas' => $request->id_kelas,
            'id_user' => $request->id_user,
        ]);

        Alert::success('Sukses', 'Data berhasil disimpan!');
        return redirect()->route('kelompok_projek.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(KelompokProjek $kelompokProjek)
    {
        return view('kelompok_projek.show', [
            'title' => 'Detail Kelompok Projek',
            'kelompokProjek' => KelompokProjek::with(['tahunAjaran', 'kelas', 'user'])->find($kelompokProjek->id_kelompok_projek),
            'kelompokProjekDataProjek' => KelompokProjekDataProjek::with('kelompokProjek', 'dataProjek')
            ->where('id_kelompok_projek', $kelompokProjek->id_kelompok_projek)
            ->get(),
            'kelompokProjekList' => DataProjek::orderBy('created_at', 'DESC')->get(), // Untuk modal
        ]);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(KelompokProjek $kelompokProjek)
    {
        return view('kelompok_projek.edit', [
            'title' => 'Edit Kelompok Projek',
            'kelompokProjek' => $kelompokProjek,
            'tahunAjaran' => TahunAjaran::orderBy('tahun_ajaran_awal', 'desc')->orderBy('tahun_ajaran_akhir', 'desc')->orderBy('semester', 'desc')->get(),
            'kelas' => Kelas::orderBy('kelas_tingkatan', 'asc')->orderBy('fase', 'asc')->orderBy('kelas_abjad', 'asc')->get(),
            'user' => User::role('walas')->orderBy('name')->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, KelompokProjek $kelompokProjek)
    {
        $request->validate([
            'nama' => 'nullable|string|max:255', 
            'id_tahun_ajaran' => 'nullable|exists:tb_tahun_ajaran,id_tahun_ajaran',
            'id_kelas' => 'nullable|exists:tb_kelas,id_kelas',  
            'id_user' => 'nullable|exists:users,id',
        ]);

        $kelompokProjek->update([
            'nama' => $request->nama ?? $kelompokProjek->nama,
            'id_tahun_ajaran' => $request->id_tahun_ajaran ?? $kelompokProjek->id_tahun_ajaran,
            'id_kelas' => $request->id_kelas ?? $kelompokProjek->id_kelas,
            'id_user' => $request->id_user ?? $kelompokProjek->id_user,
        ]);

        Alert::success('Kerja bagus', 'Kelompok Projek berhasil diperbarui!');
        return redirect()->route('kelompok_projek.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(KelompokProjek $kelompokProjek)
    {
        $kelompokProjek->delete();
        Alert::success('Kerja bagus', 'Kelompok Projek berhasil dihapus!');
        return redirect()->route('kelompok_projek.index');
    }
}
