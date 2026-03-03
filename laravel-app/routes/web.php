<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DeteksiController;
use App\Http\Controllers\LpbController;
use App\Http\Controllers\DiagnosaRekomendasiController;
use App\Http\Controllers\PermohonanController;
use App\Http\Controllers\JenisTanamanController;
use App\Http\Controllers\VarietasTanamanController;
use App\Http\Controllers\MetodeDiagnosaController;
use App\Http\Controllers\PengendalianController;
use App\Http\Controllers\UserLokasiController;
use App\Http\Controllers\DashboardController;


// Guest / Welcome Page
Route::get('/', function () {
    return view('welcome');
});

// Dashboard (butuh login)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Auth routes group
Route::middleware(['auth'])->group(function () {

    // Profile & Password
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    // Kelola Users
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');

    // Deteksi Gambar
    Route::get('/deteksi', [DeteksiController::class, 'form'])->name('prediksi.form');
    Route::post('/deteksi/prediksi', [DeteksiController::class, 'prediksi'])->name('prediksi.submit');

    // LPB - Buat dari Hasil Deteksi (letakkan sebelum resource)
    Route::get('/lpb/create/from-deteksi/{deteksi_id}', [LpbController::class, 'createFromDeteksi'])->name('lpb.create.from.deteksi');

    // LPB - Cetak dan Edit Manual
    Route::get('lpb/{no_surat}/cetak', [LpbController::class, 'cetakPDF'])->name('lpb.cetak')->where('no_surat', '.*');
    Route::get('/lpb/{no_surat}/edit', [LpbController::class, 'edit'])->name('lpb.edit')->where('no_surat', '.*');

     // --- ROUTE BARU UNTUK EKSPOR EXCEL ---
    Route::get('/lpb/export/excel', [LpbController::class, 'exportExcel'])->name('lpb.export.excel');

    // LPB - Resource
    Route::resource('lpb', LpbController::class)
        ->except(['edit'])
        ->parameters(['lpb' => 'no_surat'])
        ->where(['no_surat' => '.*']);


    // Permohonan Diagnosa
    // Menambahkan ->where('permohonan', '.*') untuk mengizinkan karakter '/'
    Route::get('/permohonan/{permohonan}/cetak', [PermohonanController::class, 'cetakPDF'])
         ->where('permohonan', '.*') 
         ->name('permohonan.cetak');
    
     // Rute untuk aksi persetujuan dan penolakan
    Route::patch('/permohonan/{permohonan}/approve', [PermohonanController::class, 'approve'])->where('permohonan', '.*')->name('permohonan.approve');
    Route::patch('/permohonan/{permohonan}/reject', [PermohonanController::class, 'reject'])->where('permohonan', '.*')->name('permohonan.reject'); // Tetap PATCH, karena kita mengupdate resource
    
    // PERBAIKAN: Mendefinisikan route 'edit' secara manual agar lebih eksplisit
    Route::get('/permohonan/{permohonan}/edit', [PermohonanController::class, 'edit'])->where('permohonan', '.*')->name('permohonan.edit');
    
    // PERBAIKAN: Mengecualikan 'edit' dari resource karena sudah didefinisikan di atas
    Route::resource('permohonan', PermohonanController::class)
         ->except(['edit'])
         ->where(['permohonan' => '.*']);


    Route::middleware('auth')->group(function () {

    // --- Route untuk Modul Diagnosa Rekomendasi ---
    
    Route::get('/diagnosa/create/{permohonan}', [DiagnosaRekomendasiController::class, 'create'])
         ->where('permohonan', '.*')
         ->name('diagnosa.create');
    
    Route::get('/diagnosa/export/excel', [DiagnosaRekomendasiController::class, 'exportExcel'])->name('diagnosa.export.excel');
    
    Route::get('/diagnosa/{diagnosa}/cetak', [DiagnosaRekomendasiController::class, 'cetakPDF'])
         ->where('diagnosa', '.*')
         ->name('diagnosa.cetak');

    Route::get('/diagnosa/{diagnosa}/edit', [DiagnosaRekomendasiController::class, 'edit'])
         ->where('diagnosa', '.*')
         ->name('diagnosa.edit');

    // --- PERBAIKAN UTAMA: Menambahkan .where() pada semua route aksi ---
    Route::patch('/diagnosa/{diagnosa}/periksa', [DiagnosaRekomendasiController::class, 'periksa'])
         ->where('diagnosa', '.*')
         ->name('diagnosa.periksa');

    Route::patch('/diagnosa/{diagnosa}/setujui', [DiagnosaRekomendasiController::class, 'setujui'])
         ->where('diagnosa', '.*')
         ->name('diagnosa.setujui');

    Route::patch('/diagnosa/{diagnosa}/sahkan', [DiagnosaRekomendasiController::class, 'sahkan'])
         ->where('diagnosa', '.*')
         ->name('diagnosa.sahkan');

    Route::patch('/diagnosa/{diagnosa}/revisi', [DiagnosaRekomendasiController::class, 'revisi'])
         ->where('diagnosa', '.*')
         ->name('diagnosa.revisi');
    
    // Resource controller sudah benar
    Route::resource('diagnosa', DiagnosaRekomendasiController::class)
         ->except(['create', 'edit']) // 'edit' juga dikecualikan karena sudah didefinisikan di atas
         ->where(['diagnosa' => '.*']);
});

    // Diagnosa dan Rekomendasi - Master Data
    // Jenis Penyakit
    Route::resource('jenis', JenisTanamanController::class);
    // Varietas Penyakit
    Route::resource('varietas', VarietasTanamanController::class);
    // Metode Diagnosa
    Route::resource('metode', MetodeDiagnosaController::class);
    // Pengendalian Penyakit
    Route::resource('pengendalian', PengendalianController::class);

    // Route untuk Modul User Lokasi
    Route::resource('user-lokasi', UserLokasiController::class)
     ->only(['index', 'store', 'destroy'])
     ->names('userlokasi');

     // --- Route BARU untuk Dropdown Bertingkat (AJAX) ---
     // Route ini akan dipanggil oleh JavaScript untuk mengambil data.
     Route::get('/api/get-kecamatan', [UserLokasiController::class, 'getKecamatan'])->name('api.kecamatan');
     Route::get('/api/get-nagari', [UserLokasiController::class, 'getNagari'])->name('api.nagari');
     Route::get('/api/get-jorong', [UserLokasiController::class, 'getJorong'])->name('api.jorong');
    });


// Auth scaffolding
require __DIR__.'/auth.php';
