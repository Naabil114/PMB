@extends('layouts.admin.app')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Upload Ulang Dokumen</h1>
    </div>

    <div class="section-body">
        <div class="card">
            <div class="card-header"><h4>Form Upload Ulang</h4></div>
            <div class="card-body">
                <form action="{{ route('pendaftaran.prosesUploadUlang', $pendaftaran->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label>Dokumen Pendaftaran (PZF)</label>
                        <input type="file" name="file_dokumen" class="form-control">
                        @if ($pendaftaran->file_dokumen)
                            <small>File sebelumnya: <a href="{{ asset($pendaftaran->file_dokumen) }}" target="_blank">Lihat</a></small>
                        @endif
                    </div>

                    <div class="form-group">
                        <label>Pas Foto</label>
                        <input type="file" name="foto" class="form-control">
                        @if ($pendaftaran->foto)
                            <small>Foto sebelumnya: <a href="{{ asset($pendaftaran->foto) }}" target="_blank">Lihat</a></small>
                        @endif
                    </div>

                    <button type="submit" class="btn btn-primary">Upload Ulang</button>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
