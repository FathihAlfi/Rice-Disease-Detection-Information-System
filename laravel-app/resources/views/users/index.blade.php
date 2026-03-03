@extends('layouts.app')

@section('title', 'List User')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        
        <h2 class="mb-4">
            <a href="{{ route('users.index') }}" class="inline-flex items-center gap-x-2 text-2xl font-bold text-white">
                <span>📋</span>
                <span>Daftar User</span>
            </a>
        </h2>

        @if (session('success'))
            <div class="mb-4 p-4 text-sm text-green-700 bg-green-100 rounded-lg" role="alert">
                {{ session('success') }}
            </div>
        @endif
        
        <div class="flex flex-col md:flex-row justify-between items-center gap-4 mb-4">
            <form action="{{ route('users.index') }}" method="GET" class="w-full md:w-auto md:flex-grow">
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                        <svg class="w-5 h-5 text-gray-400" viewBox="0 0 24 24" fill="none"><path d="M21 21L15 15M17 10C17 13.866 13.866 17 10 17C6.13401 17 3 13.866 3 10C3 6.13401 6.13401 3 10 3C13.866 3 17 6.13401 17 10Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                    </span>
                    <input type="text" name="search" class="block w-full pl-10 pr-12 py-2 border border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="Cari nama, role, atau NIP" value="{{ request('search') }}">
                    <button type="submit" class="absolute inset-y-0 right-0 flex items-center px-4 text-gray-400 hover:text-[#4CAF50] rounded-r-md">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" /></svg>
                    </button>
                </div>
            </form>
            
            <a href="{{ route('users.create') }}" class="w-full md:w-auto inline-flex items-center justify-center px-4 py-2 bg-[#4CAF50] border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-[#2E7D32] transition ease-in-out duration-150 shadow-md whitespace-nowrap">
                + Tambah User
            </a>
        </div>

        <div class="bg-white shadow-sm rounded-lg overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">NIP</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($users as $user)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">{{ ($users->currentPage() - 1) * $users->perPage() + $loop->iteration }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $user->nama }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $user->role->nama_role }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $user->nip }}</td>
                            <td class="px-6 py-4 whitespace-nowrap space-x-1">
                                <a href="{{ route('users.show', $user->user_id) }}" class="inline-flex items-center justify-center w-9 h-9 bg-gray-100 hover:bg-blue-200 rounded-full text-lg" title="Detail">📄</a>
                                <a href="{{ route('users.edit', $user->user_id) }}" class="inline-flex items-center justify-center w-9 h-9 bg-yellow-100 hover:bg-yellow-200 rounded-full text-lg" title="Edit">✏️</a>
                                
                                <form id="delete-form-{{ $user->user_id }}" action="{{ route('users.destroy', $user->user_id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" data-form-id="delete-form-{{ $user->user_id }}" class="delete-button inline-flex items-center justify-center w-9 h-9 bg-red-100 hover:bg-red-200 rounded-full text-lg" title="Hapus">❌</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                                @if(request('search'))
                                    Tidak ada hasil untuk pencarian "{{ request('search') }}".
                                @else
                                    Belum ada data user.
                                @endif
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-6">
            {{ $users->links() }}
        </div>
    </div>
</div>

{{-- Struktur HTML untuk Modal Konfirmasi --}}
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

{{-- JavaScript untuk mengontrol Modal --}}
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
