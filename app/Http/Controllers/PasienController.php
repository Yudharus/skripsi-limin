<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use App\Models\Dokter;
use Illuminate\Http\Request;

class PasienController extends Controller
{
    public function index()
    {
          // Mengambil semua data pasien
        $data = Pasien::all();

        // Mengambil semua data dokter
        $dokters = Dokter::all();

        // Mengirim data pasien dan dokter ke view
        return view('pendaftaran', ['data' => $data, 'dokters' => $dokters]);
        // return Pasien::all();
        // $data = Pasien::all(); // Mengambil semua data pasien
        // return view('pendaftaran', ['data' => $data]); // Mengirim data ke view welcome.blade.php
    }

    public function store(Request $request)
    {
         // Validasi input
         $validated = $request->validate([
            'nik' => 'required|unique:pasien,nik',
            'no_ktp' => 'required|unique:pasien,no_ktp',
            'nama_lengkap' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:Laki-Laki,Perempuan',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string|max:500',
            'no_telepon' => 'nullable|string|max:15', 
            'tempat_lahir' => 'nullable|string|max:15', 
            'agama' => 'nullable|string|max:15', 
            'pendidikan' => 'nullable|string|max:15', 
            'kota' => 'nullable|string|max:15', 
            'kode_pos' => 'nullable|string|max:15', 
            'desa_kelurahan' => 'nullable|string|max:15', 
            'kecamatan' => 'nullable|string|max:15', 
            'kabupaten' => 'nullable|string|max:15', 
            'provinsi' => 'nullable|string|max:15', 
            'rt_rw' => 'nullable|string|max:15', 
            'pekerjaan' => 'nullable|string|max:15', 
            'kewarganegaraan' => 'nullable|string|max:15', 
            'nama_dokter' => 'required|string|max:255',
            'status_pendaftaran' => 'nullable|string',
            'tanggal_kunjungan' => 'nullable|string|max:15', 
            'keluhan' => 'nullable|string|max:15', 
            'jenis_kunjungan' => 'nullable|string|max:15', 
        ]);

        $validated['status_pendaftaran'] = 'Diterima';

        // Insert data ke tabel pasien
        $pasien = Pasien::create($validated);

        // Redirect kembali ke halaman pendaftaran dengan pesan sukses
        return redirect()->route('index')->with('success', 'Data pasien berhasil disimpan!');
        // return redirect()->route('pendaftaran', ['id_pasien' => $pasien->id_pasien])->with('success', 'Data pasien berhasil disimpan!');
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
