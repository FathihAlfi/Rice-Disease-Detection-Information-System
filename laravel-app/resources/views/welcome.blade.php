<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selamat Datang di SiDePa - Sistem Deteksi Penyakit Padi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        /* Menggunakan font Poppins untuk keseluruhan halaman */
        body {
            font-family: 'Poppins', sans-serif;
        }
        /* Style untuk background image di hero section */
        .hero-bg {
            background-image: url("{{ asset('images/sawah.jpg') }}");
        }
        /* Menambahkan efek scroll yang mulus saat klik navigasi */
        html {
            scroll-behavior: smooth;
        }
        /* CSS untuk tombol Scroll to Top */
        #scrollToTopBtn {
            opacity: 0; /* Sembunyikan secara default */
            visibility: hidden;
            transform: translateY(1rem); /* Posisi awal sedikit di bawah */
            transition: opacity 0.3s ease-in-out, transform 0.3s ease-in-out, visibility 0.3s;
        }
        #scrollToTopBtn.show {
            opacity: 1; /* Tampilkan */
            visibility: visible;
            transform: translateY(0); /* Kembali ke posisi normal */
        }
    </style>
</head>
<body class="bg-white">

    <header class="absolute top-0 left-0 w-full z-30 bg-transparent">
        <nav class="container mx-auto px-6 py-4 flex justify-between items-center">
            <a class="flex items-center space-x-3" href="#beranda">
                <img src="{{ asset('images/logo.png') }}" alt="Logo LPHP BPTPH" class="h-10 w-10">
                <span class="font-semibold text-lg text-white">LPHP BPTPH</span>
            </a>

            <ul class="hidden md:flex items-center space-x-6">
                <li><a href="#beranda" class="text-white font-semibold hover:text-[#4CAF50] transition-colors duration-300">Beranda</a></li>
                <li><a href="#tentang" class="text-white font-semibold hover:text-[#4CAF50] transition-colors duration-300">Fitur</a></li>
                <li><a href="#penyakit" class="text-white font-semibold hover:text-[#4CAF50] transition-colors duration-300">Penyakit</a></li>
                <li><a href="#panduan" class="text-white font-semibold hover:text-[#4CAF50] transition-colors duration-300">Panduan</a></li>
                <li><a href="mailto:adminbptph@gmail.com" class="bg-white/20 hover:bg-white/30 text-white px-4 py-2 rounded-full shadow transition-all duration-300">Contact Admin</a></li>
            </ul>

            <div class="md:hidden">
                <button id="menu-btn" class="text-white focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                    </svg>
                </button>
            </div>
        </nav>
        
        <div id="mobile-menu" class="hidden md:hidden bg-black/70 backdrop-blur-sm">
            <a href="#beranda" class="block py-3 px-6 text-white text-center hover:bg-white/20">Beranda</a>
            <a href="#tentang" class="block py-3 px-6 text-white text-center hover:bg-white/20">Fitur</a>
            <a href="#penyakit" class="block py-3 px-6 text-white text-center hover:bg-white/20">Penyakit</a>
            <a href="#panduan" class="block py-3 px-6 text-white text-center hover:bg-white/20">Panduan</a>
            <a href="#" class="block py-3 px-6 text-white text-center hover:bg-white/20">Contact Admin</a>
        </div>
    </header>

    <main>
        <section id='beranda' class="relative h-screen flex items-center justify-center text-center text-white hero-bg bg-cover bg-center">
            <div class="absolute inset-0 bg-black/60"></div>
            <div class="relative z-10 px-4">
                <h1 class="text-4xl md:text-6xl font-bold mb-4">Deteksi Dini, Panen Terjaga</h1>
                <p class="text-lg md:text-xl max-w-3xl mx-auto mb-8 font-light">Sistem Cerdas untuk mengidentifikasi penyakit pada tanaman padi di Sumatera Barat. Cepat, Akurat, dan Terpercaya.</p>
                <a href="{{ route('login') }}" class="inline-block bg-[#4CAF50] hover:bg-[#2E7D32] text-white font-semibold px-8 py-4 rounded-full shadow-lg transition-all duration-300 transform hover:-translate-y-1">
                    Mulai Deteksi Sekarang &rarr;
                </a>
            </div>
        </section>

        <section id='tentang' class="py-24 md:h-screen flex items-center justify-center bg-white">
            <div class="container mx-auto px-4 text-center">
                <div>
                    <h2 class="text-3xl md:text-4xl font-bold text-[#2E7D32] mb-4">Fitur Unggulan</h2>
                    <div class="w-24 h-1 bg-[#4CAF50] mx-auto mt-2 mb-12 rounded"></div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-y-12 md:gap-x-10">
                    <div class="feature-card">
                        <div class="flex justify-center mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-[#4CAF50]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-[#2E7D32] mb-2">Sistem Deteksi</h3>
                        <p class="text-gray-600 px-4">Menggunakan AI untuk mengklasifikasikan 4 jenis penyakit utama dengan presisi tinggi dari gambar daun.</p>
                    </div>
                    <div class="feature-card">
                        <div class="flex justify-center mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-[#4CAF50]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-[#2E7D32] mb-2">Laporan Peringatan Bahaya</h3>
                        <p class="text-gray-600 px-4">Menghasilkan laporan tingkat bahaya dan potensi penyebaran untuk tindakan preventif yang cepat.</p>
                    </div>
                    <div class="feature-card">
                        <div class="flex justify-center mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-[#4CAF50]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-[#2E7D32] mb-2">Diagnosa & Rekomendasi</h3>
                        <p class="text-gray-600 px-4">Memberikan hasil diagnosa yang jelas beserta rekomendasi penanganan sesuai standar LPHP BPTPH.</p>
                    </div>
                </div>
            </div>
        </section>

        @php
            $penyakits = [
                [
                    'judul' => 'Blast (Pyricularia oryzae)',
                    'gambar' => 'images/Blast.jpg',
                    'penyebab' => 'Jamur Pyricularia oryzae',
                    'ciri' => 'Bercak belah ketupat dengan tepi coklat dan tengah abu-abu. Jika menyerang leher malai, bisa menyebabkan bulir hampa.'
                ],
                [
                    'judul' => 'Bercak Coklat (Brown Spot)',
                    'gambar' => 'images/brownspot.jpg',
                    'penyebab' => 'Jamur Bipolaris oryzae',
                    'ciri' => 'Muncul bercak coklat bulat hingga oval, dengan halo kuning di sekelilingnya. Umumnya menyerang daun dan pelepah.'
                ],
                [
                    'judul' => 'Hawar Daun (Blight)',
                    'gambar' => 'images/blight.jpeg',
                    'penyebab' => 'Bakteri Xanthomonas oryzae',
                    'ciri' => 'Daun menguning dari ujung, lesi memanjang kuning kecoklatan. Daun menggulung dan kering pada serangan berat.'
                ],
                [
                    'judul' => 'Tungro',
                    'gambar' => 'images/tungro.jpg',
                    'penyebab' => 'Virus RTBV dan RTSV',
                    'ciri' => 'Daun menguning, tanaman kerdil, dan pertumbuhan terhambat. Daun bisa bercak oranye, dan malai kosong.'
                ]
            ];
        @endphp

        <section id="penyakit" class="py-24 md:h-screen flex items-center justify-center bg-[#537D5D]">
            <div class="container mx-auto px-6">
                <div class="text-center mb-12">
                    <h2 class="text-3xl md:text-4xl font-bold text-white">Jenis Penyakit Padi yang Terdeteksi</h2>
                    <div class="w-24 h-1 bg-white bg-opacity-70 mx-auto mt-4 rounded"></div>
                </div>
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    @foreach($penyakits as $penyakit)
                        <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-100 flex flex-col md:flex-row transition-all duration-300 transform hover:-translate-y-2 hover:shadow-2xl">
                            <div class="md:w-1/3 flex-shrink-0 p-4">
                                <img src="{{ asset($penyakit['gambar']) }}" alt="{{ $penyakit['judul'] }}" class="object-cover w-full h-full rounded-lg">
                            </div>
                            <div class="p-6 flex flex-col justify-center">
                                <h3 class="text-xl font-bold text-[#2E7D32] mb-3">{{ $penyakit['judul'] }}</h3>
                                <div class="space-y-2 text-sm text-gray-700">
                                    <p><strong class="font-semibold text-gray-800">Penyebab:</strong> {{ $penyakit['penyebab'] }}</p>
                                    <p><strong class="font-semibold text-gray-800">Ciri-ciri:</strong> {{ $penyakit['ciri'] }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <section id='panduan' class="py-24 md:h-screen flex items-center justify-center bg-white">
            <div class="container mx-auto px-6">
                <div class="text-center mb-12">
                    <h2 class="text-3xl md:text-4xl font-bold text-[#2E7D32]">Bagaimana Cara Kerjanya?</h2>
                    <div class="w-24 h-1 bg-[#4CAF50] mx-auto mt-4 rounded"></div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-y-12 md:gap-x-10 text-center">
                    <div class="step-card">
                        <div class="text-6xl text-[#4CAF50] mb-4">📷</div>
                        <h3 class="text-2xl font-semibold text-[#2E7D32] mb-2">1. Unggah Foto</h3>
                        <p class="text-gray-600">Ambil atau unggah foto daun padi yang terindikasi berpenyakit dengan jelas.</p>
                    </div>
                    <div class="step-card">
                        <div class="text-6xl text-[#4CAF50] mb-4">🔬</div>
                        <h3 class="text-2xl font-semibold text-[#2E7D32] mb-2">2. Proses Analisis</h3>
                        <p class="text-gray-600">Sistem kami akan menganalisis gambar menggunakan teknologi kecerdasan buatan (AI).</p>
                    </div>
                    <div class="step-card">
                        <div class="text-6xl text-[#4CAF50] mb-4">📋</div>
                        <h3 class="text-2xl font-semibold text-[#2E7D32] mb-2">3. Dapatkan Hasil</h3>
                        <p class="text-gray-600">Terima hasil identifikasi penyakit beserta rekomendasi awal penanganan dalam hitungan detik.</p>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer class="bg-[#2E7D32] text-white py-8">
        <div class="container mx-auto px-6 text-center">
            <p class="font-bold">LPHP (Laboratorium Pengamatan Hama dan Penyakit) BPTPH Sumatera Barat</p>
            <p class="text-sm text-white mt-1">Jl. Raya Padang - Indarung No.KM. 8, Bandar Buat, Kec. Lubuk Kilangan, Kota Padang, Sumatera Barat </p>
            <p class="text-sm mt-4">&copy; {{ date('Y') }} Hak Cipta Dilindungi. Dikembangkan untuk mendukung pertanian modern.</p>
        </div>
    </footer>

    <a href="#beranda" id="scrollToTopBtn" class="fixed bottom-8 right-8 z-50 w-14 h-14 rounded-full bg-[#4CAF50] text-white flex items-center justify-center shadow-lg hover:bg-[#2E7D32] focus:outline-none">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M5 15l7-7 7 7" />
        </svg>
    </a>

    <script>
        // Script untuk Scroll to Top
        const scrollToTopBtn = document.getElementById('scrollToTopBtn');
        if (scrollToTopBtn) {
            window.onscroll = function() {
                let scrollThreshold = 400;
                if (document.body.scrollTop > scrollThreshold || document.documentElement.scrollTop > scrollThreshold) {
                    scrollToTopBtn.classList.add('show');
                } else {
                    scrollToTopBtn.classList.remove('show');
                }
            };
        }

        // Script untuk Hamburger Menu
        const menuBtn = document.getElementById('menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');
        const mobileLinks = document.querySelectorAll('#mobile-menu a');

        if (menuBtn && mobileMenu) {
            menuBtn.addEventListener('click', () => {
                mobileMenu.classList.toggle('hidden');
            });

            // Menutup menu saat link di klik (berguna untuk navigasi di halaman yang sama)
            mobileLinks.forEach(link => {
                link.addEventListener('click', () => {
                    mobileMenu.classList.add('hidden');
                });
            });
        }
    </script>    
</body>
</html>