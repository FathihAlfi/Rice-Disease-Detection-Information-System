@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        
        <h2 class="mb-6 text-3xl font-bold text-white">Dashboard Informational</h2>

        {{-- PERBAIKAN LAYOUT: Kartu statistik sekarang dalam dua grup grid --}}
        {{-- Grup 1: 3 Kartu di baris pertama --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
            <div class="bg-white rounded-xl shadow-lg p-6 flex items-center gap-4">
                <div class="bg-blue-100 p-3 rounded-full"><svg class="h-8 w-8 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg></div>
                <div><p class="text-sm text-gray-500">Jumlah Pengguna</p><p class="text-2xl font-bold text-gray-800">{{ $totalUsers }}</p></div>
            </div>
            <div class="bg-white rounded-xl shadow-lg p-6 flex items-center gap-4">
                <div class="bg-indigo-100 p-3 rounded-full"><svg class="h-8 w-8 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg></div>
                <div><p class="text-sm text-gray-500">Total Deteksi AI</p><p class="text-2xl font-bold text-gray-800">{{ $totalDeteksi }}</p></div>
            </div>
            <div class="bg-white rounded-xl shadow-lg p-6 flex items-center gap-4">
                <div class="bg-red-100 p-3 rounded-full"><svg class="h-8 w-8 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg></div>
                <div><p class="text-sm text-gray-500">Total LPB</p><p class="text-2xl font-bold text-gray-800">{{ $lpbFromDeteksi + $lpbManual }}</p><p class="text-xs text-gray-400">Deteksi: {{ $lpbFromDeteksi }} | Manual: {{ $lpbManual }}</p></div>
            </div>
        </div>
        {{-- Grup 2: 2 Kartu di baris kedua, memenuhi ruang --}}
        <div class="lg:col-span-2 grid grid-cols-1 sm:grid-cols-2 gap-6 mb-8">
             <div class="bg-white rounded-xl shadow-lg p-6 flex items-center gap-4">
                <div class="bg-yellow-100 p-3 rounded-full"><svg class="h-8 w-8 text-yellow-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg></div>
                <div><p class="text-sm text-gray-500">Permohonan Diagnosa</p><p class="text-2xl font-bold text-gray-800">{{ $totalPermohonan }}</p></div>
            </div>
             <div class="bg-white rounded-xl shadow-lg p-6 flex items-center gap-4">
                <div class="bg-green-100 p-3 rounded-full"><svg class="h-8 w-8 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg></div>
                <div><p class="text-sm text-gray-500">Laporan Diagnosa</p><p class="text-2xl font-bold text-gray-800">{{ $totalDiagnosa }}</p></div>
            </div>
        </div>

        {{-- Grafik Utama --}}
        <div class="bg-white rounded-xl shadow-lg p-6">
            <div class="flex flex-col sm:flex-row justify-between items-center mb-4">
                <h3 class="text-xl font-semibold text-gray-800">{{ $chartTitle }}</h3>
                <form action="{{ route('dashboard') }}" method="GET" class="flex items-center gap-2 mt-4 sm:mt-0">
                    <select name="periode" class="rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        @foreach($availablePeriods as $period)
                            <option value="{{ $period['value'] }}" {{ $selectedPeriode == $period['value'] ? 'selected' : '' }}>
                                {{ $period['text'] }}
                            </option>
                        @endforeach
                    </select>
                    <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700">Terapkan</button>
                </form>
            </div>
            <div>
                <canvas id="mainChart"></canvas>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Mengambil semua data yang dikirim dari controller
    const chartLabels = @json($chartLabels);
    const permohonanData = @json($permohonanChartData);
    const diagnosaData = @json($diagnosaChartData);
    const lpbData = @json($lpbChartData);
    const deteksiData = @json($deteksiChartData);

    const data = {
        labels: chartLabels,
        datasets: [
            {
                label: 'Permohonan',
                backgroundColor: 'rgba(59, 130, 246, 0.5)',
                borderColor: 'rgba(59, 130, 246, 1)',
                data: permohonanData,
                tension: 0.2,
                borderWidth: 2
            },
            {
                label: 'Diagnosa',
                backgroundColor: 'rgba(16, 185, 129, 0.5)',
                borderColor: 'rgba(16, 185, 129, 1)',
                data: diagnosaData,
                tension: 0.2,
                borderWidth: 2
            },
            // --- PENAMBAHAN DATASET BARU ---
            {
                label: 'LPB',
                backgroundColor: 'rgba(239, 68, 68, 0.5)', // Warna Merah
                borderColor: 'rgba(239, 68, 68, 1)',
                data: lpbData,
                tension: 0.2,
                borderWidth: 2
            },
            {
                label: 'Deteksi AI',
                backgroundColor: 'rgba(139, 92, 246, 0.5)', // Warna Ungu
                borderColor: 'rgba(139, 92, 246, 1)',
                data: deteksiData,
                tension: 0.2,
                borderWidth: 2
            }
        ]
    };

    const config = {
        type: 'bar',        
        data: data,
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1,
                        callback: function(value) {if (Number.isInteger(value)) {return value;}}
                    }
                }
            }
        }
    };

    const myChart = new Chart(document.getElementById('mainChart'), config);
</script>
@endsection
