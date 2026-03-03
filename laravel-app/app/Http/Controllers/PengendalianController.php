<?php

namespace App\Http\Controllers;

use App\Models\Pengendalian;
use App\Models\Opt;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class PengendalianController extends Controller
{
    public function index()
    {
        $pengendalian = Pengendalian::with('opt')->get();
        $opts = Opt::all();
        return view('pengendalian.index', compact('pengendalian', 'opts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'opt_id' => 'required|exists:opt,opt_id',
            'deskripsi' => 'required|string',
        ]);

        Pengendalian::create($request->only('opt_id', 'deskripsi'));

        return redirect()->route('pengendalian.index')->with('success', 'Data pengendalian berhasil ditambahkan.');
    }

    // public function destroy($id)
    // {
    //     Pengendalian::destroy($id);
    //     return redirect()->route('pengendalian.index')->with('success', 'Data pengendalian berhasil dihapus.');
    // }

    public function destroy($id)
    {
        try {
            // Cari data dulu, pastikan ada
            $pengendalian = Pengendalian::findOrFail($id);
            
            // Lakukan penghapusan
            $pengendalian->delete();

            return redirect()->route('pengendalian.index')
                ->with('success', 'Data pengendalian berhasil dihapus.');

        } catch (QueryException $e) {
            
            // Error Code 23000: Integrity Constraint Violation
            // Artinya data ini sedang dipakai sebagai foreign key di tabel lain (misal: Laporan Pengamatan)
            if ($e->getCode() == "23000") {
                return redirect()->back()
                    ->with('error', 'Gagal menghapus! Data Pengendalian ini masih digunakan dalam Laporan Peringatan Bahaya / Laporan Hasil Diagnosa dan Rekomendasi.');
            }

            // Jika errornya bukan masalah relasi, lempar error aslinya
            throw $e;
        }
    }
    
}
