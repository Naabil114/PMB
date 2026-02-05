<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProdiController;
use App\Http\Controllers\YudisiumController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SesiUjianController;
use App\Http\Controllers\NilaiUjianController;
use App\Http\Controllers\RuangUjianController;
use App\Http\Controllers\JadwalUjianController;
use App\Http\Controllers\PeriodePenerimaanController;
use App\Http\Controllers\VerifikasiDokumenController;
use App\Http\Controllers\Auth\PendaftarAuthController;
use App\Http\Controllers\Mahasiswa\PendaftaranController;
use App\Http\Controllers\Mahasiswa\KartuPendaftaranController;
use App\Http\Controllers\Mahasiswa\PeriodePendaftaranController;

/*
|--------------------------------------------------------------------------
| HOME
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('layouts.landing.main');
});

/*
|--------------------------------------------------------------------------
| ROUTE LOGIN GLOBAL (WAJIB BIAR GA ERROR)
|--------------------------------------------------------------------------
*/
Route::get('/login', function () {
    return redirect()->route('pendaftar.login.form');
})->name('login');

/*
|--------------------------------------------------------------------------
| AUTH GUEST (BELUM LOGIN)
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {

    // ADMIN LOGIN
    Route::get('/admin/login', [AuthController::class, 'showLoginForm'])
        ->name('admin.login.form');
    Route::post('/admin/login', [AuthController::class, 'login'])
        ->name('admin.login');

    // PENDAFTAR LOGIN & REGISTER
    Route::get('/pendaftar/login', [PendaftarAuthController::class, 'formLogin'])
        ->name('pendaftar.login.form');
    Route::post('/pendaftar/login', [PendaftarAuthController::class, 'login'])
        ->name('pendaftar.login');

    Route::get('/pendaftar/register', [PendaftarAuthController::class, 'formRegister'])
        ->name('pendaftar.register.form');
    Route::post('/pendaftar/register', [PendaftarAuthController::class, 'register'])
        ->name('pendaftar.register');
});

/*
|--------------------------------------------------------------------------
| ADMIN AREA (GUARD: web)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    Route::post('/admin/logout', [AuthController::class, 'logout'])
        ->name('admin.logout');

    Route::get('/admin/dashboard', [DashboardController::class, 'index'])
        ->name('admin.dashboard');

    // USERS
    Route::get('/admin/verif/doc', [VerifikasiDokumenController::class, 'index'])->name('verifikasi.index');

    // halaman verifikasi dokumen (detail)
    Route::get(
        '/pendaftaran/{id}/verifikasi',
        [VerifikasiDokumenController::class, 'formVerifikasi']
    )->name('pendaftaran.verifikasi');

    // aksi simpan verifikasi (approve / reject)
    Route::post(
        '/pendaftaran/{id}/verifikasi',
        [VerifikasiDokumenController::class, 'simpanVerifikasi']
    )->name('pendaftaran.verifikasi.simpan');
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users/store', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/edit/{id}', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/update/{id}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/delete/{id}', [UserController::class, 'destroy'])->name('users.destroy');

    // PRODI
    Route::get('/prodi/index', [ProdiController::class, 'index'])->name('prodi.index');
    Route::get('/prodi/create', [ProdiController::class, 'create'])->name('prodi.create');
    Route::post('/prodi/store', [ProdiController::class, 'store'])->name('prodi.store');
    Route::get('/prodi/edit/{id}', [ProdiController::class, 'edit'])->name('prodi.edit');
    Route::put('/prodi/update/{id}', [ProdiController::class, 'update'])->name('prodi.update');
    Route::delete('/prodi/delete/{id}', [ProdiController::class, 'destroy'])->name('prodi.destroy');

    // PERIODE
    Route::get('/periode/index', [PeriodePenerimaanController::class, 'index'])->name('periode.index');
    Route::get('/periode/create', [PeriodePenerimaanController::class, 'create'])->name('periode.create');
    Route::post('/periode/store', [PeriodePenerimaanController::class, 'store'])->name('periode.store');
    Route::get('/periode/edit/{id}', [PeriodePenerimaanController::class, 'edit'])->name('periode.edit');
    Route::put('/periode/update/{id}', [PeriodePenerimaanController::class, 'update'])->name('periode.update');
    Route::delete('/periode/delete/{id}', [PeriodePenerimaanController::class, 'destroy'])->name('periode.destroy');

    // SESI UJIAN
    Route::get('/sesi-ujian/index', [SesiUjianController::class, 'index'])->name('sesi-ujian.index');
    Route::get('/sesi-ujian/create', [SesiUjianController::class, 'create'])->name('sesi-ujian.create');
    Route::post('/sesi-ujian/store', [SesiUjianController::class, 'store'])->name('sesi-ujian.store');
    Route::get('/sesi-ujian/edit/{id}', [SesiUjianController::class, 'edit'])->name('sesi-ujian.edit');
    Route::put('/sesi-ujian/update/{id}', [SesiUjianController::class, 'update'])->name('sesi-ujian.update');
    Route::delete('/sesi-ujian/delete/{id}', [SesiUjianController::class, 'destroy'])->name('sesi-ujian.destroy');

    // RUANG UJIAN
    Route::get('/ruang-ujian/index', [RuangUjianController::class, 'index'])->name('ruang-ujian.index');
    Route::get('/ruang-ujian/create', [RuangUjianController::class, 'create'])->name('ruang-ujian.create');
    Route::post('/ruang-ujian/store', [RuangUjianController::class, 'store'])->name('ruang-ujian.store');
    Route::get('/ruang-ujian/edit/{id}', [RuangUjianController::class, 'edit'])->name('ruang-ujian.edit');
    Route::put('/ruang-ujian/update/{id}', [RuangUjianController::class, 'update'])->name('ruang-ujian.update');
    Route::delete('/ruang-ujian/delete/{id}', [RuangUjianController::class, 'destroy'])->name('ruang-ujian.destroy');

    // JADWAL UJIAN
    Route::get('/jadwal-ujian/index', [JadwalUjianController::class, 'index'])->name('jadwal-ujian.index');
    Route::get('/jadwal-ujian/create', [JadwalUjianController::class, 'create'])->name('jadwal-ujian.create');
    Route::post('/jadwal-ujian/store', [JadwalUjianController::class, 'store'])->name('jadwal-ujian.store');
    Route::get('/jadwal-ujian/edit/{id}', [JadwalUjianController::class, 'edit'])->name('jadwal-ujian.edit');
    Route::put('/jadwal-ujian/update/{id}', [JadwalUjianController::class, 'update'])->name('jadwal-ujian.update');
    Route::delete('/jadwal-ujian/delete/{id}', [JadwalUjianController::class, 'destroy'])->name('jadwal-ujian.destroy');

    // NILAI
    Route::prefix('nilai-ujian')->group(function () {
        Route::get('/', [NilaiUjianController::class, 'index'])->name('nilai.index');
        Route::get('/template', [NilaiUjianController::class, 'downloadTemplate'])->name('nilai.template');
        Route::post('/import', [NilaiUjianController::class, 'import'])->name('nilai.import');
    });

    Route::get('/yudisium', [YudisiumController::class, 'index'])->name('yudisium.index');
});

/*
|--------------------------------------------------------------------------
| PENDAFTAR AREA (GUARD: pendaftar)
|--------------------------------------------------------------------------
*/
Route::middleware('auth:pendaftar')->group(function () {

    Route::get('/pendaftar/dashboard', fn () => view('pendaftar.dashboard'))
        ->name('pendaftar.dashboard');

    Route::get('/mahasiswa/periode/index', [PeriodePendaftaranController::class, 'index'])
        ->name('mahasiswa.periode.index');

    Route::prefix('pendaftaran')->group(function () {

        Route::get('{periode}/step-1', [PendaftaranController::class, 'step1'])->name('pendaftaran.step1');
        Route::post('step-1', [PendaftaranController::class, 'storeStep1'])->name('pendaftaran.step1.store');

        Route::get('step-2/{id}', [PendaftaranController::class, 'step2'])->name('pendaftaran.step2');
        Route::post('step-2/{id}', [PendaftaranController::class, 'storeStep2'])->name('pendaftaran.step2.store');

        Route::get('step-3/{id}', [PendaftaranController::class, 'step3'])->name('pendaftaran.step3');
        Route::post('step-3/{id}', [PendaftaranController::class, 'storeStep3'])->name('pendaftaran.step3.store');

        Route::get('step-4/{id}', [PendaftaranController::class, 'step4'])->name('pendaftaran.step4');
        Route::post('step-4/{id}', [PendaftaranController::class, 'storeStep4'])->name('pendaftaran.step4.store');

        Route::get('review/{id}', [PendaftaranController::class, 'review'])->name('pendaftaran.review');
        Route::post('submit/{id}', [PendaftaranController::class, 'submit'])->name('pendaftaran.submit');
    });

    Route::get('/pendaftaran/{periode}/kartu', [KartuPendaftaranController::class, 'cetak'])
        ->name('pendaftaran.kartu');
    Route::post('/pendaftar/logout', [PendaftarAuthController::class, 'logout'])
        ->name('pendaftar.logout');

    Route::get('/pendaftar/verifikasi/dokumen', [VerifikasiDokumenController::class, 'dokumenPendaftar'])
        ->name('pendaftar.verifikasi.index');

        Route::get('pendaftaran/{id}/upload-ulang', [VerifikasiDokumenController::class, 'formUploadUlang'])
        ->name('pendaftaran.uploadUlang');

    // Route proses upload ulang
    Route::post('pendaftaran/{id}/upload-ulang', [VerifikasiDokumenController::class, 'prosesUploadUlang'])
        ->name('pendaftaran.prosesUploadUlang');
});
