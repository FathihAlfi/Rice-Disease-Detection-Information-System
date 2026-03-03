@extends('layouts.app')

@section('title', 'Detail Diagnosa - ' . $diagnosa->diagnosa_id)

@section('content')
{{-- Container utama untuk menengahkan kartu --}}
<div class="min-h-[calc(100vh-8rem)] flex items-center justify-center p-4 sm:p-6 lg:p-8">

    {{-- Kartu Detail dengan gaya tema --}}
    <div class="w-full max-w-4xl bg-white rounded-2xl shadow-xl overflow-hidden">
        <div class="p-6 sm:p-8">
            
            {{-- Header Kartu --}}
            <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between pb-4 border-b border-gray-200">
                <div>
                    <h2 class="text-2xl font-bold text-gray-700 flex items-center gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                        </svg>
                        Detail Diagnosa & Rekomendasi
                    </h2>
                    <p class="mt-1 text-sm text-gray-500">ID Diagnosa: {{ $diagnosa->diagnosa_id }}</p>
                </div>
                <div class="mt-4 sm:mt-0">
                    @php
                        $statusClass = [
                            'telah dibuat' => 'bg-blue-100 text-blue-800',
                            'telah diperiksa' => 'bg-indigo-100 text-indigo-800',
                            'telah disetujui' => 'bg-purple-100 text-purple-800',
                            'selesai' => 'bg-green-100 text-green-800',
                            'revisi' => 'bg-yellow-100 text-yellow-800',
                        ][$diagnosa->status] ?? 'bg-gray-100';
                    @endphp
                    <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full {{ $statusClass }} capitalize">
                        {{ str_replace('_', ' ', $diagnosa->status) }}
                    </span>
                </div>
            </div>

            {{-- Notifikasi Alasan Revisi --}}
            @if($diagnosa->status == 'revisi' && $diagnosa->perbaikan)
                <div class="mt-6 bg-yellow-50 border-l-4 border-yellow-400 p-4">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.21 3.03-1.742 3.03H4.42c-1.532 0-2.492-1.696-1.742-3.03l5.58-9.92zM10 13a1 1 0 110-2 1 1 0 010 2zm-1-8a1 1 0 00-1 1v3a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" /></svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-yellow-700">
                                Laporan ini perlu direvisi. Catatan:
                                <strong class="block mt-1">{{ $diagnosa->perbaikan }}</strong>
                            </p>
                        </div>
                    </div>
                </div>
            @endif

            {{-- Detail Informasi --}}
            <div class="mt-6">
                {{-- Data Rujukan Permohonan --}}
                <div class="space-y-4 bg-gray-50 p-4 rounded-lg border mb-6">
                    <h3 class="font-semibold text-lg text-gray-600">Data Rujukan dari Permohonan</h3>
                    <dl class="grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-4">
                        <div class="sm:col-span-1">
                            <dt class="text-xs font-medium text-gray-500">No. Surat Permohonan</dt>
                            <dd class="mt-1 text-base text-gray-900">{{ $diagnosa->permohonan->no_surat ?? '-' }}</dd>
                        </div>
                        <div class="sm:col-span-1">
                            <dt class="text-xs font-medium text-gray-500">Nama Pemohon</dt>
                            <dd class="mt-1 text-base text-gray-900">{{ $diagnosa->permohonan->user->nama ?? '-' }}</dd>
                        </div>
                        <div class="sm:col-span-1">
                            <dt class="text-xs font-medium text-gray-500">Jenis Tanaman</dt>
                            <dd class="mt-1 text-base text-gray-900">{{ $diagnosa->permohonan->jenis->nama_jenis ?? '-' }}</dd>
                        </div>
                        <div class="sm:col-span-1">
                            <dt class="text-xs font-medium text-gray-500">Varietas</dt>
                            <dd class="mt-1 text-base text-gray-900">{{ $diagnosa->permohonan->varietas->nama_varietas ?? '-' }}</dd>
                        </div>
                    </dl>
                </div>

                {{-- Hasil Pemeriksaan Laboratorium --}}
                <div class="space-y-6">
                    <h3 class="text-lg font-semibold text-gray-700">Hasil Pemeriksaan Laboratorium</h3>
                    <dl class="grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-6">
                        <div class="sm:col-span-1">
                            <dt class="text-sm font-medium text-gray-500">Tanggal Diagnosa</dt>
                            <dd class="mt-1 text-base text-gray-900">{{ \Carbon\Carbon::parse($diagnosa->tgl_diagnosa)->format('d F Y') }}</dd>
                        </div>
                         <div class="sm:col-span-1">
                            <dt class="text-sm font-medium text-gray-500">Metode Diagnosa</dt>
                            <dd class="mt-1 text-base text-gray-900">{{ $diagnosa->metode->nama_metode ?? '-' }}</dd>
                        </div>
                        <div class="sm:col-span-2">
                            <dt class="text-sm font-medium text-gray-500">Hasil Diagnosa</dt>
                            <dd class="mt-1 text-base text-gray-900 prose max-w-none">{{ $diagnosa->hasil_diagnosa }}</dd>
                        </div>
                        <div class="sm:col-span-2">
                            <dt class="text-sm font-medium text-gray-500">Deskripsi OPT</dt>
                            <dd class="mt-1 text-base text-gray-900 prose max-w-none">{{ $diagnosa->deskripsi_opt }}</dd>
                        </div>
                        <div class="sm:col-span-2">
                            <dt class="text-sm font-medium text-gray-500">Rekomendasi Pengendalian</dt>
                            <dd class="mt-1 text-base text-gray-900 prose max-w-none">{{ $diagnosa->rekomendasi_pengendalian }}</dd>
                        </div>
                        @if($diagnosa->dokumentasi)
                        <div class="sm:col-span-2">
                            <dt class="text-sm font-medium text-gray-500">Dokumentasi</dt>
                            <dd class="mt-2">
                                <a href="{{ asset('storage/' . $diagnosa->dokumentasi) }}" target="_blank">
                                    <img src="{{ asset('storage/' . $diagnosa->dokumentasi) }}" alt="Dokumentasi" class="max-w-xs rounded-lg shadow-md">
                                </a>
                            </dd>
                        </div>
                        @endif
                    </dl>
                </div>
            </div>

            {{-- Riwayat Persetujuan --}}
            <div class="mt-6 pt-6 border-t">
                <h3 class="text-lg font-semibold text-gray-700">Riwayat Persetujuan</h3>
                <dl class="mt-4 grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-4">
                    @if($diagnosa->pemeriksa)
                    <div class="sm:col-span-1"><dt class="text-sm font-medium text-gray-500">Diperiksa oleh (Man. Teknis)</dt><dd class="mt-1 text-base text-gray-900">{{ $diagnosa->pemeriksa->nama ?? '-' }} pada {{ \Carbon\Carbon::parse($diagnosa->diperiksa_at)->format('d M Y, H:i') }}</dd></div>
                    @endif
                    @if($diagnosa->penyetuju)
                    <div class="sm:col-span-1"><dt class="text-sm font-medium text-gray-500">Disetujui oleh (Man. Mutu)</dt><dd class="mt-1 text-base text-gray-900">{{ $diagnosa->penyetuju->nama ?? '-' }} pada {{ \Carbon\Carbon::parse($diagnosa->disetujui_at)->format('d M Y, H:i') }}</dd></div>
                    @endif
                    @if($diagnosa->pengesah)
                    <div class="sm:col-span-1"><dt class="text-sm font-medium text-gray-500">Disahkan oleh (Ka. LPHP)</dt><dd class="mt-1 text-base text-gray-900">{{ $diagnosa->pengesah->nama ?? '-' }} pada {{ \Carbon\Carbon::parse($diagnosa->disahkan_at)->format('d M Y, H:i') }}</dd></div>
                    @endif
                </dl>
            </div>

            {{-- Footer Aksi --}}
            <div class="mt-8 pt-6 border-t border-gray-200 flex justify-between items-center">
                <a href="{{ route('diagnosa.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-100 text-gray-800 rounded-lg hover:bg-gray-200 transition">← Kembali</a>
                
                <div class="flex items-center gap-3">
                    @php $user = Auth::user(); @endphp
                    
                    @if($user->role_id == 5 && $diagnosa->status == 'telah dibuat')
                        <button type="button" class="action-button inline-flex items-center gap-2 px-4 py-2 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600" data-action="REVISI">Revisi</button>
                        <button type="button" class="action-button inline-flex items-center gap-2 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700" data-action="PERIKSA">Periksa</button>
                    @endif

                    @if($user->role_id == 6 && $diagnosa->status == 'telah diperiksa')
                        <button type="button" class="action-button inline-flex items-center gap-2 px-4 py-2 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600" data-action="REVISI">Revisi</button>
                        <button type="button" class="action-button inline-flex items-center gap-2 px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700" data-action="SETUJUI">Setujui</button>
                    @endif

                    @if($user->role_id == 7 && $diagnosa->status == 'telah disetujui')
                        <button type="button" class="action-button inline-flex items-center gap-2 px-4 py-2 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600" data-action="REVISI">Revisi</button>
                        <button type="button" class="action-button inline-flex items-center gap-2 px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700" data-action="SAHKAN">Sahkan</button>
                    @endif

                    {{-- PERBAIKAN: Mengganti $user->id menjadi $user->user_id --}}
                    @if($user->role_id == 4 && $diagnosa->status == 'revisi' && $diagnosa->analis_id == $user->user_id)
                        <a href="{{ route('diagnosa.edit', $diagnosa) }}" class="inline-flex items-center gap-2 px-4 py-2 bg-yellow-500 text-white font-semibold rounded-lg hover:bg-yellow-600 transition shadow-md">
                            ✏️ Perbaiki Laporan
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Modal untuk Aksi --}}
<div id="action-modal" class="hidden fixed inset-0 bg-black bg-opacity-60 z-50  justify-center items-center p-4">
    <div class="bg-white rounded-lg shadow-xl p-6 w-full max-w-lg">
        <div class="flex justify-between items-center border-b pb-3">
            <h3 id="modal-title" class="text-lg font-medium text-gray-900">Konfirmasi Aksi</h3>
            <button id="close-modal" class="text-gray-400 hover:text-gray-600">&times;</button>
        </div>
        <div class="mt-4">
            <p id="modal-message" class="text-sm text-gray-500">Apakah Anda yakin?</p>
            
            <form id="action-form" action="" method="POST" class="mt-4">
                @csrf
                @method('PATCH')
                
                <div id="rejection-reason-container" class="hidden">
                    <label for="perbaikan" class="block text-sm font-medium text-gray-700 text-left">Tuliskan catatan perbaikan untuk Analis:<span class="text-red-500">*</span></label>
                    <textarea name="perbaikan" id="perbaikan" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required minlength="10"></textarea>
                </div>
            </form>
        </div>
        <div class="mt-6 flex justify-end gap-4">
            <button type="button" id="cancel-action" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300">Batal</button>
            <button type="button" id="confirm-action" class="px-4 py-2 text-white rounded-md">Ya, Lanjutkan</button>
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

    const actions = {
        PERIKSA: {
            formUrl: "{{ route('diagnosa.periksa', $diagnosa) }}",
            title: 'Konfirmasi Pemeriksaan',
            message: 'Apakah Anda yakin sudah memeriksa laporan ini dan akan meneruskannya ke Manager Mutu?',
            btnClass: 'bg-blue-600 hover:bg-blue-700',
            btnText: 'Ya, Periksa'
        },
        SETUJUI: {
            formUrl: "{{ route('diagnosa.setujui', $diagnosa) }}",
            title: 'Konfirmasi Persetujuan',
            message: 'Apakah Anda yakin ingin menyetujui laporan ini dan meneruskannya ke Kepala LPHP?',
            btnClass: 'bg-green-600 hover:bg-green-700',
            btnText: 'Ya, Setujui'
        },
        SAHKAN: {
            formUrl: "{{ route('diagnosa.sahkan', $diagnosa) }}",
            title: 'Konfirmasi Pengesahan',
            message: 'Apakah Anda yakin ingin mensahkan laporan ini? Status akan menjadi "Selesai".',
            btnClass: 'bg-purple-600 hover:bg-purple-700',
            btnText: 'Ya, Sahkan'
        },
        REVISI: {
            formUrl: "{{ route('diagnosa.revisi', $diagnosa) }}",
            title: 'Kirim untuk Revisi',
            message: 'Mohon tuliskan catatan perbaikan yang jelas untuk Analis.',
            btnClass: 'bg-red-600 hover:bg-red-700',
            btnText: 'Kirim Revisi'
        }
    };

    actionButtons.forEach(button => {
        button.addEventListener('click', function () {
            const actionKey = this.dataset.action;
            const config = actions[actionKey];

            actionForm.action = config.formUrl;
            modalTitle.textContent = config.title;
            modalMessage.textContent = config.message;
            confirmButton.className = `px-4 py-2 text-white rounded-md ${config.btnClass}`;
            confirmButton.textContent = config.btnText;

            if (actionKey === 'REVISI') {
                rejectionReasonContainer.classList.remove('hidden');
                perbaikanTextarea.setAttribute('required', 'required');
            } else {
                rejectionReasonContainer.classList.add('hidden');
                perbaikanTextarea.removeAttribute('required');
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
