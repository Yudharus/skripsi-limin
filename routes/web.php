<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\AdminController;

Route::get('/', function () {
    return view('welcome');
});
// Route::get('/login', function () {
//     return view('login');
// });


Route::get('/login', [AdminController::class, 'index'])->name('index');
Route::post('/login', [AdminController::class, 'login'])->name('login');
Route::get('/home', [AdminController::class, 'home']);
Route::post('/logout', [AdminController::class, 'logout'])->name('logout');

Route::get('/jadwal-dokter', [DokterController::class, 'index']);
Route::get('/pendaftaran-pasien', [PasienController::class, 'index'])->name('index');
Route::post('/pendaftaran-pasien/store', [PasienController::class, 'store'])->name('store');

Route::get('/verifikasi-pendaftaran', [PasienController::class, 'verifikasiPendaftaran'])->name('verifikasi.pendaftaran');
Route::put('/verifikasi-pendaftaran/{id}', [PasienController::class, 'updateStatus'])->name('verifikasi.updateStatus');

Route::get('/data-pasien', [PasienController::class, 'dataPasien'])->name('data.pasien');
Route::get('/data-pasien/{id}', [PasienController::class, 'show'])->name('show.data.pasien');
Route::post('/data-pasien/update', [PasienController::class, 'update'])->name('update.data.pasien');
Route::post('/data-pasien/store', [PasienController::class, 'storeDataPasien'])->name('data-pasien.store');

Route::get('/data-pasien-dokter', [PasienController::class, 'dataPasienDokter'])->name('data.pasien.dokter');
Route::get('/data-pasien-dokter/{id}', [PasienController::class, 'show'])->name('show.data.pasien.dokter');

Route::get('/data-petugas', [AdminController::class, 'dataPetugas'])->name('data.petugas');
Route::get('/data-petugas/{id}', [AdminController::class, 'show'])->name('show.data.petugas');
Route::post('/data-petugas/update', [AdminController::class, 'update'])->name('update.data.petugas');
Route::post('/data-petugas/store', [AdminController::class, 'storeDataPetugas'])->name('data-petugas.store');
Route::delete('/data-petugas/{id}', [AdminController::class, 'destroy']);

Route::get('/data-dokter', [DokterController::class, 'dataDokter'])->name('data.dokter');
Route::get('/data-dokter/{id}', [DokterController::class, 'show'])->name('show.data.dokter');
Route::post('/data-dokter/update', [DokterController::class, 'update'])->name('update.data.dokter');
Route::post('/data-dokter/store', [DokterController::class, 'storeDataDokter'])->name('data-dokter.store');
Route::delete('/data-dokter/{id}', [DokterController::class, 'destroy']);
