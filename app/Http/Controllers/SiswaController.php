<?php

namespace App\Http\Controllers;

use App\Imports\SiswaImport;
use App\Models\KelolaKelas;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kelola_kelas = KelolaKelas::with('kelas','guru')
            ->where('id_tahun_ajaran', session('id_tahun_ajaran'))
            ->where('id_guru', auth()->user()->id)
            ->first();
            
        $query = DB::table('tb_siswa');
        if($kelola_kelas?->guru?->is_wali_kelas) {
            $query->whereIn('id_siswa', $kelola_kelas->daftar_id_siswa);
        }

        return view('siswa.index', [
            'siswa' => $query->paginate(10), 
            'title' => 'Siswa'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('siswa.create', [
            'title' => 'siswa'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'nama' => 'required|max:100',
            'nis' => 'required|unique:tb_siswa,nis',
            'nisn' => 'nullable|unique:tb_siswa,nisn',
            'tempat_lahir' => 'nullable|max:50',
            'tanggal_lahir' => 'nullable|date',
            'jk' => 'required|in:Laki-Laki,Perempuan',
            'agama' => 'nullable|max:50',
            'nama_ayah' => 'nullable|max:100',
            'nama_ibu' => 'nullable|max:100',
            'no_telp_ortu' => 'nullable|max:100',
            'alamat' => 'nullable',
            'foto' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'status' => 'required|in:active,berhenti,mutasi,lulus',
        ]);

        if ($request->file('foto')) {
            if ($request->foto) {
                $validateData['foto'] = Storage::put('foto-siswa', $request->file('foto'));
            }
        }

        Siswa::create($validateData);

        Alert::success('kerja bagus', 'Data berhasil disimpan!');
        return redirect()->route('siswa.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Siswa $siswa)
    {
        return view('siswa.show', [
            'title' => 'siswa',
            'siswa' => $siswa,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Siswa $siswa)
    {
        return view('siswa.edit', [
            'title' => 'siswa',
            'siswa' => $siswa,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Siswa $siswa)
    {
        $validateData = $request->validate([
            'nama' => 'required|max:100',
            'nis' => 'required',
            'nisn' => 'nullable',
            'tempat_lahir' => 'nullable|max:50',
            'tanggal_lahir' => 'nullable|date',
            'jk' => 'required|in:Laki-Laki,Perempuan',
            'agama' => 'nullable|max:50',
            'nama_ayah' => 'nullable|max:100',
            'nama_ibu' => 'nullable|max:100',
            'no_telp_ortu' => 'nullable|max:100',
            'alamat' => 'nullable',
            'foto' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'status' => 'required|in:active,berhenti,mutasi,lulus',
        ]);

        if ($request->file('foto')) {
            if ($request->foto) {
                if (Storage::exists($siswa->foto)) {
                    Storage::delete($siswa->foto);
                }
                $validateData['foto'] = Storage::put('foto-siswa', $request->file('foto'));
            }
        }

        $siswa->update($validateData);
        Alert::success('kerja bagus', 'Data berhasil disimpan!');
        return redirect()->route('siswa.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Siswa $siswa)
    {
        if ($siswa->foto) {
            if (Storage::exists($siswa->foto)) {
                Storage::delete($siswa->foto);
            }
        }

        $siswa->delete();
        Alert::success('kerja bagus', 'Data berhasil dihapus!');
        return redirect()->route('siswa.index');
    }

    public function import_siswa(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv,ods'
        ]);
        
        try {
            Excel::import(new SiswaImport, $request->file('file'));
            Alert::success('kerja bagus', 'Data berhasil diimport!');        
            return redirect()->route('siswa.index');
        } catch (\Exception $e) {
            Alert::error('Terjadi kesalahan saat mengimport data', $e->getMessage());        
            return redirect()->route('siswa.index');
        }
    }

    // Wali Kelas
    public function wali_kelas_tampil_siswa()
    {

        $id_kelas = 1;
        $id_tahun_ajaran = 1;
        $siswa = Siswa::join('tb_ambil_kelas', 'tb_siswa.id_siswa', '=', 'tb_ambil_kelas.id_siswa')
            ->join('tb_siswa_tahun_ajaran', 'tb_siswa.id_siswa', '=', 'tb_siswa_tahun_ajaran.id_siswa')
            ->where('tb_ambil_kelas.id_kelas', $id_kelas)
            ->where('tb_siswa_tahun_ajaran.id_tahun_ajaran', $id_tahun_ajaran)
            ->select('tb_siswa.id_siswa', 'tb_siswa.nama', 'tb_siswa.nis', 'tb_siswa.nisn')
            ->get();

        return view('rapot.nilai', [
            'title' => 'Siswa',
            'siswa' => $siswa,
        ]);
    }
}
