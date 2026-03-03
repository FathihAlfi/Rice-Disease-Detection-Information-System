@extends('layouts.app')

@section('title', 'Edit Diagnosa & Rekomendasi')

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

        {{-- PERBAIKAN: Menggunakan $diagnosa, bukan $item --}}
        <form action="{{ route('diagnosa.update', $diagnosa->diagnosa_id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="bg-white shadow-xl rounded-2xl p-6 sm:p-8 space-y-8">
                <div class="pb-4 border-b border-gray-200">
                    <h2 class="text-2xl font-bold text-gray-700">Form Edit Diagnosa dan Rekomendasi</h2>
                    <p class="text-sm text-gray-500 mt-1">ID Diagnosa: <strong>{{ $diagnosa->diagnosa_id }}</strong></p>
                </div>
                
                {{-- Data Rujukan dari Permohonan (Readonly) --}}
                <div class="space-y-4 bg-gray-50 p-4 rounded-lg border">
                    <h3 class="font-semibold text-lg text-gray-600">Data Rujukan dari Permohonan</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-4">
                        <div>
                            <label class="block text-xs font-medium text-gray-500">No. Surat Permohonan</label>
                            <input type="text" value="{{ $diagnosa->permohonan->no_surat ?? '' }}" class="mt-1 block w-full rounded-md bg-gray-200 border-gray-300 shadow-sm cursor-not-allowed" readonly>
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-500">Nama Pemilik</label>
                            <input type="text" value="{{ $diagnosa->permohonan->user->nama ?? '' }}" class="mt-1 block w-full rounded-md bg-gray-200 border-gray-300 shadow-sm cursor-not-allowed" readonly>
                        </div>
                    </div>
                </div>

                {{-- Input untuk Data Diagnosa yang Bisa Diedit --}}
                <div class="space-y-6 pt-6 border-t">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                             <label for="tgl_diagnosa" class="block text-sm font-medium text-gray-700">Tanggal Diagnosa <span class="text-red-500">*</span></label>
                             <input type="date" name="tgl_diagnosa" id="tgl_diagnosa" value="{{ old('tgl_diagnosa', $diagnosa->tgl_diagnosa) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                        </div>
                        <div>
                            <label for="metode_id" class="block text-sm font-medium text-gray-700">Metode Diagnosa <span class="text-red-500">*</span></label>
                            <select name="metode_id" id="metode_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                                <option value="">-- Pilih Metode --</option>
                                @foreach($metodes as $metode)
                                    <option value="{{ $metode->metode_id }}" {{ old('metode_id', $diagnosa->metode_id) == $metode->metode_id ? 'selected' : '' }}>{{ $metode->nama_metode }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div>
                        <label for="hasil_diagnosa" class="block text-sm font-medium text-gray-700">Hasil Diagnosa <span class="text-red-500">*</span></label>
                        <textarea name="hasil_diagnosa" id="hasil_diagnosa" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>{{ old('hasil_diagnosa', $diagnosa->hasil_diagnosa) }}</textarea>
                    </div>

                    <div>
                        <label for="deskripsi_opt" class="block text-sm font-medium text-gray-700">Deskripsi OPT <span class="text-red-500">*</span></label>
                        <textarea name="deskripsi_opt" id="deskripsi_opt" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>{{ old('deskripsi_opt', $diagnosa->deskripsi_opt) }}</textarea>
                    </div>

                    <div>
                        <label for="rekomendasi_pengendalian" class="block text-sm font-medium text-gray-700">Rekomendasi Pengendalian <span class="text-red-500">*</span></label>
                        <textarea name="rekomendasi_pengendalian" id="rekomendasi_pengendalian" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>{{ old('rekomendasi_pengendalian', $diagnosa->rekomendasi_pengendalian) }}</textarea>
                    </div>

                    <div>
                        <label for="dokumentasi" class="block text-sm font-medium text-gray-700">Ganti Dokumentasi (Opsional)</label>
                        <input type="file" name="dokumentasi" id="dokumentasi" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-green-50 file:text-green-700 hover:file:bg-green-100">
                        @if($diagnosa->dokumentasi)
                            <p class="mt-2 text-sm text-gray-600">File saat ini: <a href="{{ asset('storage/' . $diagnosa->dokumentasi) }}" class="text-blue-600 underline" target="_blank">Lihat</a></p>
                        @endif
                    </div>
                </div>

                <div class="flex justify-end pt-8 border-t">
                    <a href="{{ route('diagnosa.index') }}" class="bg-gray-200 text-gray-800 px-6 py-2 rounded-md mr-2 hover:bg-gray-300">Batal</a>
                    <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded-md hover:bg-green-700 shadow-md">Simpan Perubahan</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
