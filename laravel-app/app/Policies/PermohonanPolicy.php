<?php

    namespace App\Policies;

    use App\Models\Permohonan;
    use App\Models\User;
    use Illuminate\Auth\Access\Response;

    class PermohonanPolicy
    {
        /**
         * Izinkan admin untuk melakukan segalanya.
         */
        public function before(User $user, string $ability): bool|null
        {
            if ($user->role_id === 1) { // Asumsi role_id 1 adalah Admin
                return true;
            }
            return null;
        }

        /**
         * Siapa yang bisa melihat daftar permohonan.
         */
        public function viewAny(User $user): bool
        {
            // Semua role yang terlibat bisa melihat halaman index
            return in_array($user->role_id, [2, 3, 4, 7]); // POPT, Penerima, Analis
        }

        /**
         * Siapa yang bisa melihat detail permohonan.
         */
        public function view(User $user, Permohonan $permohonan): bool
        {
            // POPT hanya bisa lihat miliknya, role lain bisa lihat semua
            if ($user->role_id === 2) {
                return $user->user_id === $permohonan->user_id;
            }
            return in_array($user->role_id, [3, 4]);
        }

        /**
         * Siapa yang bisa membuat permohonan.
         */
        public function create(User $user): bool
        {
            return $user->role_id === 2; // Hanya POPT
        }

        /**
         * Siapa yang bisa mengedit permohonan.
         */
        public function update(User $user, Permohonan $permohonan): bool
        {
            // Hanya POPT pemilik, dan hanya jika statusnya 'draf' atau 'ditunggu'
            return $user->user_id === $permohonan->user_id && in_array($permohonan->status, ['draf', 'ditunggu']);
        }

        /**
         * Siapa yang bisa menghapus permohonan.
         */
        public function delete(User $user, Permohonan $permohonan): bool
        {
            // Hanya POPT pemilik
            return $user->user_id === $permohonan->user_id;
        }

        /**
         * Siapa yang bisa menyetujui atau menolak.
         */
        public function manage(User $user, Permohonan $permohonan): bool
        {
            // Hanya Penerima Sampel, dan hanya jika statusnya 'draf'
            return $user->role_id === 3 && $permohonan->status === 'draf';
        }

        /**
         * Siapa yang bisa mengirim ulang permohonan yang ditolak.
         */
        public function resubmit(User $user, Permohonan $permohonan): bool
        {
            // Hanya POPT pemilik, dan hanya jika statusnya 'ditunggu'
            return $user->user_id === $permohonan->user_id && $permohonan->status === 'ditunggu';
        }
    }
    