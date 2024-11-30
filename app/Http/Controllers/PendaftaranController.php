<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use Illuminate\Http\Request;

class PendaftaranController extends Controller
{
    public function index()
    {
        $pendaftaran = Pendaftaran::with(['pasien', 'dokter'])->get();

        // Kirim data ke view 'pendaftaran.blade.php'
        return view('pendaftaran-keluhan', ['pendaftaran' => $pendaftaran]);
        // return Pendaftaran::with(['pasien', 'dokter'])->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_pasien' => 'required|exists:pasien,id_pasien',
            'id_dokter' => 'required|exists:dokter,id_dokter',
            'status_pendaftaran' => 'required',
            'tanggal_kunjungan' => 'required|date',
            // Tambahkan validasi lainnya
        ]);

        return Pendaftaran::create($request->all());
    }

    public function show($id)
    {
        return Pendaftaran::with(['pasien', 'dokter'])->findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $pendaftaran = Pendaftaran::findOrFail($id);
        $pendaftaran->update($request->all());
        return $pendaftaran;
    }

    public function destroy($id)
    {
        return Pendaftaran::destroy($id);
    }
}
