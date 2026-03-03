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
        Schema::create('varietas', function (Blueprint $table) {
            $table->id('varietas_id');
            $table->unsignedBigInteger('jenis_id');
            $table->string('nama_varietas');
            $table->timestamps();
        
            $table->foreign('jenis_id')->references('jenis_id')->on('jenis');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('varietas');
    }
};
