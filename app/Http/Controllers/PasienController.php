<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use Illuminate\Http\Request;

class PasienController extends Controller
{
    public function index()
    {
        return Pasien::all();
        // $data = Pasien::all(); // Mengambil semua data pasien
        // return view('welcome', ['data' => $data]); // Mengirim data ke view welcome.blade.php
    }

    public function store(Request $request)
    {
        $request->validate([
            'nik' => 'required|unique:pasien',
            'no_ktp' => 'required|unique:pasien',
            'nama_lengkap' => 'required',
            'jenis_kelamin' => 'required',
            // Tambahkan validasi lainnya sesuai kebutuhan
        ]);

        return Pasien::create($request->all());
    }

    public function show($id)
    {
        return Pasien::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $pasien = Pasien::findOrFail($id);
        $pasien->update($request->all());
        return $pasien;
    }

    public function destroy($id)
    {
        return Pasien::destroy($id);
    }
}
