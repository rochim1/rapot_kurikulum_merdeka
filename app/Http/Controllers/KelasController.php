<?php
namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class KelasController extends Controller
{
    public function index()
    {
        $kelas = Kelas::with('TahunAjaran')
        ->orderByDesc('kelas_tingkatan')  // Sorting by kelas_tingkatan in descending order
        ->orderByDesc('kelas_abjad')      // Sorting by kelas_abjad in descending order
        ->get();

        $tahunAjaran = TahunAjaran::orderBy('tahun_ajaran_awal', 'desc')
            ->orderBy('tahun_ajaran_akhir', 'desc')
            ->orderBy('semester', 'desc')
            ->get();

        return view('kelas.index', [
            'kelas' => $kelas,
            'tahunAjaran' => $tahunAjaran,
            'title' => 'Kelas'
        ]);
    }

    public function create()
    {
        return view('kelas.create', [
            'title' => 'Tambah Kelas',
            'tahunAjaran' => TahunAjaran::orderBy('tahun_ajaran_awal', 'desc')
                ->orderBy('tahun_ajaran_akhir', 'desc')
                ->orderBy('semester', 'desc')
                ->get(),
        ]);
    }

    public function store(Request $request)
    {
        // Validasi inputan
        $validateData = $request->validate([
            'id_tahun_ajaran' => 'required|exists:tb_tahun_ajaran,id_tahun_ajaran',
            'kelas_tingkatan' => 'required|in:I,II,III,IV,V,VI',
            'kelas_abjad' => 'required|in:A,B,C,D,E,F',
            'fase' => 'required|in:A,B,C',
        ]);

        // Membuat data Kelas
        Kelas::create($validateData);

        Alert::success('Kerja bagus', 'Kelas berhasil disimpan!');
        return redirect()->route('kelas.index');
    }

    public function show(Kelas $kela)
    {
        // Menampilkan detail kelas jika diperlukan
    }

    public function edit(Kelas $kela)
    {
        return view('kelas.edit', [
            'title' => 'Edit Kelas',
            'kelas' => $kela,
            'tahunAjaran' => TahunAjaran::orderBy('tahun_ajaran_awal', 'desc')
                ->orderBy('tahun_ajaran_akhir', 'desc')
                ->orderBy('semester', 'desc')
                ->get(),
        ]);
    }

    public function update(Request $request, Kelas $kela)
    {
        // Validasi inputan
        $validateData = $request->validate([
            'id_tahun_ajaran' => 'required|exists:tb_tahun_ajaran,id_tahun_ajaran',
            'kelas_tingkatan' => 'required|in:I,II,III,IV,V,VI',
            'kelas_abjad' => 'required|in:A,B,C,D,E,F',
            'fase' => 'required|in:A,B,C',
        ]);

        // Mengupdate data kelas
        $kela->update($validateData);

        Alert::success('Kerja bagus', 'Kelas berhasil diperbarui!');
        return redirect()->route('kelas.index');
    }

    public function destroy(Kelas $kela)
    {
        // Menghapus data kelas
        $kela->delete();
        Alert::success('Kerja bagus', 'Kelas berhasil dihapus!');
        return redirect()->route('kelas.index')->with('success', 'Data kelas berhasil dihapus.');
    }
}
