<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KelolaKelasController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DataProjekController;
use App\Http\Controllers\DataProjekTargetCapaianController;
use App\Http\Controllers\TahunAjaranController;
use App\Http\Controllers\MataPelajaranController;
use App\Http\Controllers\EkstrakulikulerController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\KelompokProjekController;
use App\Http\Controllers\KelompokProjekDataProjekController;
use App\Http\Controllers\ProfilSekolahController;
use App\Http\Controllers\RapotCatatanWaliKelasController;
use App\Http\Controllers\RapotCetakController;
use App\Http\Controllers\RapotEkstrakulikulerController;
use App\Http\Controllers\RapotKehadiranController;
use App\Http\Controllers\RapotNaikKelasController;
use App\Http\Controllers\RapotNilaiController;
use App\Http\Controllers\RapotP5CapaianProjekController;
use App\Http\Controllers\RapotP5CatatanProsesProjekController;
use App\Http\Controllers\RapotP5Controller;
use App\Http\Controllers\RapotTtdController;
use App\Http\Controllers\TargetCapaianController;
use App\Http\Controllers\TujuanPembelajaranController;
use App\Http\Controllers\UserProfilController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate']);

Route::middleware(['role:admin|walas'])->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    Route::get('/profil', [UserProfilController::class, 'profilAdmin'])->name('profil_user.index');
    Route::post('/update_profil', [UserProfilController::class, 'updateProfilUser'])->name('profil_user.update');

    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::resource('/siswa', SiswaController::class);
    Route::resource('/ekstrakulikuler', EkstrakulikulerController::class);
    Route::resource('/mata_pelajaran', MataPelajaranController::class);
    Route::resource('/mata_pelajaran', MataPelajaranController::class);
});

Route::middleware(['role:admin'])->group(function () {
    Route::resource('kelas', KelasController::class);
    Route::get('/data-guru', [GuruController::class, 'index'])->name('data-guru');
    Route::get('/create-guru', [GuruController::class, 'create'])->name('create-guru');
    Route::post('/store-guru', [GuruController::class, 'store'])->name('store-guru');
    Route::get('/edit-guru/{id_guru}', [GuruController::class, 'edit'])->name('edit-guru');
    Route::post('/update-guru/{id_guru}', [GuruController::class, 'update'])->name('update-guru');
    Route::post('/delete-guru/{id_guru}', [GuruController::class, 'destroy'])->name('delete-guru');
    Route::get('/detile/{id_guru}', [GuruController::class, 'show'])->name('show-guru');
    Route::post('/import-guru', [GuruController::class, 'import'])->name('import-guru');
    Route::post('/guru/{id_guru}/update-status', [GuruController::class, 'updateStatus'])->name('update-status');
    Route::post('/guru/{id_guru}/update-wali-kelas', [GuruController::class, 'updateWaliKelas'])->name('guru.update_wali_kelas');
    Route::resource('/kelola_kelas', KelolaKelasController::class);

    Route::post('/import_kelola_kelas', [KelolaKelasController::class, 'import'])->name('import_kelola_kelas');
    Route::post('/toggleStatus', [KelolaKelasController::class, 'import'])->name('kelas.toggleStatus');
    Route::get('/data-ekstrakulikuler', [EkstrakulikulerController::class, 'index'])->name('data-ekstrakulikuler');
    Route::get('/create-ekstrakulikuler', [EkstrakulikulerController::class, 'create'])->name('create-ekstrakulikuler');
    Route::post('/store-ekstrakulikuler', [EkstrakulikulerController::class, 'store'])->name('store-ekstrakulikuler');
    Route::get('/edit-ekstrakulikuler/{id_ekstrakulikuler}', [EkstrakulikulerController::class, 'edit'])->name('edit-ekstrakulikuler');
    Route::post('/update-ekstrakulikuler/{id_ekstrakulikuler}', [EkstrakulikulerController::class, 'update'])->name('update-ekstrakulikuler');
    Route::get('/delete-ekstrakulikuler/{id_ekstrakulikuler}', [EkstrakulikulerController::class, 'destroy'])->name('delete-ekstrakulikuler');
    // user
    Route::post('/import_siswa', [SiswaController::class, 'import_siswa'])->name('import_siswa');
    Route::post('/import_mata_pelajaran', [MataPelajaranController::class, 'import_mata_pelajaran'])->name('import_mata_pelajaran');

    Route::resource('kelas', KelasController::class);
    Route::post('/import_kelas', [KelasController::class, 'import_kelas'])->name('import_kelas');

    Route::resource('/tahun_ajaran', TahunAjaranController::class);
    Route::post('/import_tahun_ajaran', [TahunAjaranController::class, 'import_tahun_ajaran'])->name('import_tahun_ajaran');
    Route::put('/tahun_ajaran_is_active/{tahunAjaran}', [TahunAjaranController::class, 'tahun_ajaran_is_active'])->name('tahun_ajaran_is_active');

    Route::resource('/profil_sekolah', ProfilSekolahController::class);

    Route::resource('/profil_sekolah', ProfilSekolahController::class);

    Route::resource('/target_capaian', TargetCapaianController::class);
    Route::post('/import_target_capaian', [TargetCapaianController::class, 'import_target_capaian'])->name('import_target_capaian');

    Route::resource('/data_projek', DataProjekController::class);
    Route::resource('/data_projek_target_capaian', DataProjekTargetCapaianController::class);

    Route::resource('/kelompok_projek', KelompokProjekController::class);
    Route::resource('/kelompok_projek_data_projek', KelompokProjekDataProjekController::class);
});

