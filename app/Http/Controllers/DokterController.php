<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use Illuminate\Http\Request;

class DokterController extends Controller
{
    public function index()
    {
        return Dokter::all();
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

    public function update(Request $request, $id)
    {
        $dokter = Dokter::findOrFail($id);
        $dokter->update($request->all());
        return $dokter;
    }

    public function destroy($id)
    {
        return Dokter::destroy($id);
    }
}
