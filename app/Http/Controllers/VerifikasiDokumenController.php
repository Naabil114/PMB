<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class VerifikasiDokumenController extends Controller
{

    public function index()
    {
        $pendaftaran = Pendaftaran::with('pendaftar', 'programStudi')
            ->whereIn('status_pendaftaran', ['submitted', 'rejected'])
            ->latest()
            ->get();
        return view('admin.verifikasi-dokumen.index', compact('pendaftaran'));
    }

      public function formVerifikasi($id)
    {
        $pendaftaran = Pendaftaran::with('pendaftar')->findOrFail($id);

        return view('admin.verifikasi-dokumen.form', compact('pendaftaran'));
    }

    public function simpanVerifikasi(Request $request, $id)
    {
        $request->validate([
            'status_dokumen' => 'required|in:verified,rejected',
            'alasan_penolakan' => 'nullable|required_if:status_dokumen,rejected'
        ]);

        $pendaftaran = Pendaftaran::findOrFail($id);

        $pendaftaran->update([
            'status_dokumen' => $request->status_dokumen,
            'alasan_penolakan' => $request->alasan_penolakan,
            'diverifikasi_oleh' => auth()->id(),
            'diverifikasi_pada' => now(),
        ]);

        // jika ditolak → kirim WA
        if ($request->status_dokumen === 'rejected') {
            // kirim WhatsApp di sini
        }

        return redirect()
            ->route('verifikasi.index')
            ->with('success', 'Verifikasi dokumen berhasil');
    }
    public function verifikasi(Request $request, $id)
    {
        $pendaftaran = Pendaftaran::findOrFail($id);

        $pendaftaran->update([
            'status_dokumen' => $request->status, 
            'alasan_penolakan' => $request->alasan,
            'diverifikasi_oleh' => auth()->id(),
            'diverifikasi_pada' => now(),
        ]);

        if ($request->status === 'rejected') {
        }

        return back()->with('success', 'Status dokumen diperbarui');
    }

    public function dokumenPendaftar()
    {
        $pendaftarId = Auth::guard('pendaftar')->user();

        $pendaftaran = Pendaftaran::where('pendaftar_id', $pendaftarId->id)
            ->with('pendaftar', 'programStudi')
            ->firstOrFail();

        return view('mahasiswa.verifikasi-dokumen.index', compact('pendaftaran'));
    }



    public function formUploadUlang($id)
    {
        $pendaftaran = Pendaftaran::findOrFail($id);


        return view('mahasiswa.pendaftaran.upload-ulang', compact('pendaftaran'));
    }

    public function prosesUploadUlang(Request $request, $id)
{
    $pendaftaran = Pendaftaran::findOrFail($id);

    $request->validate([
        'file_dokumen' => 'nullable|mimes:pdf|max:2048',
        'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:1024|dimensions:min_width=300,min_height=300,max_width=2000,max_height=2000',
    ]);

    if ($request->hasFile('file_dokumen')) {
        $file = $request->file('file_dokumen');
        $fileName = 'dokumen_'.$pendaftaran->id.'_'.time().'.pdf';
        $file->move(public_path('uploads/dokumen'), $fileName);
        $pendaftaran->file_dokumen = 'uploads/dokumen/'.$fileName;
    }

    if ($request->hasFile('foto')) {
        $foto = $request->file('foto');
        $fotoName = 'foto_'.$pendaftaran->id.'_'.time().'.'.$foto->extension();
        $foto->move(public_path('uploads/foto'), $fotoName);
        $pendaftaran->foto = 'uploads/foto/'.$fotoName;
    }

    $pendaftaran->status_dokumen = 'pending';
    $pendaftaran->alasan_penolakan = null;
    $pendaftaran->save();

    return redirect()->route('pendaftar.verifikasi.index', $pendaftaran->id)
        ->with('success', 'Dokumen berhasil diupload ulang.');
}

   

    
}
