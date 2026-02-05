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
        Schema::create('pendaftar', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('nomor_pendaftaran')->unique();
            $table->string('kode_akses');
            $table->string('nama_lengkap');
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->string('jenis_kelamin', 10);
            $table->string('agama')->nullable();
            $table->text('alamat')->nullable();
            // $table->string('telepon')->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('email');
            $table->timestamps();
            $table->softDeletes();
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
