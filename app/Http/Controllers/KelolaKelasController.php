<?php

namespace App\Http\Controllers;

use App\Imports\KelasImport;
use App\Models\Guru;
use App\Models\Kelas;
use App\Models\KelolaKelas;
use App\Models\Siswa;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;

class KelolaKelasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('kelola_kelas.index', [
            'kelolakelas' => KelolaKelas::with(['guru', 'tahunAjaran', 'kelas'])->get(),
            'title' => 'Kelola Kelas'
        ]);
    }

    public function create(Request $request)
    {
        // Mengambil data guru, kelas, dan tahun ajaran
        $guru = Guru::orderBy('nama', 'asc')->get();
        $kelas = Kelas::orderBy('kelas_tingkatan', 'asc')->orderBy('kelas_abjad', 'asc')->get();
        $tahunAjaran = TahunAjaran::orderBy('tahun_ajaran_awal', 'desc')->get();
        $title = 'Kelola Kelas';

        // Mendapatkan siswa yang belum terdaftar di kelas yang dipilih
        $siswa = [];
        if ($request->has('id_kelas')) {
            $id_kelas = $request->input('id_kelas');
            if ($id_kelas === 'not_registered') {
                // Ambil siswa yang belum terdaftar di kelas manapun
                $siswaTerdaftarIds = KelolaKelas::select('daftar_id_siswa')
                    ->get()
                    ->flatMap(function ($item) {
                        return json_decode($item->daftar_id_siswa);
                    })
                    ->unique();

                $siswa = Siswa::whereNotIn('id_siswa', $siswaTerdaftarIds)->get();
            } else {
                // Ambil siswa yang sudah terdaftar di kelas
                $kelolaKelas = KelolaKelas::where('id_kelas', $id_kelas)->first();
                if ($kelolaKelas) {
                    $siswaIds = json_decode($kelolaKelas->daftar_id_siswa);
                    $siswa = Siswa::whereIn('id_siswa', $siswaIds)->get();
                }
            }
        }

        return view('kelola_kelas.create', compact('guru', 'kelas', 'tahunAjaran', 'siswa', 'title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    { 
        return $request;
        // Validasi input form
        $request->validate([
            'id_tahun_ajaran' => 'required|exists:tb_tahun_ajaran,id_tahun_ajaran',
            'id_guru' => 'required|exists:tb_guru,id_guru',
            'id_kelas' => 'required|exists:tb_kelas,id_kelas',
            'id_siswa' => 'required|array',
            'id_siswa.*' => 'exists:tb_siswa,id_siswa',
        ]);

        // Menyimpan data kelas yang baru
        $kelolaKelas = new KelolaKelas();
        $kelolaKelas->id_tahun_ajaran = $request->id_tahun_ajaran;
        $kelolaKelas->id_guru = $request->id_guru;
        $kelolaKelas->id_kelas = $request->id_kelas;
        $kelolaKelas->daftar_id_siswa = json_encode($request->id_siswa); // Menyimpan siswa yang terdaftar dalam format JSON
        $kelolaKelas->save();

        // Menampilkan pesan sukses
        Alert::success('Kerja bagus', 'Kelas berhasil disimpan!');
        return redirect()->route('kelola_kelas.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(KelolaKelas $kela)
    {
        // 
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(KelolaKelas $kelola_kela)
    {
        $guru = Guru::all();
        $tahunAjaran = TahunAjaran::all();
        $kelas = Kelas::all();

        $selectSiswa=$kelola_kela->siswa->pluck('id_siswa')->toArray();
        return view('kelola_kelas.edit', [
            'title' => 'Edit Kelas',
            'kelolakelas' => $kelola_kela,
            'guru' => $guru,
            'kelas' => $kelas,
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
        $kelas = KelolaKelas::findOrFail($id_kelas); // Mengambil kelas berdasarkan ID kelas

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
        return redirect()->route('kelola_kelas.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(KelolaKelas $kelola_kela)
    {
        $kelola_kela->delete();
        Alert::success('Kerja bagus', 'Kelas berhasil dihapus!');
        return redirect()->route('kelola_kelas.index');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv,ods'
        ]);
        
        try {
            Excel::import(new KelasImport, $request->file('file'));
            Alert::success('kerja bagus', 'Data berhasil diimport!');        
            return redirect()->route('kelola_kelas.index');
        } catch (\Exception $e) {
            Alert::error('Terjadi kesalahan saat mengimport data', $e->getMessage());        
            return redirect()->route('kelola_kelas.index');
        }
    }

    public function toggleStatus(Request $request, $id_kelas)
    {
        $request->validate([
            'is_active' => 'required|integer|in:1,2', 
        ]);
        $kelas = KelolaKelas::findOrFail($id_kelas);
        $kelas->update([
            'is_active' => $request->input('is_active'),
        ]);
        Alert::success('Status berhasil diperbarui!', 'Kelas berhasil diubah statusnya.');
        return redirect()->route('kelola_kelas.index');
    }
}
