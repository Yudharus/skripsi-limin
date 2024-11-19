<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PasienController;


// Route::get('/', [PasienController::class, 'index']);
Route::get('/', function () {
    return view('welcome');
});
