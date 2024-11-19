<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return Admin::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_admin' => 'required',
            'username' => 'required|unique:admins',
            'password' => 'required',
        ]);

        return Admin::create($request->all());
    }

    public function show($id)
    {
        return Admin::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $admin = Admin::findOrFail($id);
        $admin->update($request->all());
        return $admin;
    }

    public function destroy($id)
    {
        return Admin::destroy($id);
    }
}
