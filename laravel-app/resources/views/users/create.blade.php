@extends('layouts.app')

@section('title', 'Form Tambah User Baru')

@section('content')
{{-- MODIFIED: Container utama diubah untuk menengahkan kartu form di sisa layar --}}
<div class="min-h-[calc(100vh-10.5rem)] flex items-center justify-center p-4 sm:p-6 lg:p-8">

    {{-- MODIFIED: Kartu form dengan style baru dan lebar maksimal --}}
    <div class="w-full max-w-4xl bg-white rounded-xl shadow-lg p-6 md:p-8">
        <h2 class="text-2xl font-bold text-gray-700 mb-6 border-b pb-4">
                ✏️ Form Create User
            </h2>

        <form action="{{ route('users.store') }}" method="POST">
            @csrf

           <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-5">

                {{-- 1. NAMA --}}
                <div>
                    <label for="nama" class="block font-medium text-sm text-gray-700">Nama</label>
                    <input type="text" id="nama" name="nama" value="{{ old('nama') }}" required
                        @class([
                            'mt-1 block w-full rounded-lg shadow-sm transition',
                            'border-red-500 focus:border-red-500 focus:ring-red-500 text-red-900' => $errors->has('nama'),
                            'border-gray-300 focus:border-[#4CAF50] focus:ring-[#4CAF50]' => !$errors->has('nama'),
                        ])
                    >
                    @error('nama')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- 2. NIP --}}
                <div>
                    <label for="nip" class="block font-medium text-sm text-gray-700">NIP</label>
                    <input type="text" id="nip" name="nip" value="{{ old('nip') }}"
                        @class([
                            'mt-1 block w-full rounded-lg shadow-sm transition',
                            'border-red-500 focus:border-red-500 focus:ring-red-500 text-red-900' => $errors->has('nip'),
                            'border-gray-300 focus:border-[#4CAF50] focus:ring-[#4CAF50]' => !$errors->has('nip'),
                        ])
                    >
                    @error('nip')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- 3. EMAIL --}}
                <div>
                    <label for="email" class="block font-medium text-sm text-gray-700">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required
                        @class([
                            'mt-1 block w-full rounded-lg shadow-sm transition',
                            'border-red-500 focus:border-red-500 focus:ring-red-500 text-red-900' => $errors->has('email'),
                            'border-gray-300 focus:border-[#4CAF50] focus:ring-[#4CAF50]' => !$errors->has('email'),
                        ])
                    >
                    @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- 4. NO TELEPON --}}
                <div>
                    <label for="no_telp" class="block font-medium text-sm text-gray-700">No. Telepon</label>
                    <input type="text" id="no_telp" name="no_telp" value="{{ old('no_telp') }}"
                        @class([
                            'mt-1 block w-full rounded-lg shadow-sm transition',
                            'border-red-500 focus:border-red-500 focus:ring-red-500 text-red-900' => $errors->has('no_telp'),
                            'border-gray-300 focus:border-[#4CAF50] focus:ring-[#4CAF50]' => !$errors->has('no_telp'),
                        ])
                    >
                    @error('no_telp')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- 5. PASSWORD --}}
                <div>
                    <label for="password" class="block font-medium text-sm text-gray-700">Password</label>
                    <input type="password" id="password" name="password" required
                        @class([
                            'mt-1 block w-full rounded-lg shadow-sm transition',
                            'border-red-500 focus:border-red-500 focus:ring-red-500 text-red-900' => $errors->has('password'),
                            'border-gray-300 focus:border-[#4CAF50] focus:ring-[#4CAF50]' => !$errors->has('password'),
                        ])
                    >
                    @error('password')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- 6. KONFIRMASI PASSWORD --}}
                <div>
                    <label for="password_confirmation" class="block font-medium text-sm text-gray-700">Konfirmasi Password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" required
                        class="mt-1 block w-full rounded-lg shadow-sm transition border-gray-300 focus:border-[#4CAF50] focus:ring-[#4CAF50]"
                    >
                </div>

                {{-- 7. ROLE --}}
                <div>
                    <label for="role_id" class="block font-medium text-sm text-gray-700">Role</label>
                    <select id="role_id" name="role_id"
                        @class([
                            'mt-1 block w-full rounded-lg shadow-sm transition',
                            'border-red-500 focus:border-red-500 focus:ring-red-500 text-red-900' => $errors->has('role_id'),
                            'border-gray-300 focus:border-[#4CAF50] focus:ring-[#4CAF50]' => !$errors->has('role_id'),
                        ])
                    >
                        @foreach ($roles as $role)
                            <option value="{{ $role->role_id }}" {{ old('role_id') == $role->role_id ? 'selected' : '' }}>
                                {{ $role->nama_role }}
                            </option>
                        @endforeach
                    </select>
                    @error('role_id')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- 8. WILAYAH --}}
                <div>
                    <label for="wilayah" class="block font-medium text-sm text-gray-700">Wilayah</label>
                    <input type="text" id="wilayah" name="wilayah" value="{{ old('wilayah') }}"
                        @class([
                            'mt-1 block w-full rounded-lg shadow-sm transition',
                            'border-red-500 focus:border-red-500 focus:ring-red-500 text-red-900' => $errors->has('wilayah'),
                            'border-gray-300 focus:border-[#4CAF50] focus:ring-[#4CAF50]' => !$errors->has('wilayah'),
                        ])
                    >
                    @error('wilayah')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- 9. ALAMAT --}}
                <div class="md:col-span-2">
                    <label for="alamat" class="block font-medium text-sm text-gray-700">Alamat</label>
                    <input type="text" id="alamat" name="alamat" value="{{ old('alamat') }}"
                        @class([
                            'mt-1 block w-full rounded-lg shadow-sm transition',
                            'border-red-500 focus:border-red-500 focus:ring-red-500 text-red-900' => $errors->has('alamat'),
                            'border-gray-300 focus:border-[#4CAF50] focus:ring-[#4CAF50]' => !$errors->has('alamat'),
                        ])
                    >
                    @error('alamat')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

            </div>
            
            {{-- MODIFIED: Tombol dengan style tema --}}
            <div class="mt-8 flex justify-end space-x-4">
                <a href="{{ route('users.index') }}" class="px-6 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-100 transition-colors duration-300 shadow-md hover:shadow-lg transform hover:-translate-y-px">
                    Batal
                </a>
                <button type="submit" class="px-6 py-2 bg-[#4CAF50] text-white font-semibold rounded-lg hover:bg-[#2E7D32] transition-colors duration-300 shadow-md hover:shadow-lg transform hover:-translate-y-px">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection