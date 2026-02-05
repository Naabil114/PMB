@extends('layouts.admin.app')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Verifikasi Dokumen</h1>
    </div>

    <div class="section-body">
        <div class="card">
            <div class="card-body">

                <p><strong>Nama:</strong> {{ $pendaftaran->pendaftar->nama_lengkap }}</p>

                <p>
                    <a target="_blank" href="{{ asset($pendaftaran->file_dokumen) }}">
                        Lihat Dokumen
                    </a> |
                    <a target="_blank" href="{{ asset($pendaftaran->foto) }}">
                        Lihat Foto
                    </a>
                </p>

                <form action="{{ route('pendaftaran.verifikasi.simpan', $pendaftaran->id) }}"
                      method="POST">
                    @csrf

                    <div class="form-group">
                        <label>Status Dokumen</label>
                        <select name="status_dokumen" class="form-control" required>
                            <option value="verified">Valid</option>
                            <option value="rejected">Ditolak</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Alasan Penolakan</label>
                        <textarea name="alasan_penolakan"
                                  class="form-control"
                                  placeholder="Wajib diisi jika ditolak"></textarea>
                    </div>

                    <button class="btn btn-success">Simpan Verifikasi</button>
                    <a href="{{ route('verifikasi.index') }}" class="btn btn-secondary">
                        Kembali
                    </a>
                </form>

            </div>
        </div>
    </div>
</section>
@endsection
