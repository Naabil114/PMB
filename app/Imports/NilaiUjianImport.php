<?php

namespace App\Imports;

use App\Models\NilaiUjian;
use App\Models\Pendaftar;
use App\Models\Pendaftaran;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class NilaiUjianImport implements ToModel, WithHeadingRow
{
    public int $success = 0;
    public int $failed = 0;

    public function model(array $row)
    {
        try {
            $nomor = trim($row['nomor_pendaftaran']);

            // ================= 1. Cari pendaftar =================
            $pendaftar = Pendaftar::where('nomor_pendaftaran', $nomor)->first();
            if (!$pendaftar) {
                $this->failed++;
                return null;
            }

            // ================= 2. Cari pendaftaran =================
            $pendaftaran = Pendaftaran::where('pendaftar_id', $pendaftar->id)
                ->latest()
                ->first();

            if (!$pendaftaran) {
                $this->failed++;
                return null;
            }

            // ================= 3. Cegah duplikat nilai =================
            if (NilaiUjian::where('pendaftaran_id', $pendaftaran->id)->exists()) {
                $this->failed++;
                return null;
            }

            // ================= 4. Validasi nilai =================
            $nilaiTulis     = (float) $row['nilai_tulis'];
            $nilaiWawancara = (float) $row['nilai_wawancara'];

            if (
                $nilaiTulis < 0 || $nilaiTulis > 100 ||
                $nilaiWawancara < 0 || $nilaiWawancara > 100
            ) {
                $this->failed++;
                return null;
            }

            // ================= 5. Tentukan kelulusan =================
            $lulus = (int) ($row['lulus'] ?? 0);

            // ================= 6. UPDATE STATUS PENDAFTARAN 🔥 =================
            $pendaftaran->update([
                'status_ujian' => 'completed',
                'status_hasil' => $lulus ? 'passed' : 'failed',
            ]);

            $this->success++;

            // ================= 7. Simpan nilai ujian =================
            return new NilaiUjian([
                'pendaftaran_id'  => $pendaftaran->id,
                'nilai_tulis'     => $nilaiTulis,
                'nilai_wawancara' => $nilaiWawancara,
                'nilai_total'     => $nilaiTulis + $nilaiWawancara,
                'lulus'           => $lulus,
                'grade'           => strtoupper($row['grade'] ?? 'C'),
                'catatan'         => $row['catatan'] ?? null,
                'dinilai_oleh'    => auth()->id(),
                'dinilai_pada'    => now(),
            ]);

        } catch (\Throwable $e) {
            $this->failed++;
            return null;
        }
    }
}
