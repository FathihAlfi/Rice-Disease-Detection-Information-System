@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto p-6">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        <!-- Kolom Tabel Lokasi Tugas -->
        <div class="lg:col-span-2 bg-white border rounded-lg p-6 shadow-sm">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Daftar Lokasi Tugas Pengguna</h2>
            @if(session('success'))
                <div class="bg-green-100 border border-green-300 text-green-700 p-3 rounded mb-4">{{ session('success') }}</div>
            @endif
            @if($userLokasis->isEmpty())
                <p class="text-gray-500">Belum ada data lokasi tugas.</p>
            @else
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead class="border-b bg-gray-50">
                            <tr>
                                <th class="p-3 text-sm font-bold text-gray-500 uppercase">Pengguna</th>
                                <th class="p-3 text-sm font-bold text-gray-500 uppercase">Lokasi</th>
                                <th class="p-3 text-sm font-bold text-gray-500 uppercase text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($userLokasis as $lokasi)
                            <tr class="border-b hover:bg-gray-50 transition">
                                <td class="p-3 text-gray-900 font-medium">{{ $lokasi->user->nama ?? 'N/A' }}</td>
                                <td class="p-3 text-gray-900 text-sm">
                                    {{ $lokasi->kabkot->nama_kabkot ?? '-' }} &rarr;
                                    {{ $lokasi->kecamatan->nama_kecamatan ?? '-' }} &rarr;
                                    {{ $lokasi->nagari->nama_nagari ?? '-' }} &rarr;
                                    <strong>{{ $lokasi->jorong->nama_jorong ?? '-' }}</strong>
                                </td>
                                <td class="p-3 text-center">
                                    {{-- PERBAIKAN: Mengubah form untuk menggunakan modal --}}
                                    <form id="delete-form-{{ $lokasi->userlokasi_id }}" action="{{ route('userlokasi.destroy', $lokasi->userlokasi_id) }}" method="POST">
                                        @csrf 
                                        @method('DELETE')
                                        <button type="button" data-form-id="delete-form-{{ $lokasi->userlokasi_id }}" class="delete-button bg-red-600 hover:bg-red-700 text-white px-4 py-1 rounded text-sm shadow">
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>

        <!-- Kolom Form Tambah Lokasi (Lengkap) -->
        <div class="lg:col-span-1 bg-white border rounded-lg p-6 shadow-sm h-fit">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Tambah Lokasi Tugas</h2>

            <form method="POST" action="{{ route('userlokasi.store') }}" class="space-y-4">
                @csrf
                
                <!-- Pilih Pengguna -->
                <div>
                    <label for="user_id" class="block font-medium text-gray-700">Pengguna</label>
                    <select id="user_id" name="user_id" class="mt-1 w-full border-gray-300 rounded-md shadow-sm" required>
                        <option value="" disabled selected>-- Pilih Pengguna --</option>
                        @foreach($users as $user)
                            <option value="{{ $user->user_id }}" {{ old('user_id') == $user->user_id ? 'selected' : '' }}>{{ $user->nama }}</option>
                        @endforeach
                    </select>
                    @error('user_id') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Dropdown Bertingkat -->
                <div>
                    <label for="kabkot_id" class="block font-medium text-gray-700">Kabupaten/Kota</label>
                    <select id="kabkot_id" name="kabkot_id" class="mt-1 w-full border-gray-300 rounded-md shadow-sm" required>
                        <option value="">-- Pilih Kab/Kota --</option>
                        @foreach($kabkots as $item)
                            <option value="{{ $item->kabkot_id }}">{{ $item->nama_kabkot }}</option>
                        @endforeach
                    </select>
                </div>
                
                <div>
                    <label for="kecamatan_id" class="block font-medium text-gray-700">Kecamatan</label>
                    <select id="kecamatan_id" name="kecamatan_id" class="mt-1 w-full border-gray-300 rounded-md shadow-sm" required disabled>
                        <option value="">-- Pilih Kecamatan --</option>
                    </select>
                </div>

                <div>
                    <label for="nagari_id" class="block font-medium text-gray-700">Nagari</label>
                    <select id="nagari_id" name="nagari_id" class="mt-1 w-full border-gray-300 rounded-md shadow-sm" required disabled>
                        <option value="">-- Pilih Nagari --</option>
                    </select>
                </div>

                <!-- Pilihan Jorong (Dropdown & Manual) -->
                <div id="jorong-dropdown-container">
                    <label for="jorong_id" class="block font-medium text-gray-700">Jorong</label>
                    <select id="jorong_id" name="jorong_id" class="mt-1 w-full border-gray-300 rounded-md shadow-sm" required disabled>
                        <option value="">-- Pilih Jorong --</option>
                    </select>
                </div>
                <div id="jorong-manual-container" style="display: none;">
                    <label for="nama_jorong_baru" class="block font-medium text-gray-700">Nama Jorong Baru</label>
                    <input type="text" name="nama_jorong_baru" id="nama_jorong_baru" class="mt-1 w-full border-gray-300 rounded-md shadow-sm">
                </div>
                <button type="button" id="tambah-jorong-btn" class="text-sm text-blue-600 hover:underline mt-1" style="display: none;">Jorong tidak ada di daftar? Tambah baru.</button>

                <div>
                    <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white px-5 py-2 rounded-md shadow transition">Tambah Lokasi</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- PENAMBAHAN: Struktur HTML untuk Modal Konfirmasi --}}
