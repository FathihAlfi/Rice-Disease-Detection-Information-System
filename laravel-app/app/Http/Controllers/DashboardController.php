<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\DeteksiCnn;
use App\Models\Lpb;
use App\Models\Permohonan;
use App\Models\DiagnosaRekomendasi;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // --- 1. Data Kartu Statistik (Tidak Berubah) ---
        $totalUsers = User::count();
        $totalDeteksi = DeteksiCnn::count();
        $lpbFromDeteksi = Lpb::whereNotNull('deteksi_id')->count();
        $lpbManual = Lpb::whereNull('deteksi_id')->count();
        $totalPermohonan = Permohonan::count();
        $totalDiagnosa = DiagnosaRekomendasi::count();

        // --- 2. Logika Filter Grafik ---
        $selectedPeriode = $request->input('periode', Carbon::now()->format('Y'));
        $chartTitle = '';
        
        $permohonanQuery = Permohonan::query();
        $diagnosaQuery = DiagnosaRekomendasi::query();
        $lpbQuery = Lpb::query();
        $deteksiQuery = DeteksiCnn::query();

        if (strlen($selectedPeriode) == 7) { // Filter Bulanan (Y-m)
            $date = Carbon::createFromFormat('Y-m', $selectedPeriode);
            $year = $date->year;
            $month = $date->month;
            $daysInMonth = $date->daysInMonth;
            $chartTitle = 'Aktivitas Harian Bulan ' . $date->translatedFormat('F Y');

            $chartLabels = range(1, $daysInMonth);
            $dateFormat = "DAY(created_at)";

            $permohonanQuery->whereYear('created_at', $year)->whereMonth('created_at', $month);
            $diagnosaQuery->whereYear('created_at', $year)->whereMonth('created_at', $month);
            $lpbQuery->whereYear('created_at', $year)->whereMonth('created_at', $month);
            $deteksiQuery->whereYear('created_at', $year)->whereMonth('created_at', $month);

        } else { // Filter Tahunan (Y)
            $year = $selectedPeriode;
            $chartTitle = 'Aktivitas Bulanan Tahun ' . $year;
            $chartLabels = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ags', 'Sep', 'Okt', 'Nov', 'Des'];
            $dateFormat = "MONTH(created_at)";
            
            $permohonanQuery->whereYear('created_at', $year);
            $diagnosaQuery->whereYear('created_at', $year);
            $lpbQuery->whereYear('created_at', $year);
            $deteksiQuery->whereYear('created_at', $year);
        }

        // Fungsi untuk memetakan data ke array grafik
        $mapData = function($query, $dateFormat, $labelCount) {
            $data = $query->select(DB::raw("COUNT(*) as count"), DB::raw("$dateFormat as period"))
                          ->groupBy('period')->pluck('count', 'period')->all();
            $result = array_fill(0, $labelCount, 0);
            foreach ($data as $period => $count) {
                $result[$period - 1] = $count;
            }
            return $result;
        };

        $labelCount = count($chartLabels);
        $permohonanChartData = $mapData($permohonanQuery, $dateFormat, $labelCount);
        $diagnosaChartData = $mapData($diagnosaQuery, $dateFormat, $labelCount);
        $lpbChartData = $mapData($lpbQuery, $dateFormat, $labelCount);
        $deteksiChartData = $mapData($deteksiQuery, $dateFormat, $labelCount);

        // --- 3. Menyiapkan Opsi Dropdown (Cek ke Semua Tabel) ---
        
        // Ambil Tahun Unik dari semua tabel aktivitas
        $years = collect()
            ->merge(Permohonan::selectRaw('YEAR(created_at) as year')->distinct()->pluck('year'))
            ->merge(DeteksiCnn::selectRaw('YEAR(created_at) as year')->distinct()->pluck('year'))
            ->merge(Lpb::selectRaw('YEAR(created_at) as year')->distinct()->pluck('year'))
            ->merge(DiagnosaRekomendasi::selectRaw('YEAR(created_at) as year')->distinct()->pluck('year'))
            ->unique()->sortDesc();

        // Ambil Bulan Unik dari semua tabel aktivitas
        $months = collect()
            ->merge(Permohonan::selectRaw("DATE_FORMAT(created_at, '%Y-%m') as month")->distinct()->pluck('month'))
            ->merge(DeteksiCnn::selectRaw("DATE_FORMAT(created_at, '%Y-%m') as month")->distinct()->pluck('month'))
            ->merge(Lpb::selectRaw("DATE_FORMAT(created_at, '%Y-%m') as month")->distinct()->pluck('month'))
            ->merge(DiagnosaRekomendasi::selectRaw("DATE_FORMAT(created_at, '%Y-%m') as month")->distinct()->pluck('month'))
            ->unique()->sortDesc();

        $availablePeriods = [];
        
        // Masukkan tahun ke daftar
        foreach ($years as $y) { 
            $availablePeriods[] = ['value' => (string)$y, 'text' => 'Tahun ' . $y]; 
        }
        
        // Masukkan bulan ke daftar
        foreach ($months as $m) { 
            $availablePeriods[] = [
                'value' => $m, 
                'text' => Carbon::createFromFormat('Y-m', $m)->translatedFormat('F Y') 
            ]; 
        }

        // Urutkan agar periode terbaru (misal: Jan 2026 atau Tahun 2026) berada di paling atas
        usort($availablePeriods, fn($a, $b) => strcmp($b['value'], $a['value']));

        // --- 4. Mengirim Semua Data ke View ---
        return view('dashboard', compact(
            'totalUsers', 'totalDeteksi', 'lpbFromDeteksi', 'lpbManual', 'totalPermohonan', 'totalDiagnosa',
            'chartLabels', 'permohonanChartData', 'diagnosaChartData', 'lpbChartData', 'deteksiChartData',
            'availablePeriods', 'selectedPeriode', 'chartTitle'
        ));
    }
}