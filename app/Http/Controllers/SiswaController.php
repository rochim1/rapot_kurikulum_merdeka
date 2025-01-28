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
        $kelola_kelas = KelolaKelas::with('kelas', 'guru')
            ->where('id_tahun_ajaran', session('id_tahun_ajaran'))
            ->where('id_guru', session('id_guru'))
            ->first();

        $query = DB::table('tb_siswa');
        if ($kelola_kelas?->guru?->is_wali_kelas) {
            $query->whereIn('id_siswa', $kelola_kelas->daftar_id_siswa);
        }

        if (request()->filled('nama')) {
            $query->where('nama', 'like', '%' . request('nama') . '%');
        }

        if (request()->filled('nis')) {
            $query->where('nis', 'like', '%' . request('nis') . '%');
        }

        if (request()->filled('nisn')) {
            $query->where('nisn', 'like', '%' . request('nisn') . '%');
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
        if ($request->has('repeat')) {
            Alert::success('Kerja Bagus', 'Data berhasil ditambahkan, silakan tambahkan data baru.');
            return back();
        }
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
        // Validate the file input with custom messages
        $request->validate([
            'file' => 'required|mimes:xlsx,csv,ods',
        ], [
            'file.required' => 'File wajib diunggah.',
            'file.mimes' => 'Format file harus berupa xlsx, csv, atau ods.',
        ]);

        try {
            // Count inserted rows using a variable passed to the import class
            $import = new SiswaImport();
            Excel::import($import, $request->file('file'));

            $rowCount = $import->getRowCount();

            if ($rowCount > 0) {
                // Success alert with the count of inserted rows
                Alert::success('Kerja bagus', "Data berhasil diimport! Total baris: $rowCount");
            } else {
                // Alert for no rows imported
                Alert::info('Tidak ada data', 'File berhasil diunggah tetapi tidak ada data yang diimport.');
            }
        } catch (\Exception $e) {
            // Log the error for debugging
            // \Log::error('Error importing siswa data: ' . $e->getMessage());

            // Error alert
            Alert::error('Terjadi kesalahan', 'Kesalahan saat mengimport data: ' . $e->getMessage());
        }

        // Redirect back to the siswa index page
        return redirect()->route('siswa.index');
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
