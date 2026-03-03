<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Sistem Deteksi Penyakit Padi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
        .login-bg {
            background-image: url("{{ asset('images/sawah.jpg') }}");
            background-size: cover;
            background-position: center;
        }
    </style>
</head>
<body>

    <div class="login-bg min-h-screen flex flex-col items-center justify-center p-4 relative">
        <div class="absolute inset-0 bg-black/60 z-0"></div>

        <div class="relative z-10 w-full max-w-md bg-white rounded-xl shadow-2xl p-8 space-y-6">
            
            <div class="text-center">
                <a href="/">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" class="mx-auto h-16 w-16 mb-2">
                </a>
                <h2 class="text-2xl font-bold text-[#2E7D32]">Login Akun Anda</h2>
                <p class="text-gray-500 text-sm">Selamat datang kembali, Petugas!</p>
            </div>

            @if (session('status'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 text-sm" role="alert">
                    <p>{{ session('status') }}</p>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf

                <div>
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus 
                           class="w-full px-4 py-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-2 focus:ring-[#4CAF50] focus:border-[#4CAF50] transition">
                    @error('email')
                        <p class="mt-2 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password" class="block mb-2 text-sm font-medium text-gray-900">Password</label>
                    <input id="password" type="password" name="password" required 
                           class="w-full px-4 py-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-2 focus:ring-[#4CAF50] focus:border-[#4CAF50] transition">
                    @error('password')
                        <p class="mt-2 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-between">
                    <div class="flex items-start">
                        <div class="flex items-center h-5">
                            <input id="remember_me" name="remember" type="checkbox" class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-2 focus:ring-[#4CAF50] text-[#4CAF50]">
                        </div>
                        <div class="ml-3 text-sm">
                            <label for="remember_me" class="text-gray-500">Ingat Saya</label>
                        </div>
                    </div>
                    {{-- @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-sm text-[#4CAF50] hover:underline">
                            Lupa Password?
                        </a>
                    @endif --}}
                </div>

                <button type="submit" class="w-full text-white bg-[#4CAF50] hover:bg-[#2E7D32] focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-3 text-center transition-colors duration-300">
                    Login
                </button>
            </form>
        </div>

        <div class="relative z-10 text-center mt-6">
            <p class="text-sm text-gray-300">
                Bukan petugas? 
                <a href="/" class="font-medium text-white hover:underline">Kembali ke Beranda</a>
            </p>
        </div>

    </div>

</body>
</html>