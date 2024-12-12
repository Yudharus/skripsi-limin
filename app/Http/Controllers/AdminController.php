<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Session;

class AdminController extends Controller
{
    public function index()
    {
        return view('login'); // View login

    }

    public function dataPetugas(Request $request)
    {
        // Ambil nilai pencarian dari query string
        $search = $request->input('search');

        // Query data admin dengan filter role pegawai dan pencarian
        $datas = Admin::where('role', 'petugas')
        ->when($search, function ($query, $search) {
            return $query->where(function ($subQuery) use ($search) {
                $subQuery->where('nama_admin', 'like', "%{$search}%")
                        ->orWhere('username', 'like', "%{$search}%");
            });
        })
        ->get();

        // Mengambil admin dari session
        $admin = session('admin');

        if (!$admin) {
            return redirect('/login')->withErrors(['error' => 'You need to login first.']);
        }

        return view('data-petugas', compact('datas', 'admin'));
    }

    public function storeDataPetugas(Request $request)
    {
         // Validasi input
         $validated = $request->validate([
            'nama_admin' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'password' => 'required|string|max:255',
        ]);

        $validated['role'] = 'petugas';

        // Insert data ke tabel admin
        $admin = Admin::create($validated);

        // Redirect kembali ke halaman pendaftaran dengan pesan sukses
        return redirect()->route('data.petugas')->with('success', 'Data petugas berhasil disimpan!');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $admin = Admin::where('username', $request->username)->first();

        if ($admin && $admin->password === $request->password) {
            Session::put('admin', $admin);
            return redirect('/home');
        }

        // Jika login gagal
        return back()->withErrors([
            'username' => 'Invalid username or password.',
        ])->onlyInput('username');
    }

    // Logout
    public function logout(Request $request)
    {
        Session::forget('admin'); // Hapus session admin
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }

    // Halaman Home
    public function home()
    {
        $admin = Session::get('admin'); // Ambil data admin dari session

        if (!$admin) {
            return redirect('/login')->withErrors(['error' => 'You need to login first.']);
        }
    
        return view('home', ['admin' => $admin]);
        // $user = Admin::user();

        // return view('home', ['user' => $user]);
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

    public function update(Request $request)
    {
        $admin = Admin::findOrFail($request->id_admin);
        $admin->nama_admin = $request->nama_admin;
        $admin->username = $request->username;
        $admin->password = $request->password;
        
        $admin->save();
    
        return redirect()->route('data.petugas')->with('success', 'Data petugas berhasil disimpan!');
    }

    public function destroy($id)
    {
        $admin = Admin::find($id);

    if ($admin) {
        $admin->delete();
        return redirect()->route('data.petugas')->with('success', 'Data petugas berhasil dihapus!');
    } else {
        return response()->json(['success' => false, 'message' => 'Petugas not found'], 404);
    }
    }
}
