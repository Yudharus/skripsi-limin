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

    public function verifikasiPendaftaran(Request $request)
    {
        // Ambil nilai pencarian dari query string
        $search = $request->input('search');

        // Query data pasien dengan pencarian
        $datas = Pasien::when($search, function ($query, $search) {
            return $query->where('nama_lengkap', 'like', "%{$search}%")
                        ->orWhere('nik', 'like', "%{$search}%");
        })->get();

        // Mengambil semua data dokter
        $dokters = Dokter::all();

        // Mengambil admin dari session
        $admin = session('admin');

        if (!$admin) {
            return redirect('/login')->withErrors(['error' => 'You need to login first.']);
        }

        $datas = $datas->map(function ($data) use ($dokters) {
            // Cari dokter berdasarkan nama_dokter
            $dokter = $dokters->firstWhere('nama_dokter', $data->nama_dokter);
            
            // Tambahkan spesialisasi ke data pasien jika ditemukan
            $data->spesialis = $dokter ? $dokter->spesialis : 'Tidak Diketahui';
    
            return $data;
        });

        return view('verifikasi-pendaftaran', compact('datas', 'dokters', 'admin'));
    }

    public function dataPasien(Request $request)
    {
        // Ambil nilai pencarian dari query string
        $search = $request->input('search');

        // Query data pasien dengan pencarian
        $datas = Pasien::when($search, function ($query, $search) {
            return $query->where('nama_lengkap', 'like', "%{$search}%")
                        ->orWhere('nik', 'like', "%{$search}%");
        })->get();

        // Mengambil semua data dokter
        $dokters = Dokter::all();

        // Mengambil admin dari session
        $admin = session('admin');

        if (!$admin) {
            return redirect('/login')->withErrors(['error' => 'You need to login first.']);
        }

        $datas = $datas->map(function ($data) use ($dokters) {
            // Cari dokter berdasarkan nama_dokter
            $dokter = $dokters->firstWhere('nama_dokter', $data->nama_dokter);
            
            // Tambahkan spesialisasi ke data pasien jika ditemukan
            $data->spesialis = $dokter ? $dokter->spesialis : 'Tidak Diketahui';
    
            return $data;
        });

        return view('data-pasien', compact('datas', 'dokters', 'admin'));
    }

    public function dataPasienDokter(Request $request)
    {
        // Ambil nilai pencarian dari query string
        $search = $request->input('search');

        // Query data pasien dengan pencarian
        $datas = Pasien::when($search, function ($query, $search) {
            return $query->where('nama_lengkap', 'like', "%{$search}%")
                        ->orWhere('nik', 'like', "%{$search}%");
        })->get();

        // Mengambil semua data dokter
        $dokters = Dokter::all();

        // Mengambil admin dari session
        $admin = session('admin');

        if (!$admin) {
            return redirect('/login')->withErrors(['error' => 'You need to login first.']);
        }

        $datas = $datas->map(function ($data) use ($dokters) {
            // Cari dokter berdasarkan nama_dokter
            $dokter = $dokters->firstWhere('nama_dokter', $data->nama_dokter);
            
            // Tambahkan spesialisasi ke data pasien jika ditemukan
            $data->spesialis = $dokter ? $dokter->spesialis : 'Tidak Diketahui';
    
            return $data;
        });

        return view('data-pasien-dokter', compact('datas', 'dokters', 'admin'));
    }

    public function updateStatus(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'status_pendaftaran' => 'required|in:Diterima,Ditolak',
        ]);

        $pasien = Pasien::findOrFail($id);

        $datas = Pasien::all();

        $dokters = Dokter::all();

        $admin = session('admin');

        $pasien->update([
            'status_pendaftaran' => $request->status_pendaftaran,
        ]);

        return view('verifikasi-pendaftaran', compact('datas', 'dokters', 'admin'));
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

    public function storeDataPasien(Request $request)
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
        return redirect()->route('data.pasien')->with('success', 'Data pasien berhasil disimpan!');
        // return redirect()->route('pendaftaran', ['id_pasien' => $pasien->id_pasien])->with('success', 'Data pasien berhasil disimpan!');
    }

    public function show($id)
    {
        return Pasien::findOrFail($id);
    }

    public function update(Request $request)
    {
            $pasien = Pasien::findOrFail($request->id_pasien);
            $pasien->nama_dokter = $request->nama_dokter;
            $pasien->keluhan = $request->keluhan;
            $pasien->tanggal_kunjungan = $request->tanggal_kunjungan;
            $pasien->jenis_kunjungan = $request->jenis_kunjungan;
            $pasien->no_ktp = $request->no_ktp;
            $pasien->nik = $request->nik;
            $pasien->nama_lengkap = $request->nama_lengkap;
            $pasien->tempat_lahir = $request->tempat_lahir;
            $pasien->tanggal_lahir = $request->tanggal_lahir;
            $pasien->jenis_kelamin = $request->jenis_kelamin;
            $pasien->no_telepon = $request->no_telepon;
            $pasien->agama = $request->agama;
            $pasien->pendidikan = $request->pendidikan;
            $pasien->kota = $request->kota;
            $pasien->kode_pos = $request->kode_pos;
            $pasien->desa_kelurahan = $request->desa_kelurahan;
            $pasien->kecamatan = $request->kecamatan;
            $pasien->kabupaten = $request->kabupaten;
            $pasien->provinsi = $request->provinsi;
            $pasien->rt_rw = $request->rt_rw;
            $pasien->pekerjaan = $request->pekerjaan;
            $pasien->kewarganegaraan = $request->kewarganegaraan;
            $pasien->alamat = $request->alamat;
            $pasien->save();
        
        // $pasien->where('id_pasien', $request->id_pasien)->update($request->all());
        return redirect()->route('data.pasien')->with('success', 'Data pasien berhasil diubah!');
    }

    public function destroy($id)
    {
        return Pasien::destroy($id);
    }
}
