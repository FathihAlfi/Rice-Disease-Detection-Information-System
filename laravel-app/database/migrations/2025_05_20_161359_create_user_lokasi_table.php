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
        Schema::create('user_lokasis', function (Blueprint $table) {
            $table->id('userlokasi_id');
            $table->foreignId('user_id')->constrained('users', 'user_id')->onDelete('cascade');
            $table->foreignId('kecamatan_id')->constrained('kecamatan', 'kecamatan_id');
            $table->foreignId('nagari_id')->constrained('nagari', 'nagari_id');
            $table->foreignId('jorong_id')->constrained('jorong', 'jorong_id');
            $table->foreignId('kabkot_id')->constrained('kab_kota', 'kabkot_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_lokasis');
    }
};
