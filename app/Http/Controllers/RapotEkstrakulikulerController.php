<?php

namespace App\Http\Controllers;

use App\Models\Ekstrakulikuler;
use App\Models\KelolaKelas;
use App\Models\ProfilSekolah;
use App\Models\Rapot;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class RapotEkstrakulikulerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kelola_kelas = KelolaKelas::with('kelas', 'TahunAjaran')
            ->where('id_tahun_ajaran', session('id_tahun_ajaran'))
            ->where('id_guru', session('id_guru'))
            ->get();

        $ekstrakulikuler = Ekstrakulikuler::all();

        $kelola_kelas->each(function ($kelola) {
            $kelola->siswa = Siswa::whereIn('id_siswa', $kelola->daftar_id_siswa)->where('status', 'active')->get();

            $kelola->siswa->each(function ($siswa) use ($kelola) {
                $siswa->rapot = DB::table('tb_rapot')
                    ->where('id_kelas', $kelola->id_kelas)
                    ->where('id_tahun_ajaran', session('id_tahun_ajaran'))
                    ->where('id_siswa', $siswa->id_siswa)
                    ->first();

                if ($siswa->rapot) {
                    $siswa->ekstrakulikuler = DB::table('tb_rapot_ekstrakulikuler')
                        ->where('id_rapot', $siswa->rapot->id_rapot)
                        ->get();
                }
            });
        });
        
        $title = 'Rapot';
        return view('rapot.ekstrakulikuler.index', compact('kelola_kelas', 'title', 'ekstrakulikuler'));
    }


    public function storeOrUpdate(Request $request)
    {
        // Validate input data
        $validatedData = $request->validate([
            'id_siswa' => 'required|array',
            'id_ekstrakulikuler' => 'nullable|array',
            'predikat_ekstrakulikuler' => 'nullable|array',
            'catatan_ekstrakulikuler' => 'nullable|array',
            'id_ekstrakulikuler.*' => 'nullable|array', // Nested array validation
            'predikat_ekstrakulikuler.*' => 'nullable|array', // Nested array validation
            'catatan_ekstrakulikuler.*' => 'nullable|array', // Nested array validation
        ]);

        // Map the data to an array of objects
        $mappedData = array_map(function ($siswa_id) use ($validatedData) {
            // Loop through each id_ekstrakulikuler for the given siswa_id
            $ekstrakulikulerData = [];
            // Ensure id_ekstrakulikuler is set for this siswa_id
            if (isset($validatedData['id_ekstrakulikuler'][$siswa_id])) {
                foreach ($validatedData['id_ekstrakulikuler'][$siswa_id] as $ekstrakulikuler_id => $ekstrakulikuler) {
                    $ekstrakulikulerData[] = (object) [
                        'id_ekstrakulikuler' => $ekstrakulikuler_id,
                        'nama_ekstrakulikuler' => $ekstrakulikuler,
                        'predikat_ekstrakulikuler' => $validatedData['predikat_ekstrakulikuler'][$siswa_id][$ekstrakulikuler_id] ?? null,
                        'catatan_ekstrakulikuler' => $validatedData['catatan_ekstrakulikuler'][$siswa_id][$ekstrakulikuler_id] ?? null,
                    ];
                }
            }

            // Return the student object with all the relevant data
            return (object) [
                'id_siswa' => $siswa_id,
                'nilai' => $ekstrakulikulerData,
            ];
        }, $validatedData['id_siswa']);

        // Fetch the class and teacher details
        $kelola_kelas = KelolaKelas::with('kelas', 'guru', 'tahunAjaran')
            ->where('id_tahun_ajaran', session('id_tahun_ajaran'))
            ->where('id_guru', session('id_guru'))
            ->first();

        // Fetch school profile data
        $profilSekolah = ProfilSekolah::find(1);

        // Loop over each student
        foreach ($mappedData as $data_ekstrakulikuler_each_siswa) {
            // Create or update the Rapot record for the student
            $rapot = Rapot::updateOrCreate(
                [
                    'id_kelas' => $kelola_kelas->id_kelas,
                    'id_tahun_ajaran' => $kelola_kelas->id_tahun_ajaran,
                    'id_siswa' => $data_ekstrakulikuler_each_siswa->id_siswa,
                    'id_guru' => $kelola_kelas->id_guru,
                ],
                [
                    'nama_kepsek' => $profilSekolah->nama_kepsek,
                    'nip_kepsek' => $profilSekolah->nip_kepsek,
                ]
            );

            // Loop over the extracurricular activities for each student
            foreach ($data_ekstrakulikuler_each_siswa->nilai as $ekstrakulikuler) {
                // Insert or update extracurricular data
                DB::table('tb_rapot_ekstrakulikuler')->updateOrInsert(
                    [
                        'id_rapot' => $rapot->id_rapot,
                        'id_ekstrakulikuler' => $ekstrakulikuler->id_ekstrakulikuler,
                    ],
                    [
                        'catatan_ekstrakulikuler' => $ekstrakulikuler->catatan_ekstrakulikuler ?? null,
                        'predikat_ekstrakulikuler' => $ekstrakulikuler->predikat_ekstrakulikuler ?? null,
                    ]
                );
            }
        }

        // Show a success message and redirect
        Alert::success('Success', 'Data berhasil disimpan!');
        return redirect()->route('rapot_ekstrakulikuler.index');
    }
}
