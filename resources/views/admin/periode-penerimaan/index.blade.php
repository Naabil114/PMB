@extends('layouts.admin.app')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Daftar Periode Penerimaan</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Periode</a></div>
                <div class="breadcrumb-item">Daftar</div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Daftar Periode Penerimaan</h2>

            <div class="row">
                <div class="col-12">
                    <div class="card">

                        <div class="card-header">
                            <h4>Periode Penerimaan</h4>
                            <a href="{{ route('periode.create') }}" class="btn btn-primary ml-auto">
                                Tambah Periode
                            </a>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped" id="table-2">
                                    <thead>
                                        <tr>
                                            <th class="text-center">No</th>
                                            <th>Nama Periode</th>
                                            <th>Tahun Akademik</th>
                                            <th>Pendaftaran</th>
                                            <th>Ujian</th>
                                            <th>Pengumuman</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($periode as $item)
                                            <tr>
                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                <td>{{ $item->nama_periode }}</td>
                                                <td>{{ $item->tahun_akademik }}</td>
                                                <td>
                                                    {{ \Carbon\Carbon::parse($item->tanggal_mulai_pendaftaran)->translatedFormat('d M Y') }}
                                                    –
                                                    {{ \Carbon\Carbon::parse($item->tanggal_selesai_pendaftaran)->translatedFormat('d M Y') }}
                                                </td>

                                                <td>
                                                    {{ \Carbon\Carbon::parse($item->tanggal_mulai_ujian)->translatedFormat('d M Y') }}
                                                    –
                                                    {{ \Carbon\Carbon::parse($item->tanggal_selesai_ujian)->translatedFormat('d M Y') }}
                                                </td>

                                                <td>
                                                    {{ \Carbon\Carbon::parse($item->tanggal_pengumuman)->translatedFormat('d M Y') }}
                                                </td>

                                                <td>
                                                    @if ($item->aktif)
                                                        <div class="badge badge-success">Aktif</div>
                                                    @else
                                                        <div class="badge badge-danger">Nonaktif</div>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ route('periode.edit', $item->id) }}"
                                                        class="btn btn-sm btn-warning">
                                                        Edit
                                                    </a>

                                                    <button type="button" class="btn btn-sm btn-danger btn-delete"
                                                        data-id="{{ $item->id }}">
                                                        Hapus
                                                    </button>

                                                    <form id="delete-form-{{ $item->id }}"
                                                        action="{{ route('periode.destroy', $item->id) }}" method="POST"
                                                        style="display:none;">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach

                                        @if ($periode->isEmpty())
                                            <tr>
                                                <td colspan="8" class="text-center">
                                                    Belum ada data periode penerimaan
                                                </td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const deleteButtons = document.querySelectorAll('.btn-delete');

        deleteButtons.forEach(button => {
            button.addEventListener('click', function() {
                const id = this.getAttribute('data-id');

                Swal.fire({
                    title: 'Yakin hapus periode ini?',
                    text: 'Data yang sudah dihapus tidak bisa dikembalikan!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('delete-form-' + id).submit();
                    }
                });
            });
        });

        @if (session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Gagal hapus',
                text: "{{ session('error') }}",
                confirmButtonColor: '#3085d6',
            });
        @endif
    });
</script>
