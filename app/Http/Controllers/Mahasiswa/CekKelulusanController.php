<?php

namespace App\Http\Controllers\mahasiswa;

use App\Models\Pendaftar;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CekKelulusanController extends Controller
{
     public function index()
    {
        return view('mahasiswa.cek-kelulusan.index');
    }

    public function cek(Request $request)
    {
        $request->validate([
            'nomor_pendaftaran' => 'required',
            'tanggal_lahir' => 'required|date',
        ]);

        $pendaftar = Pendaftar::where('nomor_pendaftaran', $request->nomor_pendaftaran)
            ->whereDate('tanggal_lahir', $request->tanggal_lahir)
            ->first();

        if (!$pendaftar) {
            return back()->with('error', 'Data tidak ditemukan. Periksa nomor pendaftaran dan tanggal lahir.');
        }

        $pendaftaran = Pendaftaran::where('pendaftar_id', $pendaftar->id)
            ->with(['programStudi', 'periode'])
            ->latest()
            ->first();

        return view('mahasiswa.cek-kelulusan.hasil', compact('pendaftar', 'pendaftaran'));
    }
}
