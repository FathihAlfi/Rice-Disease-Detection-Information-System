<?php

namespace App\Policies;

use App\Models\DiagnosaRekomendasi;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class DiagnosaPolicy
{
    /**
     * Perform pre-authorization checks.
     * Admin (role_id 1) bisa melakukan segalanya.
     */
    public function before(User $user, string $ability): bool|null
    {
        if ($user->role_id === 1) { 
            return true;
        }
        return null; // Lanjutkan ke method policy lainnya
    }

    /**
     * Siapa yang bisa melihat halaman daftar diagnosa.
     */
    public function viewAny(User $user): bool
    {
        // PERBAIKAN: Memastikan hanya role yang terlibat yang bisa mengakses halaman index.
        $allowedRoles = [
            4, // Staff Lab (Analis)
            5, // Manager Teknis
            6, // Manager Mutu
            7, // Kepala LPHP
        ];
        return in_array((int) $user->role_id, $allowedRoles, true);
    }

    /**
     * Siapa yang bisa melihat detail sebuah diagnosa.
     */
    public function view(User $user, DiagnosaRekomendasi $diagnosa): bool
    {
        // Analis hanya bisa melihat detail jika dia adalah pembuatnya.
        if ($user->role_id === 4) {
            return (int) $diagnosa->analis_id === (int) $user->user_id;
        }

        // Atasan (role 5, 6, 7) bisa melihat semua detail.
        if (in_array((int) $user->role_id, [5, 6, 7])) {
            return true;
        }

        return false; // Tolak secara default
    }

    /**
     * Siapa yang bisa membuat diagnosa baru.
     */
    public function create(User $user): bool
    {
        // Hanya Analis yang bisa memulai proses pembuatan diagnosa.
        return $user->role_id === 4;
    }

    /**
     * Siapa yang bisa mengedit diagnosa.
     */
    public function update(User $user, DiagnosaRekomendasi $diagnosa): bool
    {
        // PERBAIKAN: Analis bisa mengedit jika statusnya 'telah dibuat' ATAU 'revisi'.
        return (int) $diagnosa->analis_id === (int) $user->user_id && in_array($diagnosa->status, ['telah dibuat', 'revisi']);
    }

    /**
     * Siapa yang bisa melakukan aksi 'periksa'.
     */
    public function periksa(User $user, DiagnosaRekomendasi $diagnosa): bool
    {
        // Hanya Manager Teknis (ID 5) yang bisa memeriksa, jika statusnya 'telah dibuat'
        return (int) $user->role_id === 5 && $diagnosa->status === 'telah dibuat';
    }

    /**
     * Siapa yang bisa melakukan aksi 'setujui'.
     */
    public function setujui(User $user, DiagnosaRekomendasi $diagnosa): bool
    {
        // Hanya Manager Mutu (ID 6) yang bisa menyetujui, jika statusnya 'telah diperiksa'
        return (int) $user->role_id === 6 && $diagnosa->status === 'telah diperiksa';
    }

    /**
     * Siapa yang bisa melakukan aksi 'sahkan'.
     */
    public function sahkan(User $user, DiagnosaRekomendasi $diagnosa): bool
    {
        // Hanya Kepala LPHP (ID 7) yang bisa mensahkan, jika statusnya 'telah disetujui'
        return (int) $user->role_id === 7 && $diagnosa->status === 'telah disetujui';
    }

    /**
     * Siapa yang bisa meminta 'revisi'.
     */
    public function revisi(User $user, DiagnosaRekomendasi $diagnosa): bool
    {
        // Manager Teknis, Mutu, dan Kepala LPHP bisa meminta revisi pada tahapannya masing-masing.
        if ($user->role_id === 5 && $diagnosa->status === 'telah dibuat') return true;
        if ($user->role_id === 6 && $diagnosa->status === 'telah diperiksa') return true;
        if ($user->role_id === 7 && $diagnosa->status === 'telah disetujui') return true;

        return false;
    }

    /**
     * Siapa yang bisa menghapus diagnosa.
     */
    public function delete(User $user, DiagnosaRekomendasi $diagnosa): bool
    {
        // Syarat:
        // 1. Role ID harus 4 (Analis)
        // 2. Analis ID pada data harus sama dengan User ID yang login (Hanya bisa hapus punya sendiri)
        // 3. Status harus masih 'telah dibuat' atau 'revisi' (Data yang sudah diproses atasan tidak boleh dihapus)
        
        return (int) $user->role_id === 4 
            && (int) $diagnosa->analis_id === (int) $user->user_id
            && in_array($diagnosa->status, ['telah dibuat', 'revisi']);
    }
}
