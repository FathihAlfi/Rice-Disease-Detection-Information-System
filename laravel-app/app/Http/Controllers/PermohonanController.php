<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Permohonan;
use App\Models\Jenis;
use App\Models\Varietas;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Carbon\Carbon;

class PermohonanController extends Controller
{
    /**
     * Menampilkan daftar permohonan berdasarkan role pengguna,
     * dengan fungsionalitas pencarian dan paginasi.
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', Permohonan::class);
        
        $user = Auth::user();
        $search = $request->input('search');

        // Memulai query dengan relasi yang dibutuhkan
        $query = Permohonan::with(['user', 'jenis', 'varietas', 'diagnosa']);

        // --- PERBAIKAN UTAMA: Memindahkan filter user_id ke dalam blok POPT ---
        if ($user->role_id == 2) { // POPT
            // POPT hanya melihat permohonan yang dia buat sendiri.
            $query->where('user_id', $user->user_id);
        } elseif ($user->role_id == 3) { // Penerima Sampel
            $query->whereIn('status', ['draf', 'ditunggu','diterima']);
        } elseif ($user->role_id == 4) { // Analis
            // Analis melihat semua permohonan yang sudah diterima.
            $query->where('status', ['diterima','selesai']);
        }
        // Admin akan melihat semua data karena logika 'before' di dalam Policy.

        // Menerapkan filter pencarian
        $query->when($search, function ($q, $searchTerm) {
            $q->where(function($subq) use ($searchTerm) {
                $subq->where('no_surat', 'like', "%{$searchTerm}%")
                     ->orWhere('status', 'like', "%{$searchTerm}%")
                     ->orWhereHas('user', function ($userQuery) use ($searchTerm) {
                         $userQuery->where('nama', 'like', "%{$searchTerm}%");
                     })
                     ->orWhereHas('varietas', function ($varietasQuery) use ($searchTerm) {
                         $varietasQuery->where('nama_varietas', 'like', "%{$searchTerm}%");
                     });
                
                try {
                    $searchDate = Carbon::parse($searchTerm)->format('Y-m-d');
                    $subq->orWhereDate('tgl_ditemukan', $searchDate);
                } catch (\Exception $e) {
                    // Abaikan jika bukan tanggal
                }
            });
        });
        
        $permohonans = $query->latest()->paginate(5)->withQueryString();

        return view('permohonan.index', compact('permohonans'));
    }

    public function create()
    {
        $this->authorize('create', Permohonan::class);
        $jenis = Jenis::orderBy('nama_jenis')->get();
        $varietas = Varietas::orderBy('nama_varietas')->get();
        return view('permohonan.create', compact('jenis', 'varietas'));
    }

    public function store(Request $request)
    {
        $this->authorize('create', Permohonan::class);
        $validated = $request->validate([
            'no_surat' => 'required|string|unique:surat_permohonan,no_surat',
            'jenis_id' => 'required|exists:jenis,jenis_id',
            'varietas_id' => 'required|exists:varietas,varietas_id',
            'umur' => 'required|string|max:50',
            'bagian_terserang' => 'required|string|max:255',
            'tgl_ditemukan' => 'required|date',
            'budidaya' => 'required|string|max:100',
            'jumlah_sampel' => 'required|integer|min:1',
            'gejala' => 'required|string',
        ]);
        $validated['user_id'] = Auth::id();
        Permohonan::create($validated);
        return redirect()->route('permohonan.index')->with('success', 'Permohonan berhasil diajukan.');
    }
    
    public function show(Permohonan $permohonan)
    {
        $this->authorize('view', $permohonan);
        return view('permohonan.show', compact('permohonan'));
    }

    public function edit(Permohonan $permohonan)
    {
        $this->authorize('update', $permohonan);
        $jenis = Jenis::orderBy('nama_jenis')->get();
        $varietas = Varietas::orderBy('nama_varietas')->get();
        return view('permohonan.edit', compact('permohonan', 'jenis', 'varietas'));
    }

    public function update(Request $request, Permohonan $permohonan)
    {
        $this->authorize('update', $permohonan);
        $validated = $request->validate([
            'jenis_id' => 'required|exists:jenis,jenis_id',
            'varietas_id' => 'required|exists:varietas,varietas_id',
            'umur' => 'required|string|max:50',
            'bagian_terserang' => 'required|string|max:255',
            'tgl_ditemukan' => 'required|date',
            'budidaya' => 'required|string|max:100',
            'jumlah_sampel' => 'required|integer|min:1',
            'gejala' => 'required|string',
        ]);

        // Jika permohonan yang 'ditunggu' diperbaiki, kembalikan statusnya ke 'draf'
        if ($permohonan->status == 'ditunggu') {
            $validated['status'] = 'draf';
            $validated['perbaikan'] = null;
        }

        $permohonan->update($validated);
        return redirect()->route('permohonan.index')->with('success', 'Permohonan berhasil diperbarui.');
    }

    public function destroy(Permohonan $permohonan)
    {
        $this->authorize('delete', $permohonan);
        $permohonan->delete();
        return redirect()->route('permohonan.index')->with('success', 'Permohonan berhasil dihapus.');
    }

    public function approve(Permohonan $permohonan)
    {
        // PERBAIKAN: Mengaktifkan kembali pemeriksaan izin
        $this->authorize('manage', $permohonan); 
        
        $permohonan->update([
            'status' => 'diterima',
            'penerima_id' => Auth::id()
        ]);

        return redirect()->route('permohonan.index')->with('success', "Permohonan nomor {$permohonan->no_surat} telah disetujui.");
    }

    /**
     * Menolak permohonan.
     */
    public function reject(Request $request, Permohonan $permohonan)
    {
        // Pemeriksaan izin ini sudah benar
        $this->authorize('manage', $permohonan);
        $request->validate(['perbaikan' => 'required|string|min:10']);
        
        $permohonan->update([
            'status' => 'ditunggu',
            'perbaikan' => $request->perbaikan
        ]);
        return redirect()->route('permohonan.index')->with('success', "Permohonan nomor {$permohonan->no_surat} telah ditolak dan menunggu perbaikan.");
    }

     public function cetakPDF(Permohonan $permohonan)
    {
        $this->authorize('view', $permohonan);

        // --- PERBAIKAN UTAMA ---
        // Memastikan semua relasi yang dibutuhkan oleh PDF dimuat,
        // termasuk relasi 'penerima' untuk tanda tangan kedua.
        $permohonan->load(['user', 'penerima', 'jenis', 'varietas']);
        
        $safeNoSurat = str_replace(['/', '\\'], '-', $permohonan->no_surat);
        $pdf = PDF::loadView('permohonan.pdf', compact('permohonan'));
        return $pdf->stream("permohonan-{$safeNoSurat}.pdf");
    }
}
