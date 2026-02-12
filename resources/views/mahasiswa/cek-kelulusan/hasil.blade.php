@extends('layouts.admin.app')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Hasil Seleksi</h1>
    </div>

    <div class="section-body">

        <div class="card">
            <div class="card-body table-responsive">
                <table class="table table-bordered table-striped">
                    <tr>
                        <th width="200">Nama</th>
                        <td>{{ $pendaftar->nama_lengkap }}</td>
                    </tr>
                    <tr>
                        <th>Nomor Pendaftaran</th>
                        <td>{{ $pendaftar->nomor_pendaftaran }}</td>
                    </tr>
                    <tr>
                        <th>Program Studi</th>
                        <td>{{ $pendaftaran?->programStudi?->nama_program ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Periode</th>
                        <td>{{ $pendaftaran?->periode?->nama_periode ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Status Hasil</th>
                        <td>
                            @if ($pendaftaran->status_pendaftaran == 'draft')
                                <span class="badge badge-secondary">DRAFT</span>
                            @elseif($pendaftaran->status_pendaftaran == 'submitted')
                                <span class="badge badge-info">TERKIRIM</span>
                            @elseif($pendaftaran->status_pendaftaran == 'verified')
                                <span class="badge badge-success">LOLOS ADMINISTRASI</span>
                            @elseif($pendaftaran->status_pendaftaran == 'rejected')
                                <span class="badge badge-danger">DITOLAK</span>
                            @else
                                <span class="badge badge-warning">TIDAK DIKETAHUI</span>
                            @endif
                        </td>
                    </tr>
                </table>

                <div class="mt-3">
                    <a href="{{ route('cek.kelulusan') }}" class="btn btn-success">Cek Lagi</a>
                </div>
            </div>
        </div>

    </div>
</section>
@endsection
