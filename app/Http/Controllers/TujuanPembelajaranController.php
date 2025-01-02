<?php
namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\TujuanPembelajaran;
use App\Models\MataPelajaran;
use App\Models\Kelas;
use App\Models\KelolaKelas;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class TujuanPembelajaranController extends Controller
{
    public function index()
    {
        $tujuanPembelajaran = TujuanPembelajaran::with(['mataPelajaran', 'kelas'])
            ->where('id_kelas', KelolaKelas::where('id_tahun_ajaran', session('id_tahun_ajaran'))
            ->where('id_guru', auth()->user()->id)
            ->value('id_kelas'))
            ->join('tb_mata_pelajaran', 'tb_mata_pelajaran.id_mata_pelajaran', '=', 'tb_tujuan_pembelajaran.id_mata_pelajaran')  // Join dengan tabel tb_mata_pelajaran
            ->orderBy('tb_mata_pelajaran.nama_mata_pelajaran', 'asc')  // Mengurutkan berdasarkan nama mata pelajaran
            ->get();
    
    

        return view('tujuan_pembelajaran.index', [
            'tujuanPembelajaran' => $tujuanPembelajaran,
            'title' => 'Tujuan Pembelajaran'
        ]);
    }

    public function create()
    {   
         $kelola_kelas = KelolaKelas::with('kelas')
            ->where('id_tahun_ajaran', session('id_tahun_ajaran'))
            ->where('id_guru', auth()->user()->id)
            ->get();
                
        $mataPelajaran = $kelola_kelas->map(function($kelola) {
            return MataPelajaran::where('kelompok', $kelola->kelas->fase)
                ->orderBy('nama_mata_pelajaran', 'asc')
                ->get();
        })->flatten();

        return view('tujuan_pembelajaran.create', [
            'title' => 'Tambah Tujuan Pembelajaran',
            'mataPelajaran' => $mataPelajaran,
            'kelas' => Kelas::orderBy('kelas_tingkatan', 'asc')->orderBy('kelas_abjad', 'asc')->get(),
        ]);
    }

    public function store(Request $request)
    {
        // Validasi inputan
        $validateData = $request->validate([
            'id_mata_pelajaran' => 'required|exists:tb_mata_pelajaran,id_mata_pelajaran',
            'tujuan_pembelajaran' => 'required|string',
        ]);

        $validateData['id_kelas'] = KelolaKelas::where('id_tahun_ajaran', session('id_tahun_ajaran'))->where('id_guru', auth()->user()->id)->value('id_kelas');
        $validateData['tujuan_pembelajaran_tercapai'] = 'Peserta Didik Mampu ' . $request->tujuan_pembelajaran;
        $validateData['tujuan_pembelajaran_tidak_tercapai'] = 'Peserta Didik Tidak Mampu ' . $request->tujuan_pembelajaran;

        TujuanPembelajaran::create($validateData);
        Alert::success('Kerja bagus', 'Tujuan Pembelajaran berhasil disimpan!');
        return redirect()->route('tujuan_pembelajaran.index');
    }

    public function show(TujuanPembelajaran $tujuanPembelajaran)
    {
        return view('tujuan_pembelajaran.show', [
            'title' => 'Detail Tujuan Pembelajaran',
            'tujuanPembelajaran' => $tujuanPembelajaran,
        ]);
    }

    public function edit(TujuanPembelajaran $tujuanPembelajaran)
    {
        $kelola_kelas = KelolaKelas::with('kelas')
        ->where('id_tahun_ajaran', session('id_tahun_ajaran'))
        ->where('id_guru', auth()->user()->id)
        ->get();
            
        $mataPelajaran = $kelola_kelas->map(function($kelola) {
            return MataPelajaran::where('kelompok', $kelola->kelas->fase)
                ->orderBy('nama_mata_pelajaran', 'asc')
                ->get();
        })->flatten();

        return view('tujuan_pembelajaran.edit', [
            'title' => 'Edit Tujuan Pembelajaran',
            'tujuanPembelajaran' => $tujuanPembelajaran,
            'mataPelajaran' => $mataPelajaran,
            'kelas' => Kelas::orderBy('kelas_tingkatan', 'asc')->orderBy('kelas_abjad', 'asc')->get(),
        ]);
    }

    public function update(Request $request, TujuanPembelajaran $tujuanPembelajaran)
    {
        // Validasi inputan
        $validateData = $request->validate([
            'id_mata_pelajaran' => 'required|exists:tb_mata_pelajaran,id_mata_pelajaran',
            'tujuan_pembelajaran' => 'required|string',
        ]);
        
        $validateData['id_kelas'] = KelolaKelas::where('id_tahun_ajaran', session('id_tahun_ajaran'))->where('id_guru', auth()->user()->id)->value('id_kelas');
        $validateData['tujuan_pembelajaran_tercapai'] = 'Peserta Didik Mampu ' . $request->tujuan_pembelajaran;
        $validateData['tujuan_pembelajaran_tidak_tercapai'] = 'Peserta Didik Tidak Mampu ' . $request->tujuan_pembelajaran;
        
        $tujuanPembelajaran->update($validateData);
        Alert::success('Kerja bagus', 'Tujuan Pembelajaran berhasil diperbarui!');
        return redirect()->route('tujuan_pembelajaran.index');
    }

    public function destroy(TujuanPembelajaran $tujuanPembelajaran)
    {
        $tujuanPembelajaran->delete();
        Alert::success('Kerja bagus', 'Tujuan Pembelajaran berhasil dihapus!');
        return redirect()->route('tujuan_pembelajaran.index');
    }

    /**
     * Update is_active status.
     */
    public function tujuan_pembelajaran_is_active(TujuanPembelajaran $tujuanPembelajaran)
    { 
        $tujuanPembelajaran->is_active == true 
            ? $tujuanPembelajaran->update(['is_active' => false]) 
            : $tujuanPembelajaran->update(['is_active' => true]);

        $tujuanPembelajaran->refresh();
        $status = $tujuanPembelajaran->is_active ? 'aktif' : 'nonaktif';

        Alert::success('Sukses', "Status tahun ajaran berhasil diperbarui menjadi $status!");
        return redirect()->route('tujuan_pembelajaran.index');
    }    
}
