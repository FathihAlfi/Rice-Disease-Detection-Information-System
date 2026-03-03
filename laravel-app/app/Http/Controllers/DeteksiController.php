<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\DeteksiCnn;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DeteksiController extends Controller
{
    public function form()
    {
        return view('deteksi.prediksi-form');
    }

    public function prediksi(Request $request)
    {
        $request->validate([
            'mode' => 'required|in:upload,camera',
            'image' => 'required_if:mode,upload|image|mimes:jpeg,png,jpg|max:2048',
            'camera_image_data' => 'required_if:mode,camera|string',
        ], [
            'image.required_if' => 'Mohon upload sebuah gambar.',
            'camera_image_data.required_if' => 'Mohon ambil gambar dari kamera terlebih dahulu.',
        ]);

        $path = '';
        $fileContents = null;
        $originalName = '';

        // Logika untuk menangani mode upload
        if ($request->mode == 'upload') {
            $file = $request->file('image');
            
            // --- PERBAIKAN UTAMA ---
            // 1. Simpan file ke storage terlebih dahulu. Ini akan menghasilkan path yang unik dan aman.
            $path = $file->store('uploads', 'public');
            
            // 2. Baca konten dari file yang BARU saja disimpan. Ini lebih andal.
            $fileContents = Storage::disk('public')->get($path);
            
            $originalName = $file->getClientOriginalName();
        } 
        // Logika untuk menangani mode kamera
        elseif ($request->mode == 'camera') {
            $imageData = $request->input('camera_image_data');
            
            $imageData = preg_replace('/^data:image\/\w+;base64,/', '', $imageData);
            $decodedImage = base64_decode($imageData);

            $filename = 'uploads/' . Str::random(40) . '.png';
            Storage::disk('public')->put($filename, $decodedImage);
            
            $path = $filename;
            $fileContents = $decodedImage;
            $originalName = 'camera_capture.png';
        }

        try {
            // Menambahkan timeout 30 detik untuk permintaan ke API
            $response = Http::timeout(30)->attach(
                'file', $fileContents, $originalName
            )->post('http://localhost:5000/predict');

            if ($response->successful()) {
                $hasil = $response->json();

                if(isset($hasil['error'])) {
                    return redirect()->back()->with('error', 'API deteksi mengembalikan error: ' . $hasil['error']);
                }

                $deteksi = DeteksiCnn::create([
                    'user_id' => Auth::id(),
                    'label' => $hasil['label'],
                    'pengendalian' => $hasil['rekomendasi'],
                    'gambar' => $path,
                    'confidence' => $hasil['confidence'] ?? 0
                ]);

                return view('deteksi.hasil', [
                    'label' => $hasil['label'],
                    'confidence' => $hasil['confidence'],
                    'rekomendasi' => $hasil['rekomendasi'],
                    'gambar' => asset('storage/' . $path),
                    'deteksi_id' => $deteksi->deteksi_id
                ]);
            } else {
                return redirect()->back()->with('error', 'Gagal mendapatkan respons dari API. Status: ' . $response->status() . '. Pesan: ' . $response->body());
            }
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            return redirect()->back()->with('error', 'Tidak dapat terhubung ke server deteksi. Pastikan API Python (Flask) Anda sedang berjalan. Detail Error: ' . $e->getMessage());
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan umum: ' . $e->getMessage());
        }
    }
}
