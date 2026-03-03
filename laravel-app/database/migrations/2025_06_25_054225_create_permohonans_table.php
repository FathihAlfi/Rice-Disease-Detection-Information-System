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
        Schema::create('surat_permohonan', function (Blueprint $table) {
            // Kolom Primary Key berupa string (varchar)
            $table->string('no_surat')->primary();
            
            // Kolom Foreign Key
            $table->foreignId('user_id')->constrained('users', 'user_id')->onDelete('cascade');
            $table->foreignId('jenis_id')->constrained('jenis', 'jenis_id');
            $table->foreignId('varietas_id')->constrained('varietas', 'varietas_id');

            // Kolom Atribut lainnya
            $table->string('umur');
            $table->string('bagian_terserang');
            $table->date('tgl_ditemukan');
            $table->string('budidaya');
            $table->integer('jumlah_sampel');
            $table->text('gejala'); 
            $table->text('perbaikan')->nullable();
            
            // Kolom status dengan tipe ENUM
            $table->enum('status', ['draf', 'ditunggu', 'diterima','selesai'])->default('draf');
            
            // Kolom created_at dan updated_at
            $table->timestamps(); // Ini akan membuat created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surat_permohonan');
    }
};
