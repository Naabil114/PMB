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
        Schema::create('periode_penerimaan', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('nama_periode');
            $table->string('tahun_akademik');

            $table->date('tanggal_mulai_pendaftaran');
            $table->date('tanggal_selesai_pendaftaran');
            $table->date('tanggal_mulai_ujian');
            $table->date('tanggal_selesai_ujian');
            $table->date('tanggal_pengumuman');

            $table->boolean('aktif')->default(true);
            $table->timestamps();
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
