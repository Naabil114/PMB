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
        Schema::create('pendaftaran', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->uuid('pendaftar_id');
            $table->uuid('periode_penerimaan_id');
            $table->uuid('program_studi_id')->nullable();
            $table->uuid('jadwal_ujian_id')->nullable();

            $table->string('jenjang')->nullable();
            $table->string('pendidikan_terakhir')->nullable();
            $table->string('institusi_terakhir')->nullable();
            $table->string('jurusan_terakhir')->nullable();
            $table->integer('tahun_lulus')->nullable();
            $table->decimal('ipk', 3, 2)->nullable();

            $table->enum('status_dokumen', ['pending', 'verified', 'rejected'])->default('pending');
            $table->uuid('diverifikasi_oleh')->nullable();
            $table->timestamp('diverifikasi_pada')->nullable();
            $table->text('alasan_penolakan')->nullable();

            $table->enum('status_pendaftaran', ['draft', 'submitted', 'verified', 'rejected'])->default('draft');
            $table->enum('status_ujian', ['not_taken', 'scheduled', 'completed'])->default('not_taken');
            $table->enum('status_hasil', ['pending', 'passed', 'failed'])->default('pending');
            $table->text('file_dokumen')->nullable(); 
            $table->text('foto')->nullable(); 

            $table->timestamp('dikirim_pada')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('pendaftar_id')->references('id')->on('pendaftar');
            $table->foreign('periode_penerimaan_id')->references('id')->on('periode_penerimaan');
            $table->foreign('program_studi_id')->references('id')->on('program_studi');
            $table->foreign('jadwal_ujian_id')->references('id')->on('jadwal_ujian');
            $table->foreign('diverifikasi_oleh')->references('id')->on('users');
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
