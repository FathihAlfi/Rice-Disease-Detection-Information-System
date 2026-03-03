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
        Schema::create('nagari', function (Blueprint $table) {
            $table->id('nagari_id');
            $table->foreignId('kecamatan_id')->constrained('kecamatan', 'kecamatan_id')->onDelete('cascade');
            $table->string('nama_nagari');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nagaris');
    }
};
