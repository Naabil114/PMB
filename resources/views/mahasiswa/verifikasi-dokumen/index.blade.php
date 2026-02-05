@extends('layouts.admin.app')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Verifikasi Dokumen</h1>
    </div>

    <div class="section-body">

    @if (!$pendaftaran)
        <div class="alert alert-warning">
            Data pendaftaran tidak ditemukan.
        </div>
    @else

        <div class="card">
            <div class="card-header">
                <h4>Data Pendaftar</h4>
            </div>
            <div class="card-body">
                <table class="table table-sm">
                    <tr>
                        <th width="200">Nama Lengkap</th>
                        <td>{{ $pendaftaran->pendaftar->nama_lengkap ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Program Studi</th>
                        <td>{{ $pendaftaran->programStudi->nama_program ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Jenjang</th>
                        <td>{{ $pendaftaran->programStudi->jenjang ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Status Dokumen</th>
                        <td>
                            @if ($pendaftaran->status_dokumen === 'verified')
                                <span class="badge badge-success">Terverifikasi</span>
                            @elseif ($pendaftaran->status_dokumen === 'rejected')
                                <span class="badge badge-danger">Ditolak</span>
                            @else
                                <span class="badge badge-warning">Menunggu</span>
                            @endif
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        @if ($pendaftaran->status_dokumen === 'rejected')
            <div class="alert alert-danger">
                <strong>Alasan Penolakan:</strong><br>
                {{ $pendaftaran->alasan_penolakan ?? '-' }}
            </div>
        @endif

        <div class="card">
            <div class="card-header">
                <h4>Dokumen Pendaftaran</h4>
            </div>

            <div class="card-body table-responsive">
                @php
                    $dokumen = [
                        'Dokumen Pendaftaran (PDF)' => $pendaftaran->file_dokumen,
                        'Pas Foto' => $pendaftaran->foto,
                    ];
                @endphp

                <table class="table table-bordered table-striped">
                    <thead class="text-center">
                        <tr>
                            <th>No</th>
                            <th>Nama Dokumen</th>
                            <th>File</th>
                            <th>Status / Aksi</th>
                        </tr>
                    </thead>
                    <tbody>

                    @if (empty(array_filter($dokumen)))
                        <tr>
                            <td colspan="4" class="text-center text-muted">
                                Belum ada dokumen yang diunggah.
                            </td>
                        </tr>
                    @else
                        @foreach ($dokumen as $nama => $file)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{ $nama }}</td>
                                <td class="text-center">
                                    @if ($file)
                                        <a href="{{ asset($file) }}" target="_blank" class="btn btn-sm btn-primary">
                                            Lihat File
                                        </a>
                                    @else
                                        <span class="badge badge-secondary">Belum Upload</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if ($pendaftaran->status_dokumen === 'verified')
                                        <span class="badge badge-success">Diterima</span>
                                    @elseif ($pendaftaran->status_dokumen === 'rejected')
                                        <span class="badge badge-danger">Ditolak</span>

                                        <form action="{{ route('pendaftaran.uploadUlang', $pendaftaran->id) }}" method="GET" class="mt-2">
                                            <button type="submit" class="btn btn-sm btn-warning">
                                                Upload Ulang
                                            </button>
                                        </form>
                                    @else
                                        <span class="badge badge-warning">Menunggu</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    @endif

                    </tbody>
                </table>
            </div>
        </div>

        @if ($pendaftaran->status_pendaftaran === 'rejected')
            <div class="text-right mt-3">
                <a href="{{ route('pendaftaran.uploadUlang', $pendaftaran->id) }}" class="btn btn-warning">
                    Upload Ulang Dokumen
                </a>
            </div>
        @endif

    @endif
    </div>
</section>
@endsection
