@extends('layouts.app')

@section('title', 'Edit Permohonan - ' . $permohonan->no_surat)

@section('content')
<div class="py-12">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow-sm rounded-lg p-8">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Formulir Edit Permohonan</h2>

            {{-- Form action mengarah ke route 'update' dengan method PUT/PATCH --}}
            <form action="{{ route('permohonan.update', $permohonan->no_surat) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')
                
                {{-- No Surat (tidak bisa diedit) --}}
                <div>
                    <label for="no_surat_disabled" class="block text-sm font-medium text-gray-700">No. Surat (Tidak dapat diubah)</label>
                    <input type="text" id="no_surat_disabled" value="{{ $permohonan->no_surat }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm bg-gray-100 cursor-not-allowed" disabled>
                </div>

                {{-- Jenis & Varietas dalam satu baris --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="jenis_id" class="block text-sm font-medium text-gray-700">Jenis Tanaman</label>
                        <select name="jenis_id" id="jenis_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                            <option value="">-- Pilih Jenis --</option>
                            @foreach($jenis as $j)
                                <option value="{{ $j->jenis_id }}" {{ old('jenis_id', $permohonan->jenis_id) == $j->jenis_id ? 'selected' : '' }}>
                                    {{ $j->nama_jenis }}
                                </option>
                            @endforeach
                        </select>
                        @error('jenis_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label for="varietas_id" class="block text-sm font-medium text-gray-700">Varietas</label>
                        <select name="varietas_id" id="varietas_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                            <option value="">-- Pilih Varietas --</option>
                             @foreach($varietas as $v)
                                <option value="{{ $v->varietas_id }}" {{ old('varietas_id', $permohonan->varietas_id) == $v->varietas_id ? 'selected' : '' }}>
                                    {{ $v->nama_varietas }}
                                </option>
                            @endforeach
                        </select>
                        @error('varietas_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                </div>

                {{-- Umur & Bagian Terserang --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="umur" class="block text-sm font-medium text-gray-700">Umur Tanaman (HST)</label>
                        <input type="text" name="umur" id="umur" value="{{ old('umur', $permohonan->umur) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                    </div>
                    <div>
                        <label for="bagian_terserang" class="block text-sm font-medium text-gray-700">Bagian yang Terserang</label>
                        <input type="text" name="bagian_terserang" id="bagian_terserang" value="{{ old('bagian_terserang', $permohonan->bagian_terserang) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                    </div>
                </div>

                 {{-- Tanggal Ditemukan & Cara Budidaya & Jumlah Sampel --}}
                 <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label for="tgl_ditemukan" class="block text-sm font-medium text-gray-700">Tanggal Ditemukan</label>
                        <input type="date" name="tgl_ditemukan" id="tgl_ditemukan" value="{{ old('tgl_ditemukan', $permohonan->tgl_ditemukan) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                    </div>
                    <div>
                        <label for="budidaya" class="block text-sm font-medium text-gray-700">Cara Budidaya</label>
                        <input type="text" name="budidaya" id="budidaya" value="{{ old('budidaya', $permohonan->budidaya) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                    </div>
                     <div>
                        <label for="jumlah_sampel" class="block text-sm font-medium text-gray-700">Jumlah Sampel</label>
                        <input type="number" name="jumlah_sampel" id="jumlah_sampel" value="{{ old('jumlah_sampel', $permohonan->jumlah_sampel) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                    </div>
                </div>

                {{-- Gejala --}}
                <div>
                    <label for="gejala" class="block text-sm font-medium text-gray-700">Gejala yang Timbul</label>
                    <textarea name="gejala" id="gejala" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>{{ old('gejala', $permohonan->gejala) }}</textarea>
                    @error('gejala') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
                
                {{-- Tombol Submit --}}
                <div class="flex justify-end pt-4">
                    <a href="{{ route('permohonan.index') }}" class="bg-gray-200 text-gray-800 px-4 py-2 rounded-md mr-2 hover:bg-gray-300">Batal</a>
                    <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700">Update Permohonan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
