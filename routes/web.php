<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Controllers\Auth\LogoutController;
<<<<<<< HEAD
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\MataPelajaranController;
use App\Http\Controllers\RaporController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\TahunAjaranController;
=======
use App\Http\Controllers\GuruController;
>>>>>>> 5bfc5a2e5ce1316aa323f8961c042faeae4905fc

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

Route::get('/login', function () {
    return view('auth.login')->name('login');
});

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');
<<<<<<< HEAD
    
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::resource('siswa', SiswaController::class);
    Route::resource('mata-pelajaran', MataPelajaranController::class);
    Route::resource('kelas', KelasController::class);
    Route::resource('tahun-ajaran', TahunAjaranController::class);
    Route::resource('rapor', RaporController::class);
=======
});

Route::middleware(['role:admin'])->group(function () {
    Route::get('/data-guru', [GuruController::class, 'index'])->name('data-guru');
<<<<<<< HEAD
>>>>>>> 5bfc5a2e5ce1316aa323f8961c042faeae4905fc
=======
    Route::get('/create-guru', [GuruController::class, 'create'])->name('create-guru');
    Route::post('/store-guru', [GuruController::class, 'store'])->name('store-guru');
    Route::get('/edit-guru/{id}', [GuruController::class, 'edit'])->name('edit-guru');
    Route::post('/update-guru/{id}', [GuruController::class, 'update'])->name('update-guru');
    Route::get('/delete-guru/{id}', [GuruController::class, 'destroy'])->name('delete-guru');
    Route::post('/import-guru', [GuruController::class, 'import'])->name('import-guru');
>>>>>>> 364947e07243c4897ba936eac5558762c249df7e
});