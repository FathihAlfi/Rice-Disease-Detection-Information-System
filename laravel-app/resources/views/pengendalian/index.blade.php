@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto p-6">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

        <div class="bg-white border rounded-lg p-6 shadow-sm">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Data Pengendalian</h2>

            @if(session('success'))
                <div class="bg-green-100 border border-green-300 text-green-700 p-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

             @if(session('error'))
                <div class="bg-red-100 border border-red-300 text-red-700 p-3 rounded mb-4 flex items-center">
                    {{-- Ikon Warning Kecil --}}
                    <svg class="h-5 w-5 mr-2 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>{{ session('error') }}</span>
                </div>
            @endif

            @if($pengendalian->isEmpty())
                <p class="text-gray-500">Belum ada data pengendalian.</p>
            @else
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead class="border-b bg-gray-50">
                            <tr>
                                <th class="p-3 text-sm font-bold text-gray-500 uppercase">Nama OPT</th>
                                <th class="p-3 text-sm font-bold text-gray-500 uppercase">Deskripsi Pengendalian</th>
                                <th class="p-3 text-sm font-bold text-gray-500 uppercase text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pengendalian as $item)
                                <tr class="border-b hover:bg-gray-50 transition">
                                    <td class="p-3 text-gray-900">{{ $item->opt->nama_opt }}</td>
                                    <td class="p-3 text-gray-900">{{ $item->deskripsi }}</td>
                                    <td class="p-3 text-center">
                                        {{-- PERBAIKAN: Mengubah form untuk menggunakan modal --}}
                                        <form id="delete-form-{{ $item->pengendalian_id }}" action="{{ route('pengendalian.destroy', $item->pengendalian_id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" data-form-id="delete-form-{{ $item->pengendalian_id }}" class="delete-button bg-red-600 hover:bg-red-700 text-white px-4 py-1 rounded text-sm shadow">
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

        <div class="bg-white border rounded-lg p-6 shadow-sm h-fit">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Tambah Pengendalian</h2>

            <form method="POST" action="{{ route('pengendalian.store') }}" class="space-y-4">
                @csrf
                <div>
                    <label for="opt_id" class="block font-medium text-gray-700">Pilih OPT</label>
                    <select id="opt_id" name="opt_id" class="mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500" required>
                        <option value="" disabled selected>-- Pilih OPT --</option>
                        @foreach($opts as $opt)
                            <option value="{{ $opt->opt_id }}" {{ old('opt_id') == $opt->opt_id ? 'selected' : '' }}>
                                {{ $opt->nama_opt }}
                            </option>
                        @endforeach
                    </select>
                    @error('opt_id')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="deskripsi" class="block font-medium text-gray-700">Deskripsi Pengendalian</label>
                    <textarea
                        id="deskripsi"
                        name="deskripsi"
                        class="mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500"
                        rows="4"
                        required
                        placeholder="Jelaskan cara pengendalian OPT secara detail..."
                    >{{ old('deskripsi') }}</textarea>
                    @error('deskripsi')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white px-5 py-2 rounded-md shadow transition">
                        Tambah
                    </button>
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

{{-- PENAMBAHAN: JavaScript untuk mengontrol Modal --}}
<script>
document.addEventListener('DOMContentLoaded', function () {
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
});
</script>
@endsection
