@extends('layouts.app')

@section('title', 'Hasil Deteksi Penyakit Padi')

@section('content')
{{-- Container utama untuk menengahkan kartu --}}
<div class="min-h-[calc(100vh-8rem)] flex items-center justify-center p-4 sm:p-6 lg:p-8">

    {{-- Kartu Hasil dengan gaya tema --}}
    <div class="w-full max-w-5xl bg-white rounded-2xl shadow-xl overflow-hidden">
        <div class="p-6 sm:p-8">

            <div class="border-b border-gray-200 pb-4 mb-6">
                <h1 class="text-2xl font-bold text-[#2E7D32] flex items-center gap-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                    Hasil Deteksi Penyakit Padi
                </h1>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
                
                <div class="flex justify-center items-center">
                    {{-- Gambar diatur agar proporsional di dalam kartu --}}
                    <img src="{{ $gambar }}" alt="Gambar Daun Padi" 
                         class="w-full max-w-[350px] h-auto max-h-[350px] object-contain rounded-xl shadow-md border">
                </div>

                <div>
                    <dl class="space-y-6">
                        <div>
                            <dt class="text-sm font-medium text-gray-500 uppercase tracking-wider">Penyakit Terdeteksi</dt>
                            {{-- Hasil utama dibuat paling menonjol --}}
                            <dd class="mt-1 text-4xl font-bold text-[#2E7D32]">{{ $label }}</dd>
                        </div>
                        
                        <div>
                            <dt class="text-sm font-medium text-gray-500 uppercase tracking-wider">Tingkat Keyakinan</dt>
                            <dd class="mt-1">
                                <div class="w-full bg-gray-200 rounded-full h-4">
                                    <div class="bg-[#4CAF50] h-4 rounded-full text-xs font-medium text-white text-center leading-none" style="width: {{ $confidence }}%">
                                       {{ $confidence }}%
                                    </div>
                                </div>
                            </dd>
                        </div>

                        <div>
                            <dt class="text-sm font-medium text-gray-500 uppercase tracking-wider">Rekomendasi Penanggulangan</dt>
                            <dd class="mt-1 text-base text-gray-800 leading-relaxed text-justify">{{ $rekomendasi }}</dd>
                        </div>
                    </dl>
                </div>
            </div>

            <div class="mt-8 pt-6 border-t border-gray-200 flex flex-col sm:flex-row justify-center items-center gap-4">
                <a href="{{ route('prediksi.form') }}" class="w-full sm:w-auto inline-flex items-center justify-center px-6 py-3 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors duration-300 shadow-sm font-semibold">
                    🔁 Deteksi Gambar Lain
                </a>
                <a href="{{ route('lpb.create.from.deteksi', ['deteksi_id' => $deteksi_id]) }}" class="w-full sm:w-auto inline-flex items-center justify-center px-6 py-3 bg-[#4CAF50] text-white font-semibold rounded-lg hover:bg-[#2E7D32] transition-colors duration-300 shadow-md hover:shadow-lg transform hover:-translate-y-px">
                    📝 Buat LPB dari Hasil Ini
                </a>
            </div>
        </div>
    </div>
</div>
@endsection