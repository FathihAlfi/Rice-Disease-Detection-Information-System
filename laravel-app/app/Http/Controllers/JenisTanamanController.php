<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jenis;
use Illuminate\Database\QueryException;

class JenisTanamanController extends Controller
{
    public function index()
    {
        $jenisTanaman = Jenis::all();
        return view('jenis.index', compact('jenisTanaman'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_jenis' => 'required|string|max:255',
        ]);

        Jenis::create([
            'nama_jenis' => $request->nama_jenis,
        ]);

        return redirect()->route('jenis.index')->with('success', 'Jenis tanaman berhasil ditambahkan.');
    }

    // public function destroy($id)
    // {
    //     $jenis = Jenis::findOrFail($id);
    //     $jenis->delete();

    //     return redirect()->route('jenis.index')->with('success', 'Jenis tanaman berhasil dihapus.');
    // }

    public function destroy($id)
    {
        try {
            $jenis = Jenis::findOrFail($id);
            $jenis->delete();

            return redirect()->route('jenis.index')
                ->with('success', 'Jenis tanaman berhasil dihapus.');

        } catch (QueryException $e) {
            
            // Error Code 23000 = Integrity Constraint Violation (Data masih berelasi)
            if ($e->getCode() == "23000") {
                return redirect()->back()
                    ->with('error', 'Gagal menghapus! Data Jenis ini masih digunakan pada data Varietas atau Laporan.');
            }

            // Jika error lain (bukan masalah relasi), biarkan Laravel menanganinya
            throw $e;
        }
    }
}
