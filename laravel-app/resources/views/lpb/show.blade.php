@extends('layouts.app')

@section('title', 'Detail LPB')

@section('content')
<div class="py-6">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow-md rounded-lg p-6 overflow-x-auto">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">
                Detail LPB - {{ $lpb->no_surat }}
            </h2>

            <table class="min-w-full text-sm text-left border border-gray-200">
                <tbody class="divide-y divide-gray-200">
                    <tr><th class="py-2 px-4 bg-gray-100 w-1/3 font-medium">Nomor Surat</th><td class="py-2 px-4">{{ $lpb->no_surat ?? '-' }}</td></tr>
                    <tr><th class="py-2 px-4 bg-gray-100 font-medium">Tanggal Pengamatan</th><td class="py-2 px-4">{{ $lpb->tgl_pengamatan ?? '-' }}</td></tr>
                    <tr><th class="py-2 px-4 bg-gray-100 font-medium">Laporan Ke</th><td class="py-2 px-4">{{ $lpb->laporan_ke ?? '-' }}</td></tr>
                    <tr><th class="py-2 px-4 bg-gray-100 font-medium">Varietas</th><td class="py-2 px-4">{{ $lpb->varietas->nama_varietas ?? '-' }}</td></tr>
                    <tr><th class="py-2 px-4 bg-gray-100 font-medium">Umur</th><td class="py-2 px-4">{{ $lpb->umur ?? '-' }}</td></tr>
                    <tr><th class="py-2 px-4 bg-gray-100 font-medium">OPT</th><td class="py-2 px-4">{{ $lpb->opt->nama_opt ?? '-' }}</td></tr>
                    <tr><th class="py-2 px-4 bg-gray-100 font-medium">Intensitas Serangan</th><td class="py-2 px-4">{{ $lpb->intensitas_serangan ?? '-' }}%</td></tr>
                    <tr><th class="py-2 px-4 bg-gray-100 font-medium">Padat Populasi/Ha</th><td class="py-2 px-4">{{ $lpb->padat_populasi_ha ?? '-' }} ekor/rpn/phn/m2</td></tr>
                    <tr><th class="py-2 px-4 bg-gray-100 font-medium">Luas Serangan (Ha)</th><td class="py-2 px-4">{{ $lpb->luas_serangan_ha ?? '-' }}</td></tr>
                    <tr><th class="py-2 px-4 bg-gray-100 font-medium">Luas Terancam (Ha)</th><td class="py-2 px-4">{{ $lpb->luas_terancam_ha ?? '-' }}</td></tr>
                    <tr><th class="py-2 px-4 bg-gray-100 font-medium">Populasi MA</th><td class="py-2 px-4">{{ $lpb->populasi_MA ?? '-' }} ekor/rpn/phn</td></tr>
                    <tr><th class="py-2 px-4 bg-gray-100 font-medium">Upaya</th><td class="py-2 px-4">{{ $lpb->upaya ?? '-' }}</td></tr>
                    <tr><th class="py-2 px-4 bg-gray-100 font-medium">Pengendalian</th><td class="py-2 px-4">{{ $lpb->pengendalian->deskripsi ?? $lpb->custom_pengendalian ?? '-' }}</td></tr>
                    <tr>
                        <th class="py-2 px-4 bg-gray-100 font-medium">Lokasi</th>
                        <td class="py-2 px-4">
                        @if($lpb->userlokasi)
                            {{ $lpb->userlokasi->jorong->nama_jorong ?? '' }},
                            {{ $lpb->userlokasi->nagari->nama_nagari ?? '' }},
                            {{ $lpb->userlokasi->kecamatan->nama_kecamatan ?? '' }},
                            {{ $lpb->userlokasi->kabkot->nama_kabkot ?? '' }}
                        @else
                            <span class="text-gray-400">Data lokasi tidak tersedia</span>
                        @endif
                        </td>
                    </tr>
                    <tr><th class="py-2 px-4 bg-gray-100 font-medium">Deteksi Otomatis</th><td class="py-2 px-4">{{ $lpb->deteksi->label ?? 'Tidak Ada' }}</td></tr>
                    
                    {{-- PERBAIKAN: Mengganti 'image' menjadi 'gambar' --}}
                    @if($lpb->deteksi && $lpb->deteksi->gambar)
                        <tr>
                            <th class="py-2 px-4 bg-gray-100 font-medium">Gambar Deteksi</th>
                            <td class="py-2 px-4">
                                <a href="{{ asset('storage/' . $lpb->deteksi->gambar) }}" target="_blank">
                                    <img src="{{ asset('storage/' . $lpb->deteksi->gambar) }}" alt="Gambar Hasil Deteksi" style="max-width: 300px; height: auto; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                                </a>
                                <p style="margin-top: 5px; font-size: 11px; color: #555;">Hasil Deteksi: <strong>{{ $lpb->deteksi->label }}</strong></p>
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>

            <div class="mt-6 text-right">
                <a href="{{ route('lpb.index') }}" class="inline-block bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-2 px-4 rounded">
                    ← Kembali
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
