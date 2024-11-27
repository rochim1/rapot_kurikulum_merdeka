<?php

namespace App\Http\Controllers;

use App\Imports\KelasImport;
use App\Models\Guru;
use App\Models\Kelas;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('kelas.index', [
            'kelas' => Kelas::with(['Guru','TahunAjaran'])->get(),
            'title' => 'Kelas'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $guru = Guru::all();
        $tahunAjaran = TahunAjaran::all();
        return view('kelas.create', [
            'title' => 'Tambah Kelas',
            'guru' => $guru,
            'tahunAjaran' => $tahunAjaran
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'id_guru' => 'required|exists:tb_guru,id_guru',
            'id_tahun_ajaran' => 'required|exists:tb_tahun_ajaran,id_tahun_ajaran',
            'nama_kelas' => 'required|max:50',
            'tingkat' => 'required|in:1,2,3,4,5,6',
            'fase' => 'required|in:A,B,C',
        ]);

        // Create the Kelas
        Kelas::create($validateData);

        Alert::success('Kerja bagus', 'Kelas berhasil disimpan!');
        return redirect()->route('kelas.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Kelas $kela)
    {
        // 
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kelas $kela)
    {
        $guru = Guru::all();
        $tahunAjaran = TahunAjaran::all();
        return view('kelas.edit', [
            'title' => 'Edit Kelas',
            'kelas' => $kela,
            'guru' => $guru,
            'tahunAjaran' => $tahunAjaran
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kelas $kela)
    {
        $validateData = $request->validate([
            'id_guru' => 'required|exists:tb_guru,id_guru',
            'id_tahun_ajaran' => 'required|exists:tb_tahun_ajaran,id_tahun_ajaran',
            'nama_kelas' => 'required|max:50',
            'tingkat' => 'required|in:1,2,3,4,5,6',
            'fase' => 'required|in:A,B,C',
        ]);

        // Update the Kelas
        $kela->update($validateData);

        Alert::success('Kerja bagus', 'Kelas berhasil diperbarui!');
        return redirect()->route('kelas.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kelas $kela)
    {
        $kela->delete();
        Alert::success('Kerja bagus', 'Kelas berhasil dihapus!');
        return redirect()->route('kelas.index');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv,ods'
        ]);
        
        try {
            Excel::import(new KelasImport, $request->file('file'));
            Alert::success('kerja bagus', 'Data berhasil diimport!');        
            return redirect()->route('kelas.index');
        } catch (\Exception $e) {
            Alert::error('Terjadi kesalahan saat mengimport data', $e->getMessage());        
            return redirect()->route('kelas.index');
        }
    }
}
