<?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    return new class extends Migration
    {
        /**
         * Run the migrations.
         */
        public function up(): void
        {
            Schema::table('surat_permohonan', function (Blueprint $table) {
                // Menambahkan kolom untuk menyimpan ID user yang menyetujui (Penerima Sampel)
                // Dibuat nullable karena awalnya kosong sebelum disetujui.
                $table->foreignId('penerima_id')->nullable()->after('user_id')->constrained('users', 'user_id');
            });
        }

        /**
         * Reverse the migrations.
         */
        public function down(): void
        {
            Schema::table('surat_permohonan', function (Blueprint $table) {
                // Menghapus foreign key constraint terlebih dahulu
                $table->dropForeign(['penerima_id']);
                // Menghapus kolom
                $table->dropColumn('penerima_id');
            });
        }
    };
    