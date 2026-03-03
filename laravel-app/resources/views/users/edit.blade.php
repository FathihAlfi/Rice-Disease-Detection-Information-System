@extends('layouts.app')

@section('title', 'Edit User')

@section('content')
{{-- MODIFIED: Wrapper untuk centering vertikal & horizontal --}}
<div class="min-h-[calc(100vh-10.5rem)] flex items-center justify-center p-4 sm:p-6 lg:p-8">

    <div class="w-full max-w-4xl">
        {{-- MODIFIED: Style kartu, input, dan tombol disesuaikan dengan tema --}}
        <div class="bg-white p-6 sm:p-8 shadow-xl rounded-2xl">
            <h2 class="text-2xl font-bold text-[#2E7D32] mb-6 border-b pb-4">
                ✏️ Formulir Edit User
            </h2>

            <form action="{{ route('users.update', $user->user_id) }}" method="POST">
                @csrf
                @method('PUT')

                @php
                    // Mendefinisikan style input agar konsisten
                    $inputStyle = "mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-[#4CAF50] focus:ring focus:ring-[#4CAF50] focus:ring-opacity-50 transition";
                @endphp

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="nama" class="block font-medium text-sm text-gray-700">Nama</label>
                        <input type="text" id="nama" name="nama" value="{{ old('nama', $user->nama) }}" class="{{ $inputStyle }}" required>
                    </div>

                    <div>
                        <label for="nip" class="block font-medium text-sm text-gray-700">NIP</label>
                        <input type="text" id="nip" name="nip" value="{{ old('nip', $user->nip) }}" class="{{ $inputStyle }}">
                    </div>

                    <div>
                        <label for="no_telp" class="block font-medium text-sm text-gray-700">No. Telp</label>
                        <input type="text" id="no_telp" name="no_telp" value="{{ old('no_telp', $user->no_telp) }}" class="{{ $inputStyle }}">
                    </div>

                    <div>
                        <label for="wilayah" class="block font-medium text-sm text-gray-700">Wilayah</label>
                        <input type="text" id="wilayah" name="wilayah" value="{{ old('wilayah', $user->wilayah) }}" class="{{ $inputStyle }}">
                    </div>

                    <div class="md:col-span-2">
                        <label for="alamat" class="block font-medium text-sm text-gray-700">Alamat</label>
                        <textarea id="alamat" name="alamat" rows="3" class="{{ $inputStyle }}">{{ old('alamat', $user->alamat) }}</textarea>
                    </div>

                    <div class="md:col-span-2">
                        <label for="role_id" class="block font-medium text-sm text-gray-700">Role</label>
                        <select id="role_id" name="role_id" class="{{ $inputStyle }}">
                            @foreach ($roles as $role)
                                <option value="{{ $role->role_id }}" {{ $role->role_id == $user->role_id ? 'selected' : '' }}>
                                    {{ $role->nama_role }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="mt-8 pt-6 border-t border-gray-200 flex justify-end space-x-4">
                    <a href="{{ route('users.index') }}" class="px-6 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-100 transition-colors duration-300 shadow-md hover:shadow-lg transform hover:-translate-y-px">
                    Batal
                    </a>
                    <button type="submit" class="px-6 py-2 bg-[#4CAF50] text-white font-semibold rounded-lg hover:bg-[#2E7D32] transition-colors duration-300 shadow-md hover:shadow-lg transform hover:-translate-y-px">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection