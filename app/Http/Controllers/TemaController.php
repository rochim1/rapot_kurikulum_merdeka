<?php

namespace App\Http\Controllers;

use App\Models\TahunAjaran;
use App\Models\Tema;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class TemaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tema = Tema::with('tahunAjaran')
                        ->join('tb_tahun_ajaran', 'tb_tema.id_tahun_ajaran', '=', 'tb_tahun_ajaran.id_tahun_ajaran')
                        ->orderBy('tb_tahun_ajaran.tahun_ajaran_awal', 'desc') 
                        ->orderBy('tb_tahun_ajaran.tahun_ajaran_akhir', 'desc') 
                        ->orderBy('tb_tahun_ajaran.semester', 'desc')
                        ->paginate(10);
        $title = 'Tema ';
        return view('tema.index', compact('tema', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Tema ';
        $tahunAjaran = TahunAjaran::orderBy('tahun_ajaran_awal', 'desc')
        ->orderBy('tahun_ajaran_akhir', 'desc')
        ->orderBy('semester', 'desc')
        ->get();
        
        return view('tema.create', compact('title', 'tahunAjaran'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_tema' => 'required|string|max:100',
            'deskripsi_tema' => 'nullable|string',
            'dimensi' => 'nullable|string|max:100',
            'deskripsi_dimensi' => 'nullable|string',
            'id_tahun_ajaran' => 'nullable|exists:tb_tahun_ajaran,id_tahun_ajaran', // Pastikan id_tahun_ajaran valid
        ]);

        // Menyimpan data ke database
        Tema::create([
            'nama_tema' => $request->nama_tema,
            'deskripsi_tema' => $request->deskripsi_tema,
            'dimensi' => $request->dimensi,
            'deskripsi_dimensi' => $request->deskripsi_dimensi,
            'id_tahun_ajaran' => $request->id_tahun_ajaran,
        ]);

        Alert::success('Kerja Bagus', 'Data berhasil ditambahkan, silakan tambahkan data baru.');
        return redirect()->route('tema.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tema $tema)
    {
        $title = 'Tema ';
        return view('tema.show', compact('tema', 'title'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tema $tema)
    {
        $title = 'Tema ';
        $tahunAjaran = TahunAjaran::orderBy('tahun_ajaran_awal', 'desc')
        ->orderBy('tahun_ajaran_akhir', 'desc')
        ->orderBy('semester', 'desc')
        ->get();
        return view('tema.edit', compact('tema', 'title', 'tahunAjaran'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tema $tema)
    {
        $request->validate([
            'nama_tema' => 'required|string|max:100',
            'deskripsi_tema' => 'nullable|string',
            'dimensi' => 'nullable|string|max:100',
            'deskripsi_dimensi' => 'nullable|string',
            'id_tahun_ajaran' => 'nullable|exists:tb_tahun_ajaran,id_tahun_ajaran', // Pastikan id_tahun_ajaran valid
        ]);

        $tema->update([
            'nama_tema' => $request->nama_tema,
            'deskripsi_tema' => $request->deskripsi_tema,
            'dimensi' => $request->dimensi,
            'deskripsi_dimensi' => $request->deskripsi_dimensi,
            'id_tahun_ajaran' => $request->id_tahun_ajaran,
        ]);

        Alert::success('Kerja Bagus', 'Data berhasil diperbarui!');
        return redirect()->route('tema.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tema $tema)
    {
        $tema->delete();
        Alert::success('Kerja Bagus', 'Data berhasil dihapus!');
        return redirect()->route('tema.index');
    }
}