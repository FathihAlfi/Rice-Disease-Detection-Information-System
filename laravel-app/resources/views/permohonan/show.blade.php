@extends('layouts.app')
@section('title', 'Detail Permohonan - ' . $permohonan->no_surat)

@section('content')
{{-- Container utama untuk menengahkan kartu --}}
<div class="min-h-[calc(100vh-8rem)] flex items-center justify-center p-4 sm:p-6 lg:p-8">

    {{-- Kartu Detail dengan gaya tema --}}
    <div class="w-full max-w-4xl bg-white rounded-2xl shadow-xl overflow-hidden">
        <div class="p-6 sm:p-8">
            
            {{-- Header Kartu --}}
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between pb-4 border-b border-gray-200">
                <div>
                    <h2 class="text-2xl font-bold text-gray-700 flex items-center gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-green-600" viewBox="0 0 20 20" fill="currentColor"><path d="M9 2a2 2 0 00-2 2v8a2 2 0 002 2h2a2 2 0 002-2V4a2 2 0 00-2-2H9z" /><path fill-rule="evenodd" d="M4 2a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2V4a2 2 0 00-2-2H4zm10 2a1 1 0 00-1-1H7a1 1 0 00-1 1v12a1 1 0 001 1h6a1 1 0 001-1V4z" clip-rule="evenodd" /></svg>
                        Detail Permohonan
                    </h2>
                    <p class="mt-1 text-sm text-gray-500">No. Surat: {{ $permohonan->no_surat }}</p>
                </div>
                <div class="mt-4 sm:mt-0">
                    @php
                        $statusClass = [
                            'draf' => 'bg-gray-100 text-gray-800',
                            'ditunggu' => 'bg-yellow-100 text-yellow-800',
                            'diterima' => 'bg-green-100 text-green-800',
                            'selesai' => 'bg-blue-100 text-blue-800',
                        ][$permohonan->status] ?? 'bg-gray-100 text-gray-800';
                    @endphp
                    <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full {{ $statusClass }} capitalize">
                        {{ $permohonan->status }}
                    </span>
                </div>
            </div>

            {{-- Notifikasi Alasan Penolakan --}}
            @if($permohonan->status == 'ditunggu' && $permohonan->perbaikan)
                <div class="mt-6 bg-yellow-50 border-l-4 border-yellow-400 p-4">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.21 3.03-1.742 3.03H4.42c-1.532 0-2.492-1.696-1.742-3.03l5.58-9.92zM10 13a1 1 0 110-2 1 1 0 010 2zm-1-8a1 1 0 00-1 1v3a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-yellow-700">
                                Permohonan ini perlu diperbaiki. Catatan dari Sample Recipient:
                                <strong class="block mt-1">{{ $permohonan->perbaikan }}</strong>
                            </p>
                        </div>
                    </div>
                </div>
            @endif

            {{-- Detail Informasi Permohonan --}}
            <div class="mt-6">
                <dl class="grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-6">
                    <div class="sm:col-span-1"><dt class="text-sm font-medium text-gray-500">Nama Pemohon</dt><dd class="mt-1 text-base text-gray-900 font-semibold">{{ $permohonan->user->nama ?? '-' }}</dd></div>
                    <div class="sm:col-span-1"><dt class="text-sm font-medium text-gray-500">Tanggal Pengajuan</dt><dd class="mt-1 text-base text-gray-900">{{ $permohonan->created_at->format('d F Y, H:i') }}</dd></div>
                    <div class="sm:col-span-2 pt-6 border-t border-gray-200"><h3 class="text-lg font-semibold text-gray-700">Detail Sampel Tanaman</h3></div>
                    <div class="sm:col-span-1"><dt class="text-sm font-medium text-gray-500">Jenis Tanaman</dt><dd class="mt-1 text-base text-gray-900">{{ $permohonan->jenis->nama_jenis ?? '-' }}</dd></div>
                    <div class="sm:col-span-1"><dt class="text-sm font-medium text-gray-500">Varietas</dt><dd class="mt-1 text-base text-gray-900">{{ $permohonan->varietas->nama_varietas ?? '-' }}</dd></div>
                    <div class="sm:col-span-1"><dt class="text-sm font-medium text-gray-500">Umur Tanaman (HST)</dt><dd class="mt-1 text-base text-gray-900">{{ $permohonan->umur }}</dd></div>
                    <div class="sm:col-span-1"><dt class="text-sm font-medium text-gray-500">Bagian Terserang</dt><dd class="mt-1 text-base text-gray-900">{{ $permohonan->bagian_terserang }}</dd></div>
                    <div class="sm:col-span-2 pt-6 border-t border-gray-200"><h3 class="text-lg font-semibold text-gray-700">Detail Laporan</h3></div>
                    <div class="sm:col-span-1"><dt class="text-sm font-medium text-gray-500">Tanggal Ditemukan</dt><dd class="mt-1 text-base text-gray-900">{{ \Carbon\Carbon::parse($permohonan->tgl_ditemukan)->format('d F Y') }}</dd></div>
                    <div class="sm:col-span-1"><dt class="text-sm font-medium text-gray-500">Cara Budidaya</dt><dd class="mt-1 text-base text-gray-900">{{ $permohonan->budidaya }}</dd></div>
                    <div class="sm:col-span-1"><dt class="text-sm font-medium text-gray-500">Jumlah Sampel</dt><dd class="mt-1 text-base text-gray-900">{{ $permohonan->jumlah_sampel }}</dd></div>
                    <div class="sm:col-span-2"><dt class="text-sm font-medium text-gray-500">Gejala yang Timbul</dt><dd class="mt-1 text-base text-gray-900">{{ $permohonan->gejala }}</dd></div>
                </dl>
            </div>

            {{-- Footer Aksi --}}
            <div class="mt-8 pt-6 border-t border-gray-200 flex justify-between items-center">
                <a href="{{ route('permohonan.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-100 text-gray-800 rounded-lg hover:bg-gray-200 transition">
                    ← Kembali
                </a>
                
                <div class="flex items-center gap-3">
                    @if($permohonan->status == 'draf')
                        {{-- Tombol untuk Admin --}}
                        <button type="button" class="action-button inline-flex items-center gap-2 px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition shadow-md"
                            data-action="TOLAK" data-message="Anda yakin ingin MENOLAK permohonan ini? Masukkan alasan penolakan di bawah.">
                            Tolak
                        </button>
                        <button type="button" class="action-button inline-flex items-center gap-2 px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition shadow-md"
                            data-action="SETUJUI" data-message="Anda yakin ingin MENYETUJUI permohonan ini?">
                            Setujui
                        </button>
                    @elseif($permohonan->status == 'ditunggu')
                        {{-- Tombol untuk Pemohon --}}
                        <a href="{{ route('permohonan.edit', $permohonan) }}" class="inline-flex items-center gap-2 px-4 py-2 bg-yellow-500 text-white font-semibold rounded-lg hover:bg-yellow-600 transition shadow-md">
                            ✏️ Perbaiki Permohonan
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Modal untuk Aksi Penolakan & Persetujuan --}}
<div id="action-modal" class="hidden fixed inset-0 bg-black bg-opacity-60 z-50  justify-center items-center p-4">
    <div class="bg-white rounded-lg shadow-xl p-6 w-full max-w-lg">
        <div class="flex justify-between items-center border-b pb-3">
            <h3 id="modal-title" class="text-lg font-medium text-gray-900">Konfirmasi Aksi</h3>
            <button id="close-modal" class="text-gray-400 hover:text-gray-600">&times;</button>
        </div>
        <div class="mt-4">
            <p id="modal-message" class="text-sm text-gray-500">Apakah Anda yakin?</p>
            
            {{-- Form ini akan diubah oleh JavaScript --}}
            <form id="action-form" action="" method="POST" class="mt-4">
                @csrf
                @method('PATCH')
                
                {{-- Area input alasan, hanya muncul untuk aksi 'TOLAK' --}}
                <div id="rejection-reason-container" class="hidden">
                    <label for="perbaikan" class="block text-sm font-medium text-gray-700 text-left">Alasan Penolakan / Catatan Perbaikan <span class="text-red-500">*</span></label>
                    <textarea name="perbaikan" id="perbaikan" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required></textarea>
                </div>
            </form>
        </div>
        <div class="mt-6 flex justify-end gap-4">
            <button type="button" id="cancel-action" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300">
                Batal
            </button>
            <button type="button" id="confirm-action" class="px-4 py-2 text-white rounded-md">
                Ya, Lanjutkan
            </button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const modal = document.getElementById('action-modal');
    const modalTitle = document.getElementById('modal-title');
    const modalMessage = document.getElementById('modal-message');
    const rejectionReasonContainer = document.getElementById('rejection-reason-container');
    const perbaikanTextarea = document.getElementById('perbaikan');
    const cancelButton = document.getElementById('cancel-action');
    const confirmButton = document.getElementById('confirm-action');
    const closeButton = document.getElementById('close-modal');
    const actionButtons = document.querySelectorAll('.action-button');
    const actionForm = document.getElementById('action-form');

    actionButtons.forEach(button => {
        button.addEventListener('click', function () {
            const action = this.dataset.action;
            const message = this.dataset.message;
            
            modalMessage.textContent = message;
            
            if (action === 'SETUJUI') {
                actionForm.action = "{{ route('permohonan.approve', $permohonan) }}";
                modalTitle.textContent = 'Konfirmasi Persetujuan';
                rejectionReasonContainer.classList.add('hidden');
                perbaikanTextarea.removeAttribute('required');
                confirmButton.className = 'px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700';
                confirmButton.textContent = 'Ya, Setujui';
            } else if (action === 'TOLAK') {
                actionForm.action = "{{ route('permohonan.reject', $permohonan) }}";
                modalTitle.textContent = 'Konfirmasi Penolakan';
                rejectionReasonContainer.classList.remove('hidden');
                perbaikanTextarea.setAttribute('required', 'required');
                confirmButton.className = 'px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700';
                confirmButton.textContent = 'Ya, Tolak';
            }
            
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        });
    });

    function closeModal() {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }

    cancelButton.addEventListener('click', closeModal);
    closeButton.addEventListener('click', closeModal);
    
    confirmButton.addEventListener('click', function () {
        actionForm.submit();
    });

    modal.addEventListener('click', function (event) {
        if (event.target === modal) {
            closeModal();
        }
    });
});
</script>
@endsection
