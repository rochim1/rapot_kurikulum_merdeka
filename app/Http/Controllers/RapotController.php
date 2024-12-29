<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Rapot;
use App\Models\Siswa;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class RapotController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function nilai()
    {
        // return Siswa::with('tahun_ajaran')->orderBy('nama')->where('nama_tahun_ajaran', '=', session('nama_tahun_ajaran'))->get();
        // return Siswa::with('tahun_ajaran')->orderBy('nama')->where('nama_tahun_ajaran', '=', session('nama_tahun_ajaran'))->get();
        return view('rapot.nilai', [
            // 'siswa' =>  Siswa::all(),
            'siswa' =>  Siswa::orderBy('nama')->get(),
            'title' => 'Nilai',
        ]);
    }
    
    public function kehadiran()
    {
        return view('rapot.kehadiran', [
            'siswa' =>  Siswa::orderBy('nama')->get(),
            'title' => 'Kehadiran',
        ]);
    }

    public function ekstrakulikuler()
    {
        return view('rapot.ekstrakulikuler', [
            'siswa' =>  Siswa::orderBy('nama')->get(),
            'title' => 'Ekstrakulikuler',
        ]);
    }

    public function catatan_wali_kelas()
    {
        return view('rapot.catatan_wali_kelas', [
            'siswa' =>  Siswa::orderBy('nama')->get(),
            'title' => 'Catatan Wali Kelas',
        ]);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('rapot.create', [
            'siswa' => Siswa::all(),
            'kelas' => Kelas::all(),
            'title' => 'Rapot',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'id_siswa' => 'required|exists:tb_siswa,id_siswa',
            'id_kelas' => 'required|exists:tb_kelas,id_kelas',
            'semester' => 'required|in:1,2',
            'sakit' => 'required|integer',
            'izin' => 'required|integer',
            'tanpa_keterangan' => 'required|integer',
            'catatan_wali_kelas' => 'nullable|string',
            'nama_wali_kelas' => 'required|string',
            'nip_wali_kelas' => 'required|numeric',
            'nama_kepsek' => 'required|string',
            'nip_kepsek' => 'required|numeric',
            'status' => 'required|in:draf,submited',
        ]);

        Rapot::create($validatedData);
        Alert::success('Sukses', 'Rapot berhasil disimpan!');
        return redirect()->route('rapot.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Rapot $rapot)
    {
        return view('rapot.show', [
            'Rapot' =>  Rapot::with(['Siswa', 'Kelas'])->get(),
            'rapot' => $rapot,
            'title' => 'Rapot',
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Rapot $rapot)
    {
        return view('rapot.edit', [
            'siswa' => Siswa::all(),
            'kelas' => Kelas::all(),
            'rapot' => $rapot,
            'title' => 'Rapot',
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Rapot $rapot)
    {
        $validatedData = $request->validate([
            'id_siswa' => 'required|exists:tb_siswa,id_siswa',
            'id_kelas' => 'required|exists:tb_kelas,id_kelas',
            'semester' => 'required|in:1,2',
            'sakit' => 'required|integer',
            'izin' => 'required|integer',
            'tanpa_keterangan' => 'required|integer',
            'catatan_wali_kelas' => 'nullable|string',
            'nama_wali_kelas' => 'required|string',
            'nip_wali_kelas' => 'required|numeric',
            'nama_kepsek' => 'required|string',
            'nip_kepsek' => 'required|numeric',
            'status' => 'required|in:draf,submited',
        ]);

        $rapot->update($validatedData);
        Alert::success('Sukses', 'Rapot berhasil diperbarui!');
        return redirect()->route('rapot.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Rapot $rapot)
    {
        $rapot->delete();
        Alert::success('Sukses', 'Rapot berhasil dihapus!');
        return redirect()->route('rapot.index');
    }
}
