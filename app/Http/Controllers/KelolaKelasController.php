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
        $kelolaKelas = KelolaKelas::with(['guru.user', 'tahunAjaran', 'kelas'])->paginate(10);
        return view('kelola_kelas.index', [
            'kelolaKelas' => $kelolaKelas,
            'title' => 'Kelola Kelas'
        ]);
    }

    public function create(Request $request)
    {
        // Mengambil data guru, kelas, dan tahun ajaran
        $guru = Guru::with('user')->where('status', '=', 'Aktif')->orderBy('updated_at', 'asc')->get();
        $kelas = Kelas::orderBy('kelas_tingkatan', 'asc')->orderBy('kelas_abjad', 'asc')->get();
        $tahunAjaran = TahunAjaran::orderBy('tahun_ajaran_awal', 'desc')->get();
        $title = 'Kelola Kelas';

        // Retrieve selected student IDs from the request, defaulting to an empty array
        $id_siswa = $request->input('id_siswa', []);

        // Decode the JSON string for unselected students into an array
        $id_siswa_removed = json_decode($request->input('unselected_students', '[]'), true);

        // Ensure both selected and unselected are arrays
        $id_siswa = is_array($id_siswa) ? $id_siswa : [];
        $id_siswa_removed = is_array($id_siswa_removed) ? $id_siswa_removed : [];

        // Retrieve the existing selected students from the session, defaulting to an empty array
        $existing_selected_students = session('selected_students', []);

        // Merge the new selected IDs with the existing ones, ensuring uniqueness
        $merged_selected_students = array_unique(array_merge($existing_selected_students, $id_siswa));

        // Remove the unselected student IDs from the merged list
        $final_selected_students = array_diff($merged_selected_students, $id_siswa_removed);

        // Store the final list back in the session
        session()->put('selected_students', $final_selected_students);

        if ($request->filled('submit_action') && $request->input('submit_action') == 'true') {
            $result = $this->storeKelolaKelas([
                "id_guru" => $request->input('id_guru'),
                "id_tahun_ajaran" => $request->input('id_tahun_ajaran_tujuan'),
                "id_kelas" => $request->input('id_kelas_tujuan'),
                'daftar_id_siswa' => $final_selected_students
            ]);

            return redirect()->route('kelola_kelas.index');
        }

        $siswa = [];
        if ($request->has('id_kelas')) {
            $id_kelas = $request->input('id_kelas');
            if ($id_kelas === 'not_registered') {
                // Ambil siswa yang belum terdaftar di kelas manapun
                $siswaTerdaftarIds = KelolaKelas::select('daftar_id_siswa')
                    ->get()
                    ->flatMap(function ($item) {
                        // Ensure daftar_id_siswa is a valid JSON string
                        if (is_string($item->daftar_id_siswa)) {
                            return json_decode($item->daftar_id_siswa, true) ?? [];
                        }
                        return []; // Return an empty array if it's not a string or invalid
                    })
                    ->unique();


                $siswa = Siswa::whereNotIn('id_siswa', $siswaTerdaftarIds)->get();
            } else {
                // Ambil siswa yang sudah terdaftar di kelas
                $query = KelolaKelas::query();

                if ($request->filled('id_tahun_ajaran')) {
                    $query->where('id_tahun_ajaran', $request->input('id_tahun_ajaran'));
                }

                if ($request->filled('id_kelas')) {
                    $query->where('id_kelas', $id_kelas);
                }

                $kelolaKelas = $query->first();
                if ($kelolaKelas) {
                    $siswaIds = is_string($kelolaKelas->daftar_id_siswa)
                        ? json_decode($kelolaKelas->daftar_id_siswa, true)
                        : (is_array($kelolaKelas->daftar_id_siswa) ? $kelolaKelas->daftar_id_siswa : []);


                    $siswa = Siswa::whereIn('id_siswa', $siswaIds)->get();
                }
            }
        }

        return view('kelola_kelas.create', compact('guru', 'kelas', 'tahunAjaran', 'siswa', 'title'));
    }

    private function storeKelolaKelas($input)
    {
        $result = KelolaKelas::create($input);
        Alert::success('Kerja bagus', 'Kelas berhasil disimpan!');
        session()->forget('selected_students');
        return $result;
    }

    /**
     * TIDAK DIPAKAI == TIDAK DIPAKAI == TIDAK DIPAKAI == TIDAK DIPAKAI == TIDAK DIPAKAI == TIDAK DIPAKAI == 
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // tidak dipakai
    }

    /**
     * Display the specified resource.
     */
    public function show(KelolaKelas $kelas)
    {
        // 
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(KelolaKelas $kelola_kela, Request $request)
    {
        // Fetch data for the form
        $guru = Guru::with('user')->where('status', '=', 'Aktif')->orderBy('updated_at', 'asc')->get();
        $kelas = Kelas::orderBy('kelas_tingkatan', 'asc')->orderBy('kelas_abjad', 'asc')->get();
        $tahunAjaran = TahunAjaran::orderBy('tahun_ajaran_awal', 'desc')->get();
        $title = 'Edit Kelola Kelas';

        // Decode the JSON-encoded daftar_id_siswa for the current KelolaKelas instance
        $selected_students = is_string($kelola_kela->daftar_id_siswa)
            ? json_decode($kelola_kela->daftar_id_siswa, true)
            : ($kelola_kela->daftar_id_siswa ?? []);


        // Save the selected students in the session for tracking changes
        // session()->put('selected_students', $selected_students);

        // Fetch the students assigned to the current KelolaKelas instance
        $siswa = [];
        if ($kelola_kela->id_kelas) {
            $siswa = Siswa::whereIn('id_siswa', $selected_students)->get();
        }

        $kelolakelas = $kelola_kela;

        // Retrieve selected student IDs from the request, defaulting to an empty array
        $id_siswa = $request->input('id_siswa', []);

        // Decode the JSON string for unselected students into an array
        $id_siswa_removed = json_decode($request->input('unselected_students', '[]'), true);

        // Ensure both selected and unselected are arrays
        $id_siswa = is_array($id_siswa) ? $id_siswa : [];
        $id_siswa_removed = is_array($id_siswa_removed) ? $id_siswa_removed : [];

        // Retrieve the existing selected students from the session, defaulting to an empty array
        $existing_selected_students = session('selected_students', []);

        // Merge the new selected IDs with the existing ones, ensuring uniqueness
        $merged_selected_students = array_unique(array_merge($existing_selected_students, $id_siswa));

        // Remove the unselected student IDs from the merged list
        $final_selected_students = array_diff($merged_selected_students, $id_siswa_removed);
        
        // Store the final list back in the session
        session()->put('selected_students', $final_selected_students);

        if ($request->filled('submit_action') && $request->input('submit_action') == 'true') {
            $result = $this->updateKelolaKelas([
                "id_guru" => $request->input('id_guru'),
                "id_tahun_ajaran" => $request->input('id_tahun_ajaran_tujuan'),
                "id_kelas" => $request->input('id_kelas_tujuan'),
                'daftar_id_siswa' => $final_selected_students
            ], $kelolakelas->id_kelola_kelas);

            return redirect()->route('kelola_kelas.index');
        }

        $searchSiswa = [];
        if ($request->has('id_kelas')) {
            $id_kelas = $request->input('id_kelas');
            if ($id_kelas === 'not_registered') {
                // Ambil siswa yang belum terdaftar di kelas manapun
                $siswaTerdaftarIds = KelolaKelas::select('daftar_id_siswa')
                    ->get()
                    ->flatMap(function ($item) {
                        // Ensure daftar_id_siswa is a valid JSON string
                        if (is_string($item->daftar_id_siswa)) {
                            return json_decode($item->daftar_id_siswa, true) ?? [];
                        }
                        return []; // Return an empty array if it's not a string or invalid
                    })
                    ->unique();


                $searchSiswa = Siswa::whereNotIn('id_siswa', $siswaTerdaftarIds)->get();
            } else {
                // Ambil siswa yang sudah terdaftar di kelas
                $query = KelolaKelas::query();

                if ($request->filled('id_tahun_ajaran')) {
                    $query->where('id_tahun_ajaran', $request->input('id_tahun_ajaran'));
                }

                if ($request->filled('id_kelas')) {
                    $query->where('id_kelas', $id_kelas);
                }

                $kelolaKelas = $query->first();
                if ($kelolaKelas) {
                    $siswaIds = is_string($kelolaKelas->daftar_id_siswa)
                        ? json_decode($kelolaKelas->daftar_id_siswa, true)
                        : (is_array($kelolaKelas->daftar_id_siswa) ? $kelolaKelas->daftar_id_siswa : []);


                    $searchSiswa = Siswa::whereIn('id_siswa', $siswaIds)->get();
                }
            }
        }

        return view('kelola_kelas.edit', compact('guru', 'kelas', 'tahunAjaran', 'siswa', 'title', 'kelolakelas', 'searchSiswa'));
    }

    private function updateKelolaKelas($input, $id)
    {
        $kelolaKelas = KelolaKelas::findOrFail($id);

        // Update the record with the provided input
        $result = $kelolaKelas->update($input);

        Alert::success('Kerja bagus', 'Kelas berhasil diupdate!');
        session()->forget('selected_students');
        return $result;
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id_kelas)
    {
        // Ambil data kelas berdasarkan ID kelas
        $kelas = KelolaKelas::findOrFail($id_kelas); // Mengambil kelas berdasarkan ID kelas
        dd($kelas);
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
