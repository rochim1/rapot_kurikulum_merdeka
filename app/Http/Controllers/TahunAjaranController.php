<?php

namespace App\Http\Controllers;

use App\Imports\TahunAjaranImport;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;

class TahunAjaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('tahun_ajaran.index', [
            'tahunAjaran' => TahunAjaran::orderBy('tahun_ajaran_awal', 'desc')
                ->orderBy('tahun_ajaran_akhir', 'desc')
                ->orderBy('semester', 'desc')
                ->get(),
            'title' => 'Tahun Ajaran'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tahun_ajaran.create', [
            'tahunAjaranTerakhir' => TahunAjaran::orderBy('tahun_ajaran_awal', 'desc')
                ->orderBy('tahun_ajaran_akhir', 'desc')
                ->orderBy('semester', 'desc')
                ->first(),
            'title' => 'Tambah Tahun Ajaran'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'tahun_ajaran_awal' => 'required|integer|digits:4',
            'tahun_ajaran_akhir' => 'required|integer|digits:4|gt:tahun_ajaran_awal',
            'semester' => 'required|in:Ganjil,Genap',
        ]);

        TahunAjaran::create($validatedData);
        Alert::success('Sukses', 'Tahun ajaran berhasil disimpan!');
        return redirect()->route('tahun_ajaran.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TahunAjaran $tahunAjaran)
    {
        return view('tahun_ajaran.edit', [
            'title' => 'Edit Tahun Ajaran',
            'tahunAjaran' => $tahunAjaran,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TahunAjaran $tahunAjaran)
    {
        $validatedData = $request->validate([
            'tahun_ajaran_awal' => 'required|integer|digits:4',
            'tahun_ajaran_akhir' => 'required|integer|digits:4|gt:tahun_ajaran_awal',
            'semester' => 'required|in:Ganjil,Genap',
        ]);

        $tahunAjaran->update($validatedData);
        Alert::success('Sukses', 'Tahun ajaran berhasil diperbarui!');
        return redirect()->route('tahun_ajaran.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TahunAjaran $tahunAjaran)
    {
        $tahunAjaran->delete();
        Alert::success('Sukses', 'Tahun ajaran berhasil dihapus!');
        return redirect()->route('tahun_ajaran.index');
    }

    /**
     * Import data tahun ajaran from a file.
     */
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv,ods'
        ]);

        try {
            Excel::import(new TahunAjaranImport, $request->file('file'));
            Alert::success('Sukses', 'Data berhasil diimport!');
            return redirect()->route('tahun_ajaran.index');
        } catch (\Exception $e) {
            Alert::error('Terjadi kesalahan saat mengimport data', $e->getMessage());
            return redirect()->route('tahun_ajaran.index');
        }
    }

    /**
     * Update is_active status.
     */
    public function tahun_ajaran_is_active(TahunAjaran $tahunAjaran)
    { 
        $tahunAjaran->is_active == true 
            ? $tahunAjaran->update(['is_active' => false]) 
            : $tahunAjaran->update(['is_active' => true]);

        $tahunAjaran->refresh();
        $status = $tahunAjaran->is_active ? 'aktif' : 'nonaktif';

        Alert::success('Sukses', "Status tahun ajaran berhasil diperbarui menjadi $status!");
        return redirect()->route('tahun_ajaran.index');
    }    
}
