<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lpb;
use App\Models\User;
use App\Models\DeteksiCnn;
use App\Models\UserLokasi;
use App\Models\Varietas;
use App\Models\Opt;
use App\Models\Pengendalian;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Maatwebsite\Excel\Facades\Excel; 
use App\Exports\LpbExport; 
use Illuminate\Support\Facades\Auth;

class LpbController extends Controller
{
public function index(Request $request)
    {
        $search = $request->input('search');

        // Query untuk mengambil data LPB
        $lpbs = Lpb::with(['opt', 'user']) 
            ->when($search, function ($query, $search) {
                // Terapkan filter pencarian jika ada
                return $query->where('no_surat', 'like', "%{$search}%")
                             ->orWhereHas('opt', function ($subQuery) use ($search) {
                                 $subQuery->where('nama_opt', 'like', "%{$search}%");
                             });
            })
            ->latest() // Urutkan dari yang terbaru
            ->paginate(5) // UBAH .get() MENJADI .paginate(5) DI SINI
            ->withQueryString(); // Agar parameter search tidak hilang saat pindah halaman

        return view('lpb.index', compact('lpbs'));
    }

    public function create()
{
    return view('lpb.create', [
        'users' => User::all(),
        'lokasis' => UserLokasi::where('user_id', Auth::id())->with(['jorong', 'nagari', 'kecamatan', 'kabkot'])->get(),
        'deteksis' => DeteksiCnn::all(),
        'varietas' => Varietas::all(),
        'opts' => Opt::all(),
        'pengendalians' => Pengendalian::all()
    ]);
}

public function store(Request $request)
{
    $validated = $request->validate([
        'no_surat' => 'required|string|unique:lpb,no_surat',
        'deteksi_id'=> "nullable|exists:deteksi_cnn,deteksi_id",
        'userlokasi_id' => 'required|exists:user_lokasis,userlokasi_id',
        'tgl_pengamatan' => 'required|date',
        'laporan_ke' => 'required|integer',
        'varietas_id' => 'required|exists:varietas,varietas_id',
        'umur' => 'required|string',
        'opt_id' => 'required|exists:opt,opt_id',
        'intensitas_serangan' => 'required|numeric|between:0,100',
        'padat_populasi_ha' => 'nullable|numeric',
        'luas_serangan_ha' => 'required|numeric',
        'luas_terancam_ha' => 'required|numeric',
        'populasi_MA' => 'nullable|string',
        'upaya' => 'nullable|string',
        'pengendalian_id' => 'required|exists:pengendalian,pengendalian_id',
        'custom_pengendalian' => 'nullable|string',
    ]);

    // Default value jika tidak ada deteksi_id
    $validated['deteksi_id'] = $request->input('deteksi_id', null); // atau 0 jika kamu prefer
    $validated['user_id'] = Auth::id(); // ⬅ Otomatis isi user yang login

    $lpb = new Lpb($validated);
    $lpb->deteksi_id = $request->deteksi_id;
    $lpb->user_id = Auth::user()->user_id;
    $lpb->save();

    return redirect()->route('lpb.index')->with('success', 'Data LPB berhasil disimpan.');
}

    public function show($no_surat)
    {
        $lpb = Lpb::with(['user', 'deteksi', 'userlokasi', 'varietas', 'opt', 'pengendalian'])->findOrFail($no_surat);
        return view('lpb.show', compact('lpb'));
    }

    public function edit($no_surat)
    {
        $lpb = Lpb::findOrFail($no_surat);
        $lokasi = UserLokasi::with(['jorong', 'nagari', 'kecamatan', 'kabkot'])->get();
        $deteksi = DeteksiCnn::all();
        $varietas = Varietas::all();
        $opts = Opt::all();
        $pengendalian    = Pengendalian::all();

        return view('lpb.edit', compact('lpb', 'lokasi', 'deteksi', 'varietas', 'opts', 'pengendalian'));
    }

    public function update(Request $request, $no_surat)
    {
         $request->validate([
            'no_surat' => 'required|string|unique:lpb,no_surat',
            'deteksi_id'=> "nullable|exists:deteksi_cnn,deteksi_id",
            'userlokasi_id' => 'required|exists:user_lokasis,userlokasi_id',
            'tgl_pengamatan' => 'required|date',
            'laporan_ke' => 'required|integer',
            'varietas_id' => 'required|exists:varietas,varietas_id',
            'umur' => 'required|string',
            'opt_id' => 'required|exists:opt,opt_id',
            'intensitas_serangan' => 'required|numeric|between:0,100',
            'padat_populasi_ha' => 'nullable|numeric',
            'luas_serangan_ha' => 'required|numeric',
            'luas_terancam_ha' => 'required|numeric',
            'populasi_MA' => 'nullable|string',
            'upaya' => 'nullable|string',
            'pengendalian_id' => 'required|exists:pengendalian,pengendalian_id',
            'custom_pengendalian' => 'nullable|string',
        ]);

        
        $lpb = Lpb::findOrFail($no_surat);
        $lpb->update($request->all());

        return redirect()->route('lpb.index')->with('success', 'Data LPB berhasil diupdate');
    }

    public function destroy($no_surat)
    {
        $lpb = Lpb::findOrFail($no_surat);
        $lpb->delete();

        return redirect()->route('lpb.index')->with('success', 'Data LPB berhasil dihapus');
    }

    public function cetakPDF($no_surat)
    {
        $lpb = Lpb::with(['user', 'deteksi', 'userlokasi', 'varietas', 'opt', 'pengendalian'])->findOrFail($no_surat);

        // Bersihkan karakter ilegal dari nama file
        $safeNoSurat = str_replace(['/', '\\'], '-', $no_surat);

        $pdf = PDF::loadView('lpb.pdf', compact('lpb'));
        return $pdf->stream("LPB-{$safeNoSurat}.pdf");
    }

    public function createFromDeteksi($deteksi_id)
    {
        $deteksi = DeteksiCnn::findOrFail($deteksi_id);

        // Ambil id OPT berdasarkan label deteksi (nama penyakit)
        $opt = Opt::where('nama_opt', 'like', '%' . $deteksi->label . '%')->first();

        // Ambil data tambahan
        $lokasis = UserLokasi::where('user_id', Auth::id())->with(['jorong', 'nagari', 'kecamatan', 'kabkot'])->get();
        $varietas = Varietas::all();
        $opts = Opt::all();
        $pengendalians = Pengendalian::all();

        // ⬅ Tambahkan ini agar blok <select> deteksi_id tetap muncul jika diperlukan
        $deteksis = DeteksiCnn::where('user_id', Auth::id())->latest()->get();

        return view('lpb.create', [
            'lokasis' => $lokasis,
            'varietas' => $varietas,
            'opts' => $opts,
            'pengendalians' => $pengendalians,
            'deteksis' => $deteksis, // ⬅ Kunci penting agar bagian @elseif(isset($deteksis)) aktif
            'default_opt_id' => $opt->opt_id ?? null,
            'custom_pengendalian' => $deteksi->pengendalian,
            'deteksi_id' => $deteksi->deteksi_id
        ]);
    }

    public function exportExcel()
    {
        // Nama file yang akan di-download
        $fileName = 'rekap-lpb-' . date('Y-m-d') . '.xlsx';
        
        // Memanggil package untuk men-download file menggunakan LpbExport class
        return Excel::download(new LpbExport, $fileName);
    }

}