Route::middleware(['role:walas'])->group(function () {
    Route::resource('tujuan_pembelajaran', TujuanPembelajaranController::class);
    Route::put('/tujuan_pembelajaran_is_active/{tujuanPembelajaran}', [TujuanPembelajaranController::class, 'tujuan_pembelajaran_is_active'])->name('tujuan_pembelajaran_is_active');

    Route::get('rapot_nilai', [RapotNilaiController::class, 'index'])->name('rapot_nilai.index');
    Route::get('/rapot_nilai/editOrCreate', [RapotNilaiController::class, 'editOrCreate'])->name('rapot_nilai.editOrCreate');
    Route::post('/rapot_nilai/storeOrUpdate', [RapotNilaiController::class, 'storeOrUpdate'])->name('rapot_nilai.storeOrUpdate');

    Route::get('/rapot_ekstrakulikuler', [RapotEkstrakulikulerController::class, 'index'])->name('rapot_ekstrakulikuler.index');
    Route::post('/rapot_ekstrakulikuler/storeOrUpdate', [RapotEkstrakulikulerController::class, 'storeOrUpdate'])->name('rapot_ekstrakulikuler.storeOrUpdate');

    Route::get('/rapot_kehadiran', [RapotKehadiranController::class, 'index'])->name('rapot_kehadiran.index');
    Route::post('/rapot_kehadiran/storeOrUpdate', [RapotKehadiranController::class, 'storeOrUpdate'])->name('rapot_kehadiran.storeOrUpdate');

    Route::get('/rapot_catatan_wali_kelas', [RapotCatatanWaliKelasController::class, 'index'])->name('rapot_catatan_wali_kelas.index');
    Route::post('/rapot_catatan_wali_kelas/storeOrUpdate', [RapotCatatanWaliKelasController::class, 'storeOrUpdate'])->name('rapot_catatan_wali_kelas.storeOrUpdate');

    Route::get('/rapot_naik_kelas', [RapotNaikKelasController::class, 'index'])->name('rapot_naik_kelas.index');
    Route::post('/rapot_naik_kelas/storeOrUpdate', [RapotNaikKelasController::class, 'storeOrUpdate'])->name('rapot_naik_kelas.storeOrUpdate');

    Route::get('/rapot_ttd', [RapotTtdController::class, 'index'])->name('rapot_ttd.index');
    Route::post('/rapot_ttd/storeOrUpdate', [RapotTtdController::class, 'storeOrUpdate'])->name('rapot_ttd.storeOrUpdate');

    Route::get('/rapot_cetak', [RapotCetakController::class, 'index'])->name('rapot_cetak.index');
    Route::get('/rapot_cetak_export_pdf', [RapotCetakController::class, 'export_pdf'])->name('rapot_cetak.export_pdf');

        Route::resource('rapot_p5_capaian_projek', RapotP5CapaianProjekController::class);

        Route::get('/rapot_p5_catatan_proses_projek', [RapotP5CatatanProsesProjekController::class, 'index'])->name('rapot_p5_catatan_proses_projek.index');
        Route::post('/rapot_p5_catatan_proses_projek', [RapotP5CatatanProsesProjekController::class, 'store'])->name('rapot_p5_catatan_proses_projek.store');

    // Route::get('/rapot_p5_cetak', [RapotP5Controller::class, 'index'])->name('rapot_p5_cetak.index');
    // Route::post('/rapot_p5_cetak/storeOrUpdate', [RapotP5Controller::class, 'storeOrUpdate'])->name('rapot_p5_cetak.storeOrUpdate');
});
