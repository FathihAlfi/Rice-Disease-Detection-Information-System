<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserLokasi;
use App\Models\User;
use App\Models\KabKota;
use App\Models\Kecamatan;
use App\Models\Nagari;
use App\Models\Jorong;
use Illuminate\Validation\Rule;

class UserLokasiController extends Controller
{
    /**
     * Menampilkan daftar lokasi tugas dan form.
     * Hanya data awal (User dan Kab/Kota) yang dimuat.
     */
    public function index()
    {
        $userLokasis = UserLokasi::with('user', 'kabkot', 'kecamatan', 'nagari', 'jorong')
                                 ->orderBy('userlokasi_id', 'desc')
                                 ->get();

        $users = User::where('role_id', 2)->orderBy('nama')->get(); 
        $kabkots = KabKota::orderBy('nama_kabkot')->get();

        return view('userlokasi.index', compact(
            'userLokasis',
            'users',
            'kabkots'
        ));
    }

    /**
     * Menyimpan data lokasi tugas baru dengan logika hibrida.
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'user_id' => 'required|exists:users,user_id',
            'kabkot_id' => 'required|exists:kab_kota,kabkot_id',
            'kecamatan_id' => 'required|exists:kecamatan,kecamatan_id',
            'nagari_id' => 'required|exists:nagari,nagari_id',
            'jorong_id' => 'nullable|required_without:nama_jorong_baru|exists:jorong,jorong_id',
            'nama_jorong_baru' => 'nullable|required_without:jorong_id|string|max:255',
        ]);

        $jorongId = $request->jorong_id;

        // Jika ada input jorong baru, buat atau cari yang sudah ada
        if ($request->filled('nama_jorong_baru')) {
            $jorong = Jorong::firstOrCreate(
                [
                    'nama_jorong' => $request->nama_jorong_baru,
                    'nagari_id' => $request->nagari_id
                ]
            );
            $jorongId = $jorong->jorong_id;
        }
        
        // Cek kembali keunikan data sebelum menyimpan
        $isDuplicate = UserLokasi::where('user_id', $request->user_id)
                                ->where('jorong_id', $jorongId)
                                ->exists();

        if ($isDuplicate) {
            return back()->withErrors(['user_id' => 'Pengguna ini sudah memiliki tugas di lokasi jorong yang sama.'])->withInput();
        }

        // Simpan data UserLokasi
        UserLokasi::create([
            'user_id' => $request->user_id,
            'kabkot_id' => $request->kabkot_id,
            'kecamatan_id' => $request->kecamatan_id,
            'nagari_id' => $request->nagari_id,
            'jorong_id' => $jorongId,
        ]);

        return redirect()->route('userlokasi.index')->with('success', 'Lokasi tugas berhasil ditambahkan.');
    }

    public function destroy(UserLokasi $userLokasi)
    {
        $userLokasi->delete();
        return redirect()->route('userlokasi.index')->with('success', 'Lokasi tugas berhasil dihapus.');
    }

    // --- METHOD BARU UNTUK AJAX ---

    public function getKecamatan(Request $request)
    {
        $kecamatans = Kecamatan::where('kabkot_id', $request->kabkot_id)->orderBy('nama_kecamatan')->get();
        return response()->json($kecamatans);
    }

    public function getNagari(Request $request)
    {
        $nagaris = Nagari::where('kecamatan_id', $request->kecamatan_id)->orderBy('nama_nagari')->get();
        return response()->json($nagaris);
    }

    public function getJorong(Request $request)
    {
        $jorongs = Jorong::where('nagari_id', $request->nagari_id)->orderBy('nama_jorong')->get();
        return response()->json($jorongs);
    }
}
