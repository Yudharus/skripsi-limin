<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use Illuminate\Http\Request;

class DokterController extends Controller
{
    public function index()
    {
        $datas = Dokter::all();

        return view('dokter-list',['datas' => $datas]);
    }

    public function dataDokter(Request $request)
    {
        // Ambil nilai pencarian dari query string
        $search = $request->input('search');

        // Query data admin dengan filter role pegawai dan pencarian
        $datas = Dokter::when($search, function ($query, $search) {
            return $query->where('nama_dokter', 'like', "%{$search}%");
        })->get();

        // Mengambil admin dari session
        $admin = session('admin');

        if (!$admin) {
            return redirect('/login')->withErrors(['error' => 'You need to login first.']);
        }

        return view('data-dokter', compact('datas', 'admin'));
    }

    public function storeDataDokter(Request $request)
    {
         // Validasi input
         $validated = $request->validate([
            'nama_dokter' => 'required|string|max:255',
            'spesialis' => 'required|string|max:255',
            'jadwal_dokter' => 'required|string|max:255',
        ]);

        // Insert data ke tabel dokter
        $dokter = Dokter::create($validated);
        
        session()->flash('successStoreDokter', 'Data dokter berhasil disimpan!');

        // Redirect kembali ke halaman pendaftaran dengan pesan sukses
        return redirect()->route('data.dokter');
    }

    public function update(Request $request)
    {
        $dokter = Dokter::findOrFail($request->id_dokter);
        $dokter->nama_dokter = $request->nama_dokter;
        $dokter->spesialis = $request->spesialis;
        $dokter->jadwal_dokter = $request->jadwal_dokter;
        
        $dokter->save();

        session()->flash('successUpdateDokter', 'Data dokter berhasil diubah!');
    
        return redirect()->route('data.dokter');
    }


    public function store(Request $request)
    {
        $request->validate([
            'nama_dokter' => 'required',
            'spesialis' => 'required',
            'jadwal_dokter' => 'required',
        ]);

        return Dokter::create($request->all());
    }

    public function show($id)
    {
        return Dokter::findOrFail($id);
    }

    // public function update(Request $request, $id)
    // {
    //     $dokter = Dokter::findOrFail($id);
    //     $dokter->update($request->all());
    //     return $dokter;
    // }

    public function destroy($id)
    {
        $dokter = Dokter::find($id);

    if ($dokter) {
        $dokter->delete();
        return redirect()->route('data.dokter')->with('success', 'Data dokter berhasil dihapus!');
    } else {
        return response()->json(['success' => false, 'message' => 'dokter not found'], 404);
    }
    }
}
