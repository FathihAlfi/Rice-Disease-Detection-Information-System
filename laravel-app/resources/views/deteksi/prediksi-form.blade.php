@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto p-4 space-y-6">
    <h1 class="text-2xl text-white font-bold text-center mt-6">🌾 Deteksi Penyakit Tanaman Padi</h1>

    @if (session('error'))
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-lg" role="alert">
            <p class="font-bold">Terjadi Kegagalan</p>
            <p>{{ session('error') }}</p>
        </div>
    @endif
    
    @if ($errors->any())
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-lg" role="alert">
            <p class="font-bold">Terjadi Kesalahan Validasi:</p>
            <ul class="mt-2 list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-green-100 border border-blue-300 rounded-xl p-4">
        <h2 class="text-lg font-semibold mb-2">📘 Petunjuk Penggunaan</h2>
        <ul class="list-decimal list-inside mt-2">
            <li>Pilih metode input gambar: <em>Upload Gambar</em> atau <em>Gunakan Kamera</em>.</li>
            <li>Upload atau ambil gambar <strong>daun padi yang jelas</strong>.</li>
            <li>Aplikasi akan memprediksi penyakit dan memberikan <strong>saran penanggulangan</strong>.</li>
        </ul>
        <div class="text-sm text-gray-700 mt-2">
            ⚠️ <strong>Catatan:</strong> Model saat ini hanya mengenali 4 penyakit:
            <ul class="list-disc list-inside ml-4">
                <li>Blast</li>
                <li>Blight</li>
                <li>Brownspot</li>
                <li>Tungro</li>
            </ul>
        </div>
    </div>

    <div class="bg-white shadow-md rounded-xl p-4 space-y-4">
        <h2 class="text-lg font-semibold">🖼️ Pilih Metode Input Gambar</h2>

        <form action="{{ route('prediksi.submit') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf

            <div>
                <label for="mode" class="block font-medium">Metode input:</label>
                <select id="mode" name="mode" class="w-full rounded border-gray-300">
                    <option value="">-- Pilih metode --</option>
                    <option value="upload">Upload Gambar</option>
                    <option value="camera">Gunakan Kamera</option>
                </select>
            </div>

            <div id="upload-section" class="hidden">
                <label for="image" class="block font-medium">Upload Gambar:</label>
                <input type="file" name="image" id="image" accept="image/*" class="w-full border p-2 rounded" />
            </div>

            <div id="camera-section" class="hidden">
                <label id="camera-label" class="block font-medium mb-2">Ambil Gambar dari Kamera:</label>
                <div class="flex flex-col items-center space-y-2">
                    <video id="video" autoplay playsinline class="w-full max-w-sm rounded border bg-gray-900" aria-labelledby="camera-label"></video>
                    
                    <img id="photo-preview" class="hidden w-full max-w-sm rounded border">
                    
                    <canvas id="canvas" class="hidden"></canvas>
                    
                    <div id="camera-buttons" class="flex items-center gap-4">
                        <button type="button" id="capture" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                            📸 Ambil Gambar
                        </button>
                        <button type="button" id="retake" class="hidden bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">
                            🔁 Ulangi
                        </button>
                    </div>

                    <p id="capture-feedback" class="text-green-600 font-semibold hidden">✅ Gambar berhasil diambil! Silakan klik 'Deteksi Sekarang'.</p>
                    
                    <input type="hidden" name="camera_image_data" id="camera_image_data">
                </div>
            </div>

            <div class="text-center">
                <button type="submit" class="bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-4 rounded">
                    Deteksi Sekarang
                </button>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const modeSelect = document.getElementById('mode');
    const uploadSection = document.getElementById('upload-section');
    const cameraSection = document.getElementById('camera-section');
    
    // Mendapatkan elemen input
    const uploadInput = document.getElementById('image');
    const cameraImageData = document.getElementById('camera_image_data');
    
    const video = document.getElementById('video');
    const canvas = document.getElementById('canvas');
    const captureButton = document.getElementById('capture');
    const retakeButton = document.getElementById('retake');
    const photoPreview = document.getElementById('photo-preview');
    const captureFeedback = document.getElementById('capture-feedback');

    let stream;

    async function startCamera() {
        try {
            stream = await navigator.mediaDevices.getUserMedia({ video: { facingMode: 'environment' } });
            video.srcObject = stream;
            video.classList.remove('hidden');
            photoPreview.classList.add('hidden');
            captureButton.classList.remove('hidden');
            retakeButton.classList.add('hidden');
        } catch (err) {
            console.error("Error accessing camera: ", err);
            alert("Gagal mengakses kamera: " + err.message);
        }
    }

    function stopCamera() {
        if (stream) {
            stream.getTracks().forEach(track => track.stop());
        }
        video.srcObject = null;
    }

    modeSelect.addEventListener('change', function () {
        uploadSection.classList.add('hidden');
        cameraSection.classList.add('hidden');
        captureFeedback.classList.add('hidden');
        
        // PERBAIKAN: Menonaktifkan kedua input terlebih dahulu
        uploadInput.disabled = true;
        uploadInput.value = '';
        cameraImageData.disabled = true;
        cameraImageData.value = '';

        if (this.value === 'upload') {
            uploadSection.classList.remove('hidden');
            uploadInput.disabled = false; // Aktifkan hanya input upload
            if (stream) stopCamera();
        } else if (this.value === 'camera') {
            cameraSection.classList.remove('hidden');
            cameraImageData.disabled = false; // Aktifkan hanya input data kamera
            startCamera();
        } else {
             if (stream) stopCamera();
        }
    });

    captureButton.addEventListener('click', function () {
        const context = canvas.getContext('2d');
        canvas.width = video.videoWidth;
        canvas.height = video.videoHeight;
        context.drawImage(video, 0, 0, canvas.width, canvas.height);
        
        const imageDataURL = canvas.toDataURL('image/png');
        
        photoPreview.src = imageDataURL;
        photoPreview.classList.remove('hidden');
        video.classList.add('hidden');
        
        cameraImageData.value = imageDataURL;
        
        captureButton.classList.add('hidden');
        retakeButton.classList.remove('hidden');
        
        captureFeedback.classList.remove('hidden');
        setTimeout(() => {
            captureFeedback.classList.add('hidden');
        }, 4000);
    });

    retakeButton.addEventListener('click', function() {
        video.classList.remove('hidden');
        photoPreview.classList.add('hidden');
        captureButton.classList.remove('hidden');
        retakeButton.classList.add('hidden');
        cameraImageData.value = '';
    });

    // Kondisi awal saat halaman dimuat
    uploadInput.disabled = true;
    cameraImageData.disabled = true;
});
</script>
@endsection
