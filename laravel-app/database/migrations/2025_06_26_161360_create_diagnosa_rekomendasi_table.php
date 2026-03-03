<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('diagnosa_rekomendasis', function (Blueprint $table) {
            // Primary Key
            $table->string('diagnosa_id')->primary();

            // Foreign Key ke Permohonan
            $table->string('permohonan_no_surat')->unique();
            $table->foreign('permohonan_no_surat')
                  ->references('no_surat')->on('surat_permohonan')
                  ->onDelete('cascade');

            // Kolom Spesifik Diagnosa
            $table->foreignId('metode_id')->constrained('metode', 'metode_id');
            $table->date('tgl_diagnosa');
            $table->text('hasil_diagnosa');
            $table->text('deskripsi_opt');
            $table->text('rekomendasi_pengendalian');
            $table->string('dokumentasi')->nullable();
            
            // --- PERUBAHAN UTAMA: Kolom Persetujuan & Status ---
            // Menyimpan siapa yang melakukan setiap tahap
            $table->foreignId('pemeriksa_id')->nullable()->comment('ID Manager Teknis')->constrained('users', 'user_id');
            $table->foreignId('penyetuju_id')->nullable()->comment('ID Manager Mutu')->constrained('users', 'user_id');
            $table->foreignId('pengesah_id')->nullable()->comment('ID Kepala LPHP')->constrained('users', 'user_id');

            // Menyimpan kapan setiap tahap dilakukan
            $table->timestamp('diperiksa_at')->nullable();
            $table->timestamp('disetujui_at')->nullable();
            $table->timestamp('disahkan_at')->nullable();

            // Enum status yang baru
            $table->enum('status', ['telah dibuat', 'telah diperiksa', 'telah disetujui', 'selesai', 'revisi'])->default('telah dibuat');
            
            // Kolom untuk catatan perbaikan
            $table->text('perbaikan')->nullable();
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('diagnosa_rekomendasis');
    }
};
