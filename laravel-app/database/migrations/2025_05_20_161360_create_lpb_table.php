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
        Schema::create('lpb', function (Blueprint $table) {
            // $table->string('no_surat')->unique();
            $table->string('no_surat')->primary();
            $table->foreignId('user_id')->constrained('users', 'user_id');
            $table->foreignId('deteksi_id')->constrained('deteksi_cnn', 'deteksi_id')->nullable();
            $table->foreignId('userlokasi_id')->constrained('user_lokasis', 'userlokasi_id');
            $table->foreignId('varietas_id')->constrained('varietas', 'varietas_id');
            $table->foreignId('opt_id')->constrained('opt', 'opt_id');
            $table->foreignId('pengendalian_id')->constrained('pengendalian', 'pengendalian_id');
            $table->integer('laporan_ke');
            $table->date('tgl_pengamatan');
            $table->string('umur');
            $table->float('intensitas_serangan')->nullable();
            $table->float('padat_populasi_ha')->nullable();
            $table->float('luas_serangan_ha')->nullable();
            $table->float('luas_terancam_ha')->nullable();
            $table->float('populasi_MA')->nullable();
            $table->text('upaya')->nullable();
            $table->text('custom_pengendalian')->nullable();
            // $table->enum('status', ['draft', 'disetujui', 'ditolak'])->default('draft');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lpbs');
    }
};
