<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('ruang_ujian', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('kode_ruang')->unique();
            $table->string('nama_ruang');
            $table->string('gedung')->nullable();
            $table->integer('kapasitas');
            $table->boolean('aktif')->default(true);
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
     
    }
};
