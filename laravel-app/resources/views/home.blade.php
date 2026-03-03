@extends('layouts.app')

@section('title', 'Dashboard')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight"> Selamat Datang di Sistem Informasi Deteksi Penyakit Padi LPHP BPTPH Sumatera Barat!
        {{-- {{ __('Dashboard') }} --}}
    </h2>
@endsection

@section('content')
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
            @if (session('status'))
                <div class="alert alert-success mb-4" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            {{ __('You are logged in!') }}
        </div>
    </div>
</div>
@endsection
