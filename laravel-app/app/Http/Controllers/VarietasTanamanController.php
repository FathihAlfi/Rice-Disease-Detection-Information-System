<?php

namespace App\Http\Controllers;

use App\Models\Jenis;
use App\Models\Varietas;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class VarietasTanamanController extends Controller
{
    public function index()
    {
        $varietas = Varietas::with('jenis')->get();
        $jenis = Jenis::all();
        return view('varietas.index', compact('varietas', 'jenis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'jenis_id' => 'required|exists:jenis,jenis_id',
            'nama_varietas' => 'required|string|max:255',
        ]);

        Varietas::create([
            'jenis_id' => $request->jenis_id,
            'nama_varietas' => $request->nama_varietas,
        ]);

        return redirect()->route('varietas.index')->with('success', 'Varietas berhasil ditambahkan.');
    }

    // public function destroy($id)
    // {
    //     Varietas::destroy($id);
    //     return redirect()->route('varietas.index')->with('success', 'Varietas berhasil dihapus.');
    // }

    public function destroy($id)
{
    try {
        // Cari data berdasarkan ID, jika tidak ada akan error 404
        $varietas = Varietas::findOrFail($id);
        
        // Lakukan penghapusan
        $varietas->delete();

        return redirect()->route('varietas.index')
            ->with('success', 'Varietas berhasil dihapus.');

    } catch (QueryException $e) {
        
        // Error Code 23000 artinya Integrity Constraint Violation 
        // (Data tidak bisa dihapus karena dipakai di tabel lain)
        if ($e->getCode() == "23000") {
            return redirect()->back()
                ->with('error', 'Gagal menghapus! Data Varietas ini masih digunakan dalam Laporan Pengamatan.');
        }

        // Jika errornya bukan masalah relasi, lempar error aslinya agar developer tahu
        throw $e;
    }
}
}