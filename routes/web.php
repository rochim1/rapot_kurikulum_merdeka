<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\RaporController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\TahunAjaranController;
use App\Http\Controllers\MataPelajaranController;
use App\Http\Controllers\EkstrakulikulerController;
use App\Http\Controllers\RapotController;

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
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['role:admin|walas'])->group(function () {
        Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');
        Route::get('/data-guru', [GuruController::class, 'index'])->name('data-guru');
        Route::get('/create-guru', [GuruController::class, 'create'])->name('create-guru');
        Route::post('/store-guru', [GuruController::class, 'store'])->name('store-guru');
        Route::get('/edit-guru/{id_guru}', [GuruController::class, 'edit'])->name('edit-guru');
        Route::post('/update-guru/{id_guru}', [GuruController::class, 'update'])->name('update-guru');
        Route::get('/delete-guru/{id_guru}', [GuruController::class, 'destroy'])->name('delete-guru');
        Route::get('/detile/{id_guru}', [GuruController::class, 'show'])->name('show-guru');
        Route::post('/import-guru', [GuruController::class, 'import'])->name('import-guru');
        Route::post('/guru/{id_guru}/update-status', [GuruController::class, 'updateStatus'])->name('update-status');
        Route::post('/guru/{id_guru}/update-wali-kelas', [GuruController::class, 'updateWaliKelas'])->name('guru.update_wali_kelas');


        Route::get('/home', [HomeController::class, 'index'])->name('home');

        Route::resource('/siswa', SiswaController::class);
        Route::post('/import_siswa', [SiswaController::class, 'import'])->name('import_siswa');

        Route::resource('/mata_pelajaran', MataPelajaranController::class);
        Route::post('/import_mata_pelajaran', [MataPelajaranController::class, 'import'])->name('import_mata_pelajaran');

        Route::resource('/kelas', KelasController::class);
        Route::post('/import_kelas', [KelasController::class, 'import'])->name('import_kelas');

        Route::resource('/tahun_ajaran', TahunAjaranController::class);
        Route::post('/import_tahun_ajaran', [TahunAjaranController::class, 'import'])->name('import_tahun_ajaran');

        Route::get('/rapot_nilai', [RapotController::class, 'nilai'])->name('rapot.nilai');
        Route::get('/rapot_kehadiran', [RapotController::class, 'kehadiran'])->name('rapot.kehadiran');
        Route::get('/rapot_ekstrakulikuler', [RapotController::class, 'ekstrakulikuler'])->name('rapot.ekstrakulikuler');
        Route::get('/rapot_catatan_wali_kelas', [RapotController::class, 'catatan_wali_kelas'])->name('rapot.catatan_wali_kelas');
        // Route::post('/import_rapor', [RapotController::class, 'import'])->name('import_rapor');
});

Route::middleware(['auth'],['role:admin'])->group(function () {
    Route::get('/data-guru', [GuruController::class, 'index'])->name('data-guru');
    Route::get('/create-guru', [GuruController::class, 'create'])->name('create-guru');
    Route::post('/store-guru', [GuruController::class, 'store'])->name('store-guru');
    Route::get('/edit-guru/{id_guru}', [GuruController::class, 'edit'])->name('edit-guru');
    Route::post('/update-guru/{id_guru}', [GuruController::class, 'update'])->name('update-guru');
    Route::get('/delete-guru/{id_guru}', [GuruController::class, 'destroy'])->name('delete-guru');
    Route::get('/detile/{id_guru}', [GuruController::class, 'show'])->name('show-guru');
    Route::post('/import-guru', [GuruController::class, 'import'])->name('import-guru');
    Route::post('/guru/{id_guru}/update-status', [GuruController::class, 'updateStatus'])->name('update-status');
    Route::post('/kelas/{id_kelas}/toggle-status', [KelasController::class, 'toggleStatus'])->name('kelas.toggleStatus');

    Route::get('/data-ekstrakulikuler', [EkstrakulikulerController::class, 'index'])->name('data-ekstrakulikuler');
    Route::get('/create-ekstrakulikuler', [EkstrakulikulerController::class, 'create'])->name('create-ekstrakulikuler');
    Route::post('/store-ekstrakulikuler', [EkstrakulikulerController::class, 'store'])->name('store-ekstrakulikuler');
    Route::get('/edit-ekstrakulikuler/{id_ekstrakulikuler}', [EkstrakulikulerController::class, 'edit'])->name('edit-ekstrakulikuler');
    Route::post('/update-ekstrakulikuler/{id_ekstrakulikuler}', [EkstrakulikulerController::class, 'update'])->name('update-ekstrakulikuler');
    Route::get('/delete-ekstrakulikuler/{id_ekstrakulikuler}', [EkstrakulikulerController::class, 'destroy'])->name('delete-ekstrakulikuler');


    Route::get('/home', [HomeController::class, 'index'])->name('home');
});