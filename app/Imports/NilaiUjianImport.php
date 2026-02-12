<?php

namespace App\Imports;

use App\Models\NilaiUjian;
use App\Models\Pendaftar;
use App\Models\Pendaftaran;
use Illuminate\Support\Facades\Http;
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

            $pendaftar = Pendaftar::where('nomor_pendaftaran', $nomor)->first();
            if (!$pendaftar) {
                $this->failed++;
                return null;
            }

            $pendaftaran = Pendaftaran::where('pendaftar_id', $pendaftar->id)
                ->latest()
                ->first();

            if (!$pendaftaran) {
                $this->failed++;
                return null;
            }

            if (NilaiUjian::where('pendaftaran_id', $pendaftaran->id)->exists()) {
                $this->failed++;
                return null;
            }

            $nilaiTulis     = (float) $row['nilai_tulis'];
            $nilaiWawancara = (float) $row['nilai_wawancara'];

            if (
                $nilaiTulis < 0 || $nilaiTulis > 100 ||
                $nilaiWawancara < 0 || $nilaiWawancara > 100
            ) {
                $this->failed++;
                return null;
            }

            $lulus = (int) ($row['lulus'] ?? 0);

            $pendaftaran->update([
                'status_ujian' => 'completed',
                'status_hasil' => $lulus ? 'passed' : 'failed',
            ]);

            if ($lulus === 1) {
                $nomorWa = preg_replace('/[^0-9]/', '', $pendaftar->whatsapp);
                $this->kirimWhatsApp($nomorWa, $pendaftar->nama_lengkap);
            }

            $this->success++;

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

    
    protected function kirimWhatsApp($nomor, $nama)
    {
        $token = config('services.fonnte.api_key');
        $url   = config('services.fonnte.url');

        $message = "Halo *$nama*,\n\n"
            . "Selamat 🎉 Anda *LULUS UJIAN*.\n"
            . "Silakan login ke dashboard PMB untuk melihat informasi selanjutnya.\n\n"
            . "Terima kasih.";

        $response = Http::asForm()
            ->withHeaders([
                'Authorization' => $token
            ])
            ->post($url, [
                'target'  => $nomor,
                'message' => $message
            ]);

        
    }
}