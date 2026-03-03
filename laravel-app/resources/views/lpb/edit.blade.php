@extends('layouts.app')

@section('title', 'Edit Laporan Pengamatan')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        {{-- Kartu Form Utama --}}
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="p-6 sm:p-8">
                <h2 class="text-2xl font-bold text-[#2E7D32] mb-6 border-b border-gray-200 pb-4">
                    ✏️ Edit Formulir Laporan Pengamatan
                </h2>

                @if ($errors->any())
                    <div class="mb-6 bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-md" role="alert">
                        <strong class="font-bold">Terjadi kesalahan:</strong>
                        <ul class="mt-2 list-disc pl-5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('lpb.update', $lpb->no_surat) }}" method="POST">
                    @csrf
                    @method('PUT')

                    @php
                        $inputStyle = "mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-[#4CAF50] focus:ring focus:ring-[#4CAF50] focus:ring-opacity-50 transition";
                        $labelStyle = "block font-medium text-sm text-gray-700";
                        $readonlyStyle = "mt-1 block w-full rounded-lg border-gray-300 shadow-sm bg-gray-100 cursor-not-allowed";
                    @endphp

                    <div class="space-y-6">

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="no_surat" class="{{ $labelStyle }}">Nomor Surat</label>
                                <input type="text" id="no_surat" name="no_surat" value="{{ old('no_surat', $lpb->no_surat) }}" class="{{ $readonlyStyle }}" readonly>
                            </div>
                            <div>
                                <label for="nama_petugas" class="{{ $labelStyle }}">Nama Petugas</label>
                                <input type="text" id="nama_petugas" value="{{ $lpb->user->nama ?? '-' }}" class="{{ $readonlyStyle }}" readonly>
                            </div>
                            <div class="md:col-span-2">
                                <label for="userlokasi_id" class="{{ $labelStyle }}">Lokasi</label>
                                <select id="userlokasi_id" name="userlokasi_id" class="{{ $inputStyle }}" required>
                                    <option value="">-- Pilih Lokasi --</option>
                                    @foreach($lokasi as $l)
                                        <option value="{{ $l->userlokasi_id }}" {{ old('userlokasi_id', $lpb->userlokasi_id) == $l->userlokasi_id ? 'selected' : '' }}>
                                            {{ $l->jorong->nama_jorong ?? 'Jorong' }}, {{ $l->nagari->nama_nagari ?? 'Nagari' }}, {{ $l->kecamatan->nama_kecamatan ?? 'Kecamatan' }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 pt-6 border-t">
                            <div>
                                <label for="varietas_id" class="{{ $labelStyle }}">Varietas</label>
                                <select id="varietas_id" name="varietas_id" class="{{ $inputStyle }}" required>
                                    <option value="">-- Pilih Varietas --</option>
                                    @foreach($varietas as $v)
                                        <option value="{{ $v->varietas_id }}" {{ old('varietas_id', $lpb->varietas_id) == $v->varietas_id ? 'selected' : '' }}>{{ $v->nama_varietas }}</option>
                                    @endforeach
                                </select>
                            </div>
                             <div>
                                <label for="umur" class="{{ $labelStyle }}">Umur Tanaman (HST)</label>
                                <input type="text" id="umur" name="umur" placeholder="Contoh: 40-55" value="{{ old('umur', $lpb->umur) }}" class="{{ $inputStyle }}" required>
                            </div>
                             <div>
                                <label for="tgl_pengamatan" class="{{ $labelStyle }}">Tgl. Pengamatan</label>
                                <input type="date" id="tgl_pengamatan" name="tgl_pengamatan" value="{{ old('tgl_pengamatan', $lpb->tgl_pengamatan) }}" class="{{ $inputStyle }}" required>
                            </div>
                            <div>
                                <label for="laporan_ke" class="{{ $labelStyle }}">Laporan Ke</label>
                                <input type="number" id="laporan_ke" name="laporan_ke" placeholder="Contoh: 1" value="{{ old('laporan_ke', $lpb->laporan_ke) }}" class="{{ $inputStyle }}" required>
                            </div>
                        </div>


                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                           <div>
                                <label for="opt_id" class="{{ $labelStyle }}">Jenis OPT</label>
                                <select id="opt_id" name="opt_id" class="{{ $inputStyle }}" required>
                                    <option value="">-- Pilih OPT --</option>
                                    @foreach($opts as $opt)
                                        <option value="{{ $opt->opt_id }}" {{ old('opt_id', $lpb->opt_id) == $opt->opt_id ? 'selected' : '' }}>{{ $opt->nama_opt }}</option>
                                    @endforeach
                                </select>
                            </div>

                           <div >
                                <label for="deteksi_id" class="{{ $labelStyle }}">Tautkan Hasil Deteksi (Opsional)</label>
                                <select id="deteksi_id" name="deteksi_id" class="{{ $inputStyle }}">
                                    <option value="">-- Pilih Deteksi --</option>
                                    @foreach($deteksi as $d)
                                        <option value="{{ $d->deteksi_id }}" {{ old('deteksi_id', $lpb->deteksi_id) == $d->deteksi_id ? 'selected' : '' }}>
                                            {{ $d->deteksi_id }} - {{ $d->hasil ?? $d->label }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6">
                            <div>
                                <label for="intensitas_serangan" class="{{ $labelStyle }}">Intensitas Serangan (%)</label>
                                <input type="number" step="0.01" id="intensitas_serangan" name="intensitas_serangan" placeholder="10.25" value="{{ old('intensitas_serangan', $lpb->intensitas_serangan) }}" class="{{ $inputStyle }}">
                            </div>
                             <div>
                                <label for="luas_serangan_ha" class="{{ $labelStyle }}">Luas Serangan (Ha)</label>
                                <input type="number" step="0.01" id="luas_serangan_ha" name="luas_serangan_ha" placeholder="0.5" value="{{ old('luas_serangan_ha', $lpb->luas_serangan_ha) }}" class="{{ $inputStyle }}">
                            </div>
                            <div>
                                <label for="luas_terancam_ha" class="{{ $labelStyle }}">Luas Terancam (Ha)</label>
                                <input type="number" step="0.01" id="luas_terancam_ha" name="luas_terancam_ha" placeholder="11.25" value="{{ old('luas_terancam_ha', $lpb->luas_terancam_ha) }}" class="{{ $inputStyle }}">
                            </div>
                             <div>
                                <label for="padat_populasi_ha" class="{{ $labelStyle }}">Padat Populasi</label>
                                <input type="number" step="0.01" id="padat_populasi_ha" name="padat_populasi_ha" placeholder="150" value="{{ old('padat_populasi_ha', $lpb->padat_populasi_ha) }}" class="{{ $inputStyle }}">
                            </div>
                            <div>
                               <label for="populasi_MA" class="{{ $labelStyle }}">Populasi MA</label>
                               <input type="text" id="populasi_MA" name="populasi_MA" placeholder="Contoh: Laba-laba 0.43" value="{{ old('populasi_MA', $lpb->populasi_MA) }}" class="{{ $inputStyle }}">
                           </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-6 border-t">
                            <div class="md:col-span-2">
                                <label for="upaya" class="{{ $labelStyle }}">Upaya Pengendalian</label>
                                <textarea id="upaya" name="upaya" rows="3" placeholder="Jelaskan upaya pengendalian yang telah dilakukan..." class="{{ $inputStyle }}">{{ old('upaya', $lpb->upaya) }}</textarea>
                            </div>

                             <div class="md:col-span-2">
                                <label for="pengendalian_id" class="{{ $labelStyle }}">Rekomendasi Metode Pengendalian</label>
                                <select id="pengendalian_id" name="pengendalian_id" class="{{ $inputStyle }}" required>
                                    <option value="">-- Pilih Metode --</option>
                                    @foreach($pengendalian as $peng)
                                        <option value="{{ $peng->pengendalian_id }}" {{ old('pengendalian_id', $lpb->pengendalian_id) == $peng->pengendalian_id ? 'selected' : '' }}>{{ $peng->deskripsi }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="md:col-span-2">
                                <label for="custom_pengendalian" class="{{ $labelStyle }}">Detail/Metode Pengendalian Lain</label>
                                <textarea id="custom_pengendalian" name="custom_pengendalian" rows="3" placeholder="Jika ada metode lain yang digunakan, jelaskan di sini..." class="{{ $inputStyle }}">{{ old('custom_pengendalian', $lpb->custom_pengendalian) }}</textarea>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mt-8 pt-6 border-t border-gray-200 flex justify-end space-x-4">
                        <a href="{{ route('lpb.index') }}" class="px-6 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors duration-300 shadow-md hover:shadow-lg transform hover:-translate-y-px">
                            Batal
                        </a>
                        <button type="submit" class="px-6 py-2 bg-[#4CAF50] text-white font-semibold rounded-lg hover:bg-[#2E7D32] transition-colors duration-300 shadow-md hover:shadow-lg transform hover:-translate-y-px">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
