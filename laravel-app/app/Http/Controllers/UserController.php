<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf;

class UserController extends Controller
{
    
    public function index(Request $request)
    {
        $search = $request->input('search');

        $users = User::with('role')
            ->when($search, function ($query, $search) {
                // Mencari berdasarkan nama atau NIP di tabel users
                return $query->where('nama', 'like', "%{$search}%")
                             ->orWhere('nip', 'like', "%{$search}%")
                             
                             // [MODIFIKASI] Mencari berdasarkan nama_role di tabel roles yang berelasi
                             ->orWhereHas('role', function ($subQuery) use ($search) {
                                 $subQuery->where('nama_role', 'like', "%{$search}%");
                             });
            })
            ->oldest()
            ->paginate(5)
            // Menambahkan query string ke link paginasi agar pencarian tidak hilang saat pindah halaman
            ->withQueryString(); 

        return view('users.index', compact('users'));

    }

    
    public function create()
    {
        $roles = Role::all();
        return view('users.create', compact('roles'));
    }

    
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'role_id' => 'required|exists:roles,role_id',
            'nama' => 'required|string|max:255',
            'nip' => 'required|numeric|unique:users,nip',
            'no_telp' => 'required|string',
            'wilayah' => 'required|string',
            'alamat' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed'
        ]);

        User::create([
            'role_id' => $request->role_id,
            'nama' => $request->nama,
            'nip' => $request->nip,
            'no_telp' => $request->no_telp,
            'wilayah' => $request->wilayah,
            'alamat' => $request->alamat,
            'email' => $request->email,
            'email_verified_at' => now(),
            'password' => Hash::make($request->password),
            'remember_token' => Str::random(10),
        ]);

        return redirect()->route('users.index')->with('success', 'User berhasil ditambahkan.');
    }

  
    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();
        return view('users.edit', compact('user', 'roles'));
    }

   
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'role_id' => 'required|exists:roles,role_id',
            'nama' => 'required|string|max:255',
            'nip' => 'required|numeric|unique:users,nip,' . $user->user_id . ',user_id',
            'no_telp' => 'required|string',
            'wilayah' => 'required|string',
            'alamat' => 'required|string',
            // 'email' => 'required|email|unique:users,email,' . $user->user_id . ',user_id',
            // 'password' => 'nullable|string|min:6|confirmed'
        ]);

        $user->update([
            'role_id' => $request->role_id,
            'nama' => $request->nama,
            'nip' => $request->nip,
            'no_telp' => $request->no_telp,
            'wilayah' => $request->wilayah,
            'alamat' => $request->alamat,
            // 'email' => $request->email,
            // 'password' => $request->password ? Hash::make($request->password) : $user->password,
        ]);

        return redirect()->route('users.index')->with('success', 'User berhasil diperbarui.');
    }

  
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User berhasil dihapus.');
    }

    public function cetak()
    {
        $users = User::with('role')->get();
        $pdf = PDF::loadView('users.cetak', compact('users'));
        return $pdf->download('data_user.pdf');
    }

    public function show($id)
{
    $users = User::with('role')->findOrFail($id);
    return view('users.show', compact('users'));
}

}
