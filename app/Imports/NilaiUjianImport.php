<?php

namespace App\Imports;

use App\Models\NilaiUjian;
use App\Models\Pendaftar;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class NilaiUjianImport implements ToModel, WithHeadingRow
{
    public int $insert = 0;
    public int $update = 0;
    public int $skip   = 0;

    public function model(array $row)
    {
        

        if (empty($row['nomor_pendaftaran'])) {
            $this->skip++;
            return null;
        }

        $pendaftar = Pendaftar::where('nomor_pendaftaran', trim($row['nomor_pendaftaran']))->first();
        if (!$pendaftar) {
            $this->skip++;
            return null;
        }

        $pendaftaran = $pendaftar->pendaftaran()->latest()->first();
        if (!$pendaftaran) {
            $this->skip++;
            return null;
        }

        $nilaiTulis     = is_numeric($row['nilai_tulis']) ? (float)$row['nilai_tulis'] : null;
        $nilaiWawancara = is_numeric($row['nilai_wawancara']) ? (float)$row['nilai_wawancara'] : null;
        $lulus          = $row['lulus'];

        if ($nilaiTulis === null || $nilaiWawancara === null || !in_array($lulus, [0,1,'0','1'])) {
            $this->skip++;
            return null;
        }

        $data = [
            'nilai_tulis'     => $nilaiTulis,
            'nilai_wawancara' => $nilaiWawancara,
            'nilai_total'     => $nilaiTulis + $nilaiWawancara,
            'lulus'           => (int)$lulus,
            'grade'           => strtoupper($row['grade'] ?? 'C'),
            'catatan'         => $row['catatan'] ?? null,
            'dinilai_oleh'    => Auth::id(),
            'dinilai_pada'    => now(),
        ];

      

        $nilai = NilaiUjian::where('pendaftaran_id', $pendaftaran->id)->first();

        if ($nilai) {

            $nilai->update($data);
            $this->update++;

        } else {

            $data['pendaftaran_id'] = $pendaftaran->id;
            NilaiUjian::create($data);

            $pendaftaran->update([
                'status_ujian' => 'completed',
                'status_hasil' => $data['lulus'] ? 'passed' : 'failed',
            ]);

            if ($data['lulus'] == 1 && !empty($pendaftar->whatsapp)) {
                $this->kirimWhatsApp($pendaftar->whatsapp, $pendaftar->nama_lengkap);
            }

            $this->insert++;
        }

        return null;
    }

    protected function kirimWhatsApp($nomor, $nama)
    {
        $nomor = preg_replace('/[^0-9]/', '', $nomor);

        Http::asForm()
            ->withHeaders(['Authorization' => config('services.fonnte.api_key')])
            ->post(config('services.fonnte.url'), [
                'target'  => $nomor,
                'message' => "Halo *$nama*, Anda LULUS ujian PMB 🎉"
            ]);
    }
}
