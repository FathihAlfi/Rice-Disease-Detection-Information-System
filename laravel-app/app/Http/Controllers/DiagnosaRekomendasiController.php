<?php

namespace App\Http\Controllers;

use App\Models\DiagnosaRekomendasi;
use App\Models\Permohonan;
use App\Models\Metode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Maatwebsite\Excel\Facades\Excel; 
use App\Exports\DiagnosaExport; 
use Illuminate\Support\Str;

class DiagnosaRekomendasiController extends Controller
{
    /**
     * Menampilkan daftar diagnosa berdasarkan role pengguna.
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $query = DiagnosaRekomendasi::with('permohonan.user');

        if ($user->role_id == 4) { // Analis
            $query->where('analis_id', $user->user_id);
        } elseif ($user->role_id == 5) { // Manager Teknis
            $query->whereIn('status', ['telah dibuat', 'telah diperiksa']);
        } elseif ($user->role_id == 6) { // Manager Mutu
            $query->whereIn('status', ['telah diperiksa','telah disetujui']);
        } elseif ($user->role_id == 7) { // Kepala LPHP
            $query->whereIn('status', ['telah disetujui','selesai']);
        }
        // Admin akan melihat semua data.

        $data = $query->latest()->paginate(10);
        return view('diagnosa.index', compact('data'));
    }

    public function create(Permohonan $permohonan)
    {
        if (Auth::user()->role_id !== 4) {
            abort(403, 'HANYA ANALIS YANG DAPAT MEMBUAT DIAGNOSA.');
        }

        if ($permohonan->status !== 'diterima') {
            return redirect()->route('permohonan.index')->with('error', 'Diagnosa hanya bisa dibuat dari permohonan yang diterima.');
        }

        $metodes = Metode::all();
        return view('diagnosa.create', compact('permohonan', 'metodes'));
    }

    public function store(Request $request)
    {
        if (Auth::user()->role_id !== 4) {
            abort(403, 'HANYA ANALIS YANG DAPAT MENYIMPAN DIAGNOSA.');
        }

        $validated = $request->validate([
            'diagnosa_id' => 'required|string|unique:diagnosa_rekomendasis,diagnosa_id',
            'permohonan_no_surat' => 'required|exists:surat_permohonan,no_surat|unique:diagnosa_rekomendasis,permohonan_no_surat',
            'metode_id' => 'required|exists:metode,metode_id',
            'tgl_diagnosa' => 'required|date',
            'hasil_diagnosa' => 'required|string',
            'deskripsi_opt' => 'required|string',
            'rekomendasi_pengendalian' => 'required|string',
            'dokumentasi' => 'nullable|file|image|max:2048',
        ]);

        if ($request->hasFile('dokumentasi')) {
            $validated['dokumentasi'] = $request->file('dokumentasi')->store('dokumentasi_diagnosa', 'public');
        }
        
        $validated['analis_id'] = Auth::id();
        $validated['status'] = 'telah dibuat';

        DiagnosaRekomendasi::create($validated);

        $permohonan = Permohonan::find($request->permohonan_no_surat);
        if ($permohonan) {
            $permohonan->update(['status' => 'selesai']);
        }
        
        return redirect()->route('diagnosa.index')->with('success', 'Data diagnosa berhasil disimpan dan dikirim untuk diperiksa.');
    }
    
    public function show(DiagnosaRekomendasi $diagnosa)
    {
        $user = Auth::user();
        if ($user->role_id == 4 && $diagnosa->analis_id != $user->user_id) {
            abort(403, 'THIS ACTION IS UNAUTHORIZED.');
        }

        $diagnosa->load(['permohonan.user', 'metode', 'analis', 'pemeriksa', 'penyetuju', 'pengesah']);
        return view('diagnosa.show', compact('diagnosa'));
    }

    public function edit(DiagnosaRekomendasi $diagnosa)
    {
        $user = Auth::user();
        if (!($user->role_id == 4 && $diagnosa->analis_id == $user->user_id && $diagnosa->status == 'revisi')) {
            abort(403, 'THIS ACTION IS UNAUTHORIZED.');
        }

        $metodes = Metode::all();
        $diagnosa->load('permohonan'); 
        return view('diagnosa.edit', compact('diagnosa', 'metodes'));
    }
    
    public function update(Request $request, DiagnosaRekomendasi $diagnosa)
    {
        $user = Auth::user();
        if (!($user->role_id == 4 && $diagnosa->analis_id == $user->user_id && $diagnosa->status == 'revisi')) {
            abort(403, 'THIS ACTION IS UNAUTHORIZED.');
        }

        $validated = $request->validate([
            'metode_id' => 'required|exists:metode,metode_id',
            'tgl_diagnosa' => 'required|date',
            'hasil_diagnosa' => 'required|string',
            'deskripsi_opt' => 'required|string',
            'rekomendasi_pengendalian' => 'required|string',
            'dokumentasi' => 'nullable|file|image|max:2048',
        ]);
        
        if ($request->hasFile('dokumentasi')) {
            if ($diagnosa->dokumentasi) {
                Storage::disk('public')->delete($diagnosa->dokumentasi);
            }
            $validated['dokumentasi'] = $request->file('dokumentasi')->store('dokumentasi_diagnosa', 'public');
        }

        // --- PERBAIKAN UTAMA: Logika Pengembalian Status ---
        $nextStatus = 'telah dibuat'; // Default kembali ke awal
        if ($diagnosa->penyetuju_id) {
            // Jika sudah pernah disetujui Man. Mutu, kembalikan ke status 'telah disetujui'
            $nextStatus = 'telah disetujui';
        } elseif ($diagnosa->pemeriksa_id) {
            // Jika sudah pernah diperiksa Man. Teknis, kembalikan ke status 'telah diperiksa'
            $nextStatus = 'telah diperiksa';
        }
        
        $validated['status'] = $nextStatus;
        $validated['perbaikan'] = null; // Menghapus catatan perbaikan

        $diagnosa->update($validated);
        return redirect()->route('diagnosa.index')->with('success', 'Data diagnosa berhasil diperbarui dan dikirim ulang.');
    }
    
    public function destroy(DiagnosaRekomendasi $diagnosa)
    {
        if ($diagnosa->dokumentasi) {
            Storage::disk('public')->delete($diagnosa->dokumentasi);
        }
        $diagnosa->delete();
        return redirect()->route('diagnosa.index')->with('success', 'Data diagnosa berhasil dihapus.');
    }
    
    public function cetakPDF(DiagnosaRekomendasi $diagnosa)
    {
        $user = Auth::user();
        if ($user->role_id == 4 && $diagnosa->analis_id != $user->user_id) {
            abort(403, 'THIS ACTION IS UNAUTHORIZED.');
        }

        $diagnosa->load(['permohonan.user', 'permohonan.jenis', 'permohonan.varietas', 'metode', 'analis', 'pemeriksa', 'penyetuju', 'pengesah']);
        $safeNoSurat = str_replace(['/', '\\'], '-', $diagnosa->diagnosa_id);
        $pdf = PDF::loadView('diagnosa.pdf', compact('diagnosa'));
        return $pdf->stream("diagnosa-{$safeNoSurat}.pdf");
    }

    public function exportExcel()
    {
        $fileName = 'rekap-diagnosa-' . date('Y-m-d') . '.xlsx';
        return Excel::download(new DiagnosaExport, $fileName);
    }

    // --- METHOD AKSI BARU UNTUK ALUR KERJA ---

    public function periksa(DiagnosaRekomendasi $diagnosa)
    {
        if (Auth::user()->role_id !== 5 || $diagnosa->status !== 'telah dibuat') { abort(403); }
        $diagnosa->update(['status' => 'telah diperiksa', 'pemeriksa_id' => Auth::id(), 'diperiksa_at' => now()]);
        return redirect()->route('diagnosa.index')->with('success', 'Diagnosa telah diperiksa.');
    }

    public function setujui(DiagnosaRekomendasi $diagnosa)
    {
        if (Auth::user()->role_id !== 6 || $diagnosa->status !== 'telah diperiksa') { abort(403); }
        $diagnosa->update(['status' => 'telah disetujui', 'penyetuju_id' => Auth::id(), 'disetujui_at' => now()]);
        return redirect()->route('diagnosa.index')->with('success', 'Diagnosa telah disetujui.');
    }

    public function sahkan(DiagnosaRekomendasi $diagnosa)
    {
        if (Auth::user()->role_id !== 7 || $diagnosa->status !== 'telah disetujui') { abort(403); }
        $diagnosa->update(['status' => 'selesai', 'pengesah_id' => Auth::id(), 'disahkan_at' => now()]);
        return redirect()->route('diagnosa.index')->with('success', 'Diagnosa telah disahkan.');
    }

    public function revisi(Request $request, DiagnosaRekomendasi $diagnosa)
    {
        $user = Auth::user();
        $allowedToRevise = ($user->role_id == 5 && $diagnosa->status == 'telah dibuat') ||
                           ($user->role_id == 6 && $diagnosa->status == 'telah diperiksa') ||
                           ($user->role_id == 7 && $diagnosa->status == 'telah disetujui');

        if (!$allowedToRevise) { abort(403); }

        $request->validate(['perbaikan' => 'required|string|min:10']);
        
        $diagnosa->update(['status' => 'revisi', 'perbaikan' => $request->perbaikan]);
        return redirect()->route('diagnosa.index')->with('success', 'Diagnosa dikembalikan untuk revisi.');
    }
}
