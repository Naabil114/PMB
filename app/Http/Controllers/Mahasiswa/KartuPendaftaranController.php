<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Models\Pendaftaran;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class KartuPendaftaranController extends Controller
{
    public function cetak($periodeId)
    {
        // $pendaftarId = session('pendaftar_id');
        // $pendaftarId = Auth::guard('pendaftar')->id();
        $pendaftar = Auth::guard('pendaftar')->user();
$pendaftarId = $pendaftar->id; // kolom id numeric

        // dd( $pendaftarId );

        if (!$pendaftarId) {
            abort(403, 'Session pendaftar tidak ditemukan');
        }

        $pendaftaran = Pendaftaran::with([
            'pendaftar',
            'programStudi',
            'jadwalUjian.sesi',
            'jadwalUjian.ruang',
            'periode'
        ])
        ->where('periode_penerimaan_id', $periodeId)
        ->where('pendaftar_id', $pendaftarId)
        ->firstOrFail();
      


        $pdf = Pdf::loadView('mahasiswa.kartu.pdf', [
            'pendaftaran' => $pendaftaran
        ])->setPaper('A4', 'portrait');

        return $pdf->stream(
            'kartu-pendaftaran-' . $pendaftaran->pendaftar->nomor_pendaftaran . '.pdf'
        );
    }
}
