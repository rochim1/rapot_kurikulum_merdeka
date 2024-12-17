<?php

namespace App\Http\Controllers;

use App\Imports\KelasImport;
use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Siswa;
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
        $siswa = Siswa::all(); // Mengambil semua siswa
        $tahunAjaran = TahunAjaran::all();
        return view('kelas.create', [
            'title' => 'Tambah Kelas',
            'guru' => $guru,
            'tahunAjaran' => $tahunAjaran,
            'siswa'=>$siswa
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi data yang dikirim dari form
        $validateData = $request->validate([
            'id_guru' => 'required|exists:tb_guru,id_guru',
            'id_tahun_ajaran' => 'required|exists:tb_tahun_ajaran,id_tahun_ajaran',
            'nama_kelas' => 'required|max:50',
            'tingkat' => 'required|in:1,2,3,4,5,6',
            'fase' => 'required|in:A,B,C',
            'id_siswa' => 'required',
            'id_siswa.*' => 'exists:tb_siswa,id_siswa', 
        ]);

        // Buat data kelas baru
        $kelas = Kelas::create([
            'id_guru' => $validateData['id_guru'],
            'id_tahun_ajaran' => $validateData['id_tahun_ajaran'],
            'nama_kelas' => $validateData['nama_kelas'],
            'tingkat' => $validateData['tingkat'],
            'fase' => $validateData['fase'],
        ]);
        // Tambahkan siswa ke kelas melalui relasi many-to-many
        $kelas->siswa()->attach($validateData['id_siswa']);
        // Tambahkan siswa ke tahun ajaran melalui relasi many-to-many
        $tahunAjaran = TahunAjaran::find($validateData['id_tahun_ajaran']);
        $tahunAjaran->siswa()->attach($validateData['id_siswa']);
        // Tampilkan notifikasi sukses
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
        $siswa = Siswa::all();
        $tahunAjaran = TahunAjaran::all();
        $selectSiswa=$kela->siswa->pluck('id_siswa')->toArray();
        return view('kelas.edit', [
            'title' => 'Edit Kelas',
            'kelas' => $kela,
            'guru' => $guru,
            'siswa' => $siswa,
            'tahunAjaran' => $tahunAjaran,
            'selectSiswa' => $selectSiswa,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id_kelas)
{
    // Ambil data kelas berdasarkan ID kelas
    $kelas = Kelas::findOrFail($id_kelas); // Mengambil kelas berdasarkan ID kelas

    // Validasi data yang dikirim dari form
    $validateData = $request->validate([
        'id_guru' => 'required|exists:tb_guru,id_guru',
        'id_tahun_ajaran' => 'required|exists:tb_tahun_ajaran,id_tahun_ajaran',
        'nama_kelas' => 'required|max:50',
        'tingkat' => 'required|in:1,2,3,4,5,6',
        'fase' => 'required|in:A,B,C',
        'id_siswa' => 'required|array',
        'id_siswa.*' => 'exists:tb_siswa,id_siswa', 
    ]);

    // Update data kelas
    $kelas->update([
        'id_guru' => $validateData['id_guru'],
        'id_tahun_ajaran' => $validateData['id_tahun_ajaran'],
        'nama_kelas' => $validateData['nama_kelas'],
        'tingkat' => $validateData['tingkat'],
        'fase' => $validateData['fase'],
    ]);

    // Detach siswa yang sudah ada sebelumnya
    $kelas->siswa()->detach();

    // Menambahkan siswa baru ke kelas menggunakan attach
    if (isset($validateData['id_siswa']) && is_array($validateData['id_siswa'])) {
        $kelas->siswa()->attach($validateData['id_siswa'], ['is_active' => true]);
    }

    // Tampilkan notifikasi sukses
    Alert::success('Kerja bagus', 'Kelas berhasil diperbarui!');

    // Redirect ke halaman kelas
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

    public function toggleStatus(Request $request, $id_kelas)
    {
        $request->validate([
            'is_active' => 'required|integer|in:1,2', 
        ]);
        $kelas = Kelas::findOrFail($id_kelas);
        $kelas->update([
            'is_active' => $request->input('is_active'),
        ]);
        Alert::success('Status berhasil diperbarui!', 'Kelas berhasil diubah statusnya.');
        return redirect()->route('kelas.index');
    }
}
