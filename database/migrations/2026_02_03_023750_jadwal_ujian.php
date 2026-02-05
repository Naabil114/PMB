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
        Schema::create('jadwal_ujian', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->uuid('periode_penerimaan_id');
            $table->date('tanggal_ujian');
            $table->uuid('sesi_ujian_id');
            $table->uuid('ruang_ujian_id');

            $table->integer('kuota');
            $table->integer('jumlah_terdaftar')->default(0);
            $table->boolean('aktif')->default(true);

            $table->timestamps();

            $table->foreign('periode_penerimaan_id')->references('id')->on('periode_penerimaan');
            $table->foreign('sesi_ujian_id')->references('id')->on('sesi_ujian');
            $table->foreign('ruang_ujian_id')->references('id')->on('ruang_ujian');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
