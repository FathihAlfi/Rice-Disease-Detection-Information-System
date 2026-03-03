@extends('layouts.app')

@section('title', 'Buat Diagnosa & Rekomendasi')

@section('content')
<div class="py-12">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        
        @if ($errors->any())
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6" role="alert">
                <p class="font-bold">Terjadi Kesalahan:</p>
                <ul class="mt-2 list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('diagnosa.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            {{-- Menyimpan no surat permohonan secara tersembunyi untuk dikirim ke controller --}}
            <input type="hidden" name="permohonan_no_surat" value="{{ $permohonan->no_surat }}">

            <div class="bg-white shadow-xl rounded-2xl p-6 sm:p-8 space-y-8">
                <div class="pb-4 border-b border-gray-200">
                    <h2 class="text-2xl font-bold text-gray-700 flex items-center gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                        </svg>
                        Formulir Diagnosa dan Rekomendasi
                    </h2>
                </div>
                
                {{-- PERUBAHAN: Menampilkan Nomor Surat Permohonan sebagai readonly --}}
                <div>
                    <label for="permohonan_no_surat_display" class="block text-sm font-medium text-gray-700">Nomor Surat Permohonan (Rujukan)</label>
                    <input type="text" id="permohonan_no_surat_display" value="{{ $permohonan->no_surat }}" class="mt-1 block w-full rounded-md bg-gray-200 border-gray-300 shadow-sm cursor-not-allowed" readonly>
                </div>
                
                {{-- PERUBAHAN: Menambahkan input untuk Nomor Surat Diagnosa --}}
                 <div>
                    <label for="no_surat" class="block text-sm font-medium text-gray-700">Nomor Surat Diagnosa <span class="text-red-500">*</span></label>
                    <input type="text" name="diagnosa_id" id="diagnosa_id" value="{{ old('no_surat') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required placeholder="Masukkan nomor surat untuk diagnosa ini...">
                    @error('no_surat') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                {{-- Data dari Permohonan (Readonly) --}}
                <div class="space-y-4 bg-gray-50 p-4 rounded-lg border">
                    <h3 class="font-semibold text-lg text-gray-600">Data Rujukan dari Permohonan</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-4">
                        <div>
                            <label class="block text-xs font-medium text-gray-500">Nama Pemilik</label>
                            <input type="text" value="{{ $permohonan->user->nama ?? '' }}" class="mt-1 block w-full rounded-md bg-gray-200 border-gray-300 shadow-sm cursor-not-allowed" readonly>
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-500">Alamat</label>
                            <input type="text" value="{{ $permohonan->user->alamat ?? '' }}" class="mt-1 block w-full rounded-md bg-gray-200 border-gray-300 shadow-sm cursor-not-allowed" readonly>
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-500">Jenis Tanaman</label>
                            <input type="text" value="{{ $permohonan->jenis->nama_jenis ?? '' }}" class="mt-1 block w-full rounded-md bg-gray-200 border-gray-300 shadow-sm cursor-not-allowed" readonly>
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-500">Varietas</label>
                            <input type="text" value="{{ $permohonan->varietas->nama_varietas ?? '' }}" class="mt-1 block w-full rounded-md bg-gray-200 border-gray-300 shadow-sm cursor-not-allowed" readonly>
                        </div>
                        <div class="col-span-2">
                            <label class="block text-xs font-medium text-gray-500">Gejala Awal</label>
                            <textarea rows="2" class="mt-1 block w-full rounded-md bg-gray-200 border-gray-300 shadow-sm cursor-not-allowed" readonly>{{ $permohonan->gejala }}</textarea>
                        </div>
                    </div>
                </div>

                {{-- Input untuk Data Diagnosa Baru --}}
                <div class="space-y-6 pt-6 border-t">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="tgl_diagnosa" class="block text-sm font-medium text-gray-700">Tanggal Diagnosa <span class="text-red-500">*</span></label>
                            <input type="date" name="tgl_diagnosa" id="tgl_diagnosa" value="{{ old('tgl_diagnosa', date('Y-m-d')) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                        </div>
                        <div>
                            <label for="metode_id" class="block text-sm font-medium text-gray-700">Metode Diagnosa <span class="text-red-500">*</span></label>
                            <select name="metode_id" id="metode_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                                <option value="">-- Pilih Metode --</option>
                                @foreach($metodes as $metode)
                                    <option value="{{ $metode->metode_id }}" {{ old('metode_id') == $metode->metode_id ? 'selected' : '' }}>{{ $metode->nama_metode }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div>
                        <label for="hasil_diagnosa" class="block text-sm font-medium text-gray-700">Hasil Diagnosa <span class="text-red-500">*</span></label>
                        <textarea name="hasil_diagnosa" id="hasil_diagnosa" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>{{ old('hasil_diagnosa') }}</textarea>
                    </div>
                    <div>
                        <label for="deskripsi_opt" class="block text-sm font-medium text-gray-700">Deskripsi OPT <span class="text-red-500">*</span></label>
                        <textarea name="deskripsi_opt" id="deskripsi_opt" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>{{ old('deskripsi_opt') }}</textarea>
                    </div>
                    <div>
                        <label for="rekomendasi_pengendalian" class="block text-sm font-medium text-gray-700">Rekomendasi Pengendalian <span class="text-red-500">*</span></label>
                        <textarea name="rekomendasi_pengendalian" id="rekomendasi_pengendalian" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>{{ old('rekomendasi_pengendalian') }}</textarea>
                    </div>
                    <div>
                        <label for="dokumentasi" class="block text-sm font-medium text-gray-700">Dokumentasi (Opsional)</label>
                        <input type="file" name="dokumentasi" id="dokumentasi" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-green-50 file:text-green-700 hover:file:bg-green-100">
                    </div>
                </div>

                {{-- Tombol Aksi --}}
                <div class="flex justify-end pt-8 border-t">
                    <a href="{{ route('permohonan.index') }}" class="bg-gray-200 text-gray-800 px-6 py-2 rounded-md mr-2 hover:bg-gray-300">Batal</a>
                    <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded-md hover:bg-green-700 shadow-md">Simpan Diagnosa</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
