<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\PendaftaranController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/jadwal-dokter', [DokterController::class, 'index']);
Route::get('/pendaftaran-pasien', [PasienController::class, 'index'])->name('index');
Route::post('/pendaftaran-pasien/store', [PasienController::class, 'store'])->name('store');


