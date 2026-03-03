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
        Schema::create('deteksi_cnn', function (Blueprint $table) {
            $table->id('deteksi_id');
            $table->foreignId('user_id')->constrained('users', 'user_id');
            $table->string('label');
            $table->text('pengendalian');
            $table->string('gambar');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deteksi_cnns');
    }
};
