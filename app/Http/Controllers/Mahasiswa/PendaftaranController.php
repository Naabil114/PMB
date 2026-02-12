<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Models\Pendaftar;
use App\Models\JadwalUjian;
use App\Models\Pendaftaran;
use App\Models\ProgramStudi;
use Illuminate\Http\Request;
use App\Models\PeriodePenerimaan;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PendaftaranController extends Controller
{
    public function step1($periodeId)
    {
        $periode = PeriodePenerimaan::findOrFail($periodeId);

        if (
            !$periode->aktif ||
            !now()->between(
                $periode->tanggal_mulai_pendaftaran,
                $periode->tanggal_selesai_pendaftaran
            )
        ) {
            abort(403, 'Periode ditutup');
        }

        $existing = Pendaftaran::where('pendaftar_id', session('pendaftar_id'))
            ->where('periode_penerimaan_id', $periodeId)
            ->first();

        if ($existing) {
            return redirect()->route('pendaftaran.step2', $existing->id);
        }

        return view('mahasiswa.pendaftaran.step1', compact('periode'));
    }

    public function storeStep1(Request $request)
    {
        $request->validate([
            'periode_penerimaan_id' => 'required|exists:periode_penerimaan,id',
            'jenjang' => 'required|in:S1,S2',
        ]);

        $pendaftar = Auth::guard('pendaftar')->user();
        if (!$pendaftar)
            abort(401);

        $pendaftaran = Pendaftaran::where('pendaftar_id', $pendaftar->id)
            ->where('periode_penerimaan_id', $request->periode_penerimaan_id)
            ->first();

        if ($pendaftaran) {
            $pendaftaran->update([
                'jenjang' => $request->jenjang,
            ]);
        } else {
            $pendaftaran = Pendaftaran::create([
                'pendaftar_id' => $pendaftar->id,
                'periode_penerimaan_id' => $request->periode_penerimaan_id,
                'jenjang' => $request->jenjang,
                'status_pendaftaran' => 'draft',
                'status_ujian' => 'not_taken',
            ]);
        }

        return redirect()->route('pendaftaran.step2', $pendaftaran->id);
    }


    public function step2($id)
    {
        $pendaftaran = Pendaftaran::findOrFail($id);
        $this->authorizeAccess($pendaftaran);

        $prodi = ProgramStudi::where('aktif', 1)
            ->where('jenjang', $pendaftaran->jenjang)
            ->get();

        return view('mahasiswa.pendaftaran.step2', compact('pendaftaran', 'prodi'));
    }

    public function storeStep2(Request $request, $id)
    {
        $pendaftaran = Pendaftaran::findOrFail($id);
        $this->authorizeAccess($pendaftaran);

        $request->validate([
            'program_studi_id' => [
                'required',
                'exists:program_studi,id',
                function ($attribute, $value, $fail) use ($pendaftaran) {
                    $prodi = ProgramStudi::find($value);
                    if (!$prodi || $prodi->jenjang !== $pendaftaran->jenjang) {
                        $fail('Program Studi tidak valid untuk jenjang ini.');
                    }
                }
            ],
        ]);

        $pendaftaran->update([
            'program_studi_id' => $request->program_studi_id
        ]);

        return redirect()->route('pendaftaran.step3', $id);
    }

    public function step3($id)
    {
        $pendaftaran = Pendaftaran::findOrFail($id);
        $this->authorizeAccess($pendaftaran);

        $jadwal = JadwalUjian::where('aktif', 1)
            ->whereColumn('jumlah_terdaftar', '<', 'kuota')
            ->get();

        return view('mahasiswa.pendaftaran.step3', compact('pendaftaran', 'jadwal'));
    }

    public function storeStep3(Request $request, $id)
    {
        $pendaftaran = Pendaftaran::findOrFail($id);
        $this->authorizeAccess($pendaftaran);

        $request->validate([
            'pendidikan_terakhir' => 'required|string|max:50',
            'institusi_terakhir' => 'required|string|max:100',
            'jurusan_terakhir' => 'required|string|max:50',
            'tahun_lulus' => 'required|digits:4|integer|min:1900|max:' . date('Y'),
            'ipk' => 'required|numeric|between:0,4',
            'jadwal_ujian_id' => 'required|exists:jadwal_ujian,id',
        ]);

        $jadwal = JadwalUjian::findOrFail($request->jadwal_ujian_id);

        if ($jadwal->jumlah_terdaftar >= $jadwal->kuota) {
            return back()->with('error', 'Kuota jadwal ujian penuh');
        }

        $pendaftaran->update([
            'pendidikan_terakhir' => $request->pendidikan_terakhir,
            'institusi_terakhir' => $request->institusi_terakhir,
            'jurusan_terakhir' => $request->jurusan_terakhir,
            'tahun_lulus' => $request->tahun_lulus,
            'ipk' => $request->ipk,
            'jadwal_ujian_id' => $jadwal->id,
            'status_ujian' => 'scheduled',
        ]);

        $jadwal->increment('jumlah_terdaftar');

        return redirect()->route('pendaftaran.step4', $id);
    }

    public function step4($id)
    {
        $pendaftaran = Pendaftaran::findOrFail($id);
        $this->authorizeAccess($pendaftaran);

        return view('mahasiswa.pendaftaran.step4', compact('pendaftaran'));
    }

    public function storeStep4(Request $request, $id)
    {
        $pendaftaran = Pendaftaran::findOrFail($id);
        $this->authorizeAccess($pendaftaran);

        $request->validate([
            'file_dokumen' => 'required|mimes:pdf|max:2048',
            'foto' => 'required|image|mimes:jpg,jpeg|max:1024|dimensions:min_width=300,min_height=300,max_width=2000,max_height=2000',
        ]);

        $dokumenDir = public_path('uploads/dokumen');
        $fotoDir = public_path('uploads/foto');

        if (!file_exists($dokumenDir))
            mkdir($dokumenDir, 0755, true);
        if (!file_exists($fotoDir))
            mkdir($fotoDir, 0755, true);

        $pdfName = 'dokumen_' . $pendaftaran->id . '_' . time() . '.pdf';
        $fotoName = 'foto_' . $pendaftaran->id . '_' . time() . '.' . $request->foto->extension();

        $request->file('file_dokumen')->move($dokumenDir, $pdfName);
        $request->file('foto')->move($fotoDir, $fotoName);

        $pendaftaran->update([
            'file_dokumen' => 'uploads/dokumen/' . $pdfName,
            'foto' => 'uploads/foto/' . $fotoName,
            'status_dokumen' => 'pending',
        ]);

        return redirect()->route('pendaftaran.review', $id);
    }

    public function review($id)
    {
        $pendaftaran = Pendaftaran::with(['programStudi', 'jadwalUjian.sesi', 'jadwalUjian.ruang'])
            ->findOrFail($id);

        $this->authorizeAccess($pendaftaran);

        if (
            !$pendaftaran->jenjang ||
            !$pendaftaran->program_studi_id || !$pendaftaran->pendidikan_terakhir ||
            !$pendaftaran->jadwal_ujian_id || !$pendaftaran->file_dokumen || !$pendaftaran->foto
        ) {
            abort(403, 'Data pendaftaran belum lengkap.');
        }

        return view('mahasiswa.pendaftaran.review', compact('pendaftaran'));
    }

    public function submit($id)
    {
        $pendaftaran = Pendaftaran::findOrFail($id);
        $this->authorizeAccess($pendaftaran);

        $pendaftaran->update([
            'status_pendaftaran' => 'submitted',
            'dikirim_pada' => now(),
        ]);

        return redirect()->route('mahasiswa.periode.index')
            ->with('success', 'Pendaftaran berhasil dikirim');
    }

    private function authorizeAccess($pendaftaran)
    {
        $pendaftar = Auth::guard('pendaftar')->user();

        if (!$pendaftar) {
            abort(401, 'Silakan login');
        }

        $pendaftarId = $pendaftar->id;

        if ((int) $pendaftaran->pendaftar_id !== (int) $pendaftarId) {
            abort(403, 'Akses tidak diizinkan');
        }

    }

    public function dataPendaftar()
    {
        $pendaftar = Auth::guard('pendaftar')->user();

        if (!$pendaftar) {
            abort(401, 'Silakan login');
        }

        return view('mahasiswa.data.index', compact('pendaftar'));
    }




}
