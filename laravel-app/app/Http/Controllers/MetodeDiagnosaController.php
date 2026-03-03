<?php

namespace App\Http\Controllers;

use App\Models\Metode;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class MetodeDiagnosaController extends Controller
{
    public function index()
    {
        $metodes = Metode::all();
        return view('metode.index', compact('metodes'));

        
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_metode' => 'required|string|max:255',
        ]);

        Metode::create($request->only('nama_metode'));

        return redirect()->route('metode.index')->with('success', 'Metode berhasil ditambahkan.');
    }

    // public function destroy($metode_id)
    // {
    //     $metode = Metode::findOrFail($metode_id);
    //     $metode->delete();

    //     return redirect()->route('metode.index')->with('success', 'Metode berhasil dihapus.');
    // }

    public function destroy($metode_id)
{
    try {
        $metode = Metode::findOrFail($metode_id);
        $metode->delete();

        return redirect()->route('metode.index')
            ->with('success', 'Metode berhasil dihapus.');

    } catch (QueryException $e) {
        
        // Error Code 23000: Integrity Constraint Violation
        // Artinya data ini tidak bisa dihapus karena menjadi induk data lain
        if ($e->getCode() == "23000") {
            return redirect()->back()
                ->with('error', 'Gagal menghapus! Data Metode ini masih digunakan pada data lain (Laporan Hasil Diagnosa dan Rekomendasi).');
        }

        // Jika error lain, biarkan sistem yang menangani
        throw $e;
    }
}
}
