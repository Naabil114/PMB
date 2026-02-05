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
        Schema::create('nilai_ujian', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('pendaftaran_id')->unique();

            $table->decimal('nilai_tulis', 5, 2)->nullable();
            $table->decimal('nilai_wawancara', 5, 2)->nullable();
            $table->decimal('nilai_total', 5, 2)->nullable();
            $table->boolean('lulus')->nullable();
            $table->string('grade', 2)->nullable();
            $table->text('catatan')->nullable();

            $table->uuid('dinilai_oleh')->nullable();
            $table->timestamp('dinilai_pada')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('pendaftaran_id')->references('id')->on('pendaftaran');
            $table->foreign('dinilai_oleh')->references('id')->on('users');
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
