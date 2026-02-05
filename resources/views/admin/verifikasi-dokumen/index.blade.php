@extends('layouts.admin.app')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Verifikasi Dokumen</h1>
    </div>

    <div class="section-body">
        <div class="card">
            <div class="card-header">
                <h4>Data Dokumen Pendaftar</h4>
            </div>

            <div class="card-body table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Dokumen</th>
                            <th>Foto</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pendaftaran as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->pendaftar->nama_lengkap }}</td>
                            <td>
                                <a href="{{ asset($item->file_dokumen) }}"
                                   target="_blank" class="btn btn-info btn-sm">
                                    Lihat
                                </a>
                            </td>
                            <td>
                                <a href="{{ asset($item->foto) }}"
                                   target="_blank" class="btn btn-info btn-sm">
                                    Lihat
                                </a>
                            </td>
                            <td>
                                @if($item->status_dokumen == 'verified')
                                    <span class="badge badge-success">Valid</span>
                                @elseif($item->status_dokumen == 'rejected')
                                    <span class="badge badge-danger">Ditolak</span>
                                @else
                                    <span class="badge badge-warning">Pending</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('pendaftaran.verifikasi',$item->id) }}"
                                   class="btn btn-success btn-sm">
                                    Verifikasi
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</section>
@endsection
