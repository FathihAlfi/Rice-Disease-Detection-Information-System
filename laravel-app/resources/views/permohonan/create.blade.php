@extends('layouts.app')

@section('title', 'Ajukan Permohonan Diagnosa')

@section('content')
<div class="py-12">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow-sm rounded-lg p-8">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Formulir Permohonan Diagnosa</h2>

            <form action="{{ route('permohonan.store') }}" method="POST" class="space-y-6">
                @csrf
                
                {{-- No Surat --}}
                <div>
                    <label for="no_surat" class="block text-sm font-medium text-gray-700">No. Surat</label>
                    <input type="text" name="no_surat" id="no_surat" value="{{ old('no_surat') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                    @error('no_surat') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                {{-- Jenis & Varietas dalam satu baris --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="jenis_id" class="block text-sm font-medium text-gray-700">Jenis Tanaman</label>
                        <select name="jenis_id" id="jenis_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                            <option value="">-- Pilih Jenis --</option>
                            @foreach($jenis as $j)
                                <option value="{{ $j->jenis_id }}" {{ old('jenis_id') == $j->jenis_id ? 'selected' : '' }}>{{ $j->nama_jenis }}</option>
                            @endforeach
                        </select>
                        @error('jenis_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label for="varietas_id" class="block text-sm font-medium text-gray-700">Varietas</label>
                        <select name="varietas_id" id="varietas_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                            <option value="">-- Pilih Varietas --</option>
                             @foreach($varietas as $v)
                                <option value="{{ $v->varietas_id }}" {{ old('varietas_id') == $v->varietas_id ? 'selected' : '' }}>{{ $v->nama_varietas }}</option>
                            @endforeach
                        </select>
                        @error('varietas_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                </div>

                {{-- Umur & Bagian Terserang --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="umur" class="block text-sm font-medium text-gray-700">Umur Tanaman (HST)</label>
                        <input type="text" name="umur" id="umur" value="{{ old('umur') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                    </div>
                    <div>
                        <label for="bagian_terserang" class="block text-sm font-medium text-gray-700">Bagian yang Terserang</label>
                        <input type="text" name="bagian_terserang" id="bagian_terserang" value="{{ old('bagian_terserang') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                    </div>
                </div>

                 {{-- Tanggal Ditemukan & Cara Budidaya & Jumlah Sampel --}}
                 <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label for="tgl_ditemukan" class="block text-sm font-medium text-gray-700">Tanggal Ditemukan</label>
                        <input type="date" name="tgl_ditemukan" id="tgl_ditemukan" value="{{ old('tgl_ditemukan') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                    </div>
                    <div>
                        <label for="budidaya" class="block text-sm font-medium text-gray-700">Cara Budidaya</label>
                        <input type="text" name="budidaya" id="budidaya" value="{{ old('budidaya') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                    </div>
                     <div>
                        <label for="jumlah_sampel" class="block text-sm font-medium text-gray-700">Jumlah Sampel</label>
                        <input type="number" name="jumlah_sampel" id="jumlah_sampel" value="{{ old('jumlah_sampel') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                    </div>
                </div>

                {{-- Gejala --}}
                <div>
                    <label for="gejala" class="block text-sm font-medium text-gray-700">Gejala yang Timbul</label>
                    <textarea name="gejala" id="gejala" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>{{ old('gejala') }}</textarea>
                    @error('gejala') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
                
                {{-- Tombol Submit --}}
                <div class="flex justify-end pt-4">
                    <a href="{{ route('permohonan.index') }}" class="bg-gray-200 text-gray-800 px-4 py-2 rounded-md mr-2">Batal</a>
                    <button type="submit" class="bg-[#4CAF50] text-white px-4 py-2 rounded-md hover:bg-[#2E7D32]">Ajukan Permohonan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