<div id="delete-modal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 justify-center items-center p-4">
    <div class="bg-white rounded-lg shadow-xl p-6 w-full max-w-md text-center">
        <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100">
            <svg class="h-6 w-6 text-red-600" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
            </svg>
        </div>
        <h3 class="text-lg font-medium text-gray-900 mt-5">Konfirmasi Penghapusan</h3>
        <div class="mt-2">
            <p class="text-sm text-gray-500">Apakah Anda yakin ingin menghapus data ini? Tindakan ini tidak dapat dibatalkan.</p>
        </div>
        <div class="mt-6 flex justify-center gap-4">
            <button type="button" id="cancel-delete" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300">
                Batal
            </button>
            <button type="button" id="confirm-delete" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700">
                Ya, Hapus
            </button>
        </div>
    </div>
</div>

{{-- PENAMBAHAN: JavaScript untuk mengontrol Modal dan Dropdown --}}
<script>
document.addEventListener('DOMContentLoaded', function () {
    // --- Logika untuk Modal Hapus ---
    const modal = document.getElementById('delete-modal');
    const cancelButton = document.getElementById('cancel-delete');
    const confirmButton = document.getElementById('confirm-delete');
    const deleteButtons = document.querySelectorAll('.delete-button');
    let formToSubmit = null;

    deleteButtons.forEach(button => {
        button.addEventListener('click', function () {
            formToSubmit = this.getAttribute('data-form-id');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        });
    });

    function closeModal() {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        formToSubmit = null;
    }

    cancelButton.addEventListener('click', closeModal);
    confirmButton.addEventListener('click', function () {
        if (formToSubmit) {
            document.getElementById(formToSubmit).submit();
        }
    });

    modal.addEventListener('click', function (event) {
        if (event.target === modal) {
            closeModal();
        }
    });

    // --- Logika untuk Dropdown Bertingkat ---
    const kabkotSelect = document.getElementById('kabkot_id');
    const kecamatanSelect = document.getElementById('kecamatan_id');
    const nagariSelect = document.getElementById('nagari_id');
    const jorongSelect = document.getElementById('jorong_id');
    const tambahJorongBtn = document.getElementById('tambah-jorong-btn');
    const jorongDropdownContainer = document.getElementById('jorong-dropdown-container');
    const jorongManualContainer = document.getElementById('jorong-manual-container');
    const namaJorongBaruInput = document.getElementById('nama_jorong_baru');

    function resetDropdown(select, defaultOptionText) {
        select.innerHTML = `<option value="">-- ${defaultOptionText} --</option>`;
        select.disabled = true;
    }

    kabkotSelect.addEventListener('change', function() {
        const kabkotId = this.value;
        resetDropdown(kecamatanSelect, 'Pilih Kecamatan');
        resetDropdown(nagariSelect, 'Pilih Nagari');
        resetDropdown(jorongSelect, 'Pilih Jorong');
        tambahJorongBtn.style.display = 'none';

        if (kabkotId) {
            fetch(`{{ route('api.kecamatan') }}?kabkot_id=${kabkotId}`)
                .then(response => response.json())
                .then(data => {
                    kecamatanSelect.innerHTML = '<option value="">-- Pilih Kecamatan --</option>';
                    data.forEach(kecamatan => {
                        kecamatanSelect.innerHTML += `<option value="${kecamatan.kecamatan_id}">${kecamatan.nama_kecamatan}</option>`;
                    });
                    kecamatanSelect.disabled = false;
                });
        }
    });

    kecamatanSelect.addEventListener('change', function() {
        const kecamatanId = this.value;
        resetDropdown(nagariSelect, 'Pilih Nagari');
        resetDropdown(jorongSelect, 'Pilih Jorong');
        tambahJorongBtn.style.display = 'none';

        if (kecamatanId) {
            fetch(`{{ route('api.nagari') }}?kecamatan_id=${kecamatanId}`)
                .then(response => response.json())
                .then(data => {
                    nagariSelect.innerHTML = '<option value="">-- Pilih Nagari --</option>';
                    data.forEach(nagari => {
                        nagariSelect.innerHTML += `<option value="${nagari.nagari_id}">${nagari.nama_nagari}</option>`;
                    });
                    nagariSelect.disabled = false;
                });
        }
    });

    nagariSelect.addEventListener('change', function() {
        const nagariId = this.value;
        resetDropdown(jorongSelect, 'Pilih Jorong');
        tambahJorongBtn.style.display = 'none';
        jorongManualContainer.style.display = 'none';
        jorongDropdownContainer.style.display = 'block';
        jorongSelect.setAttribute('required', 'required');
        namaJorongBaruInput.removeAttribute('required');

        if (nagariId) {
            fetch(`{{ route('api.jorong') }}?nagari_id=${nagariId}`)
                .then(response => response.json())
                .then(data => {
                    jorongSelect.innerHTML = '<option value="">-- Pilih Jorong --</option>';
                    data.forEach(jorong => {
                        jorongSelect.innerHTML += `<option value="${jorong.jorong_id}">${jorong.nama_jorong}</option>`;
                    });
                    jorongSelect.disabled = false;
                    tambahJorongBtn.style.display = 'inline-block';
                });
        }
    });

    tambahJorongBtn.addEventListener('click', function() {
        if(jorongManualContainer.style.display === 'none') {
            jorongDropdownContainer.style.display = 'none';
            jorongManualContainer.style.display = 'block';
            jorongSelect.removeAttribute('required');
            namaJorongBaruInput.setAttribute('required', 'required');
            this.innerHTML = 'Pilih dari daftar?';
        } else {
            jorongDropdownContainer.style.display = 'block';
            jorongManualContainer.style.display = 'none';
            jorongSelect.setAttribute('required', 'required');
            namaJorongBaruInput.removeAttribute('required');
            namaJorongBaruInput.value = '';
            this.innerHTML = 'Jorong tidak ada di daftar? Tambah baru.';
        }
    });
});
</script>
@endsection
