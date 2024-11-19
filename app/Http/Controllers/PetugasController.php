<?php

namespace App\Http\Controllers;

use App\Models\Petugas;
use Illuminate\Http\Request;

class PetugasController extends Controller
{
    public function index()
    {
        return Petugas::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_petugas' => 'required',
            'username' => 'required|unique:petugas',
            'password' => 'required',
        ]);

        return Petugas::create($request->all());
    }

    public function show($id)
    {
        return Petugas::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $petugas = Petugas::findOrFail($id);
        $petugas->update($request->all());
        return $petugas;
    }

    public function destroy($id)
    {
        return Petugas::destroy($id);
    }
}
