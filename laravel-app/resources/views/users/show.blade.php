@extends('layouts.app')

@section('title', 'Detail User - ' . $users->nama)

{{-- Kita tidak menggunakan @section('header') agar judul bisa menyatu di dalam kartu --}}

@section('content')
{{-- Container utama untuk menengahkan kartu secara vertikal & horizontal --}}
<div class="min-h-[calc(100vh-8rem)] flex items-center justify-center p-4 sm:p-6 lg:p-8">

    {{-- Kartu Detail dengan gaya tema --}}
    <div class="w-full max-w-4xl bg-white rounded-2xl shadow-xl overflow-hidden">
        <div class="p-6 sm:p-8">
            
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between pb-4 border-b border-gray-200">
                <div>
                    <h2 class="text-2xl font-bold text-gray-700 flex items-center gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0010 11z" clip-rule="evenodd" />
                        </svg>
                        Detail User {{ $users->nama }}
                    </h2>
                </div>
                <div class="mt-4 sm:mt-0">
                    <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                        {{ $users->role->nama_role ?? 'Tanpa Role' }}
                    </span>
                </div>
            </div>

            <div class="mt-6">
                <dl class="grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-6">
                    <div class="sm:col-span-1">
                        <dt class="text-sm font-medium text-gray-500">Nama Lengkap</dt>
                        <dd class="mt-1 text-base text-gray-900 font-semibold">{{ $users->nama }}</dd>
                    </div>
                    <div class="sm:col-span-1">
                        <dt class="text-sm font-medium text-gray-500">NIP</dt>
                        <dd class="mt-1 text-base text-gray-900">{{ $users->nip ?? '-' }}</dd>
                    </div>
                    <div class="sm:col-span-1">
                        <dt class="text-sm font-medium text-gray-500">Email</dt>
                        <dd class="mt-1 text-base text-gray-900">{{ $users->email }}</dd>
                    </div>
                    <div class="sm:col-span-1">
                        <dt class="text-sm font-medium text-gray-500">No. Telepon</dt>
                        <dd class="mt-1 text-base text-gray-900">{{ $users->no_telp ?? '-' }}</dd>
                    </div>
                    <div class="sm:col-span-1">
                        <dt class="text-sm font-medium text-gray-500">Wilayah</dt>
                        <dd class="mt-1 text-base text-gray-900">{{ $users->wilayah ?? '-' }}</dd>
                    </div>
                     <div class="sm:col-span-1">
                        <dt class="text-sm font-medium text-gray-500">Dibuat Pada</dt>
                        <dd class="mt-1 text-base text-gray-900">{{ $users->created_at->format('d F Y, H:i') }}</dd>
                    </div>
                    <div class="sm:col-span-2">
                        <dt class="text-sm font-medium text-gray-500">Alamat</dt>
                        <dd class="mt-1 text-base text-gray-900">
                            {{ $users->alamat ?? '-' }}
                        </dd>
                    </div>
                </dl>
            </div>

            <div class="mt-8 pt-6 border-t border-gray-200 flex justify-end">
                <a href="{{ route('users.index') }}" class="inline-flex items-center px-6 py-2 bg-gray-100 text-gray-800 rounded-lg hover:bg-gray-200 transition-colors duration-300 shadow-md hover:shadow-lg transform hover:-translate-y-px">
                    ← Kembali
                </a>
            </div>
        </div>
    </div>
</div>
@endsection