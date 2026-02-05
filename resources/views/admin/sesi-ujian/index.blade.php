@extends('layouts.admin.app')
@section('content')
<section class="section">
    <div class="section-header">
        <h1>Daftar Sesi Ujian</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Sesi Ujian</a></div>
            <div class="breadcrumb-item">Daftar</div>
        </div>
    </div>

    <div class="section-body">
        <h2 class="section-title">Daftar Sesi Ujian</h2>

        <div class="row">
            <div class="col-12">
                <div class="card">

                    <div class="card-header">
                        <h4>Sesi Ujian</h4>
                        <a href="{{ route('sesi-ujian.create') }}"
                            class="btn btn-primary ml-auto">Tambah Sesi</a>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="table-2">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th>Nama Sesi</th>
                                        <th>Jam</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($sesiUjian as $item)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td>{{ $item->nama_sesi }}</td>
                                            <td>{{ $item->jam_mulai }} – {{ $item->jam_selesai }}</td>
                                            <td>
                                                @if ($item->aktif)
                                                    <div class="badge badge-success">Aktif</div>
                                                @else
                                                    <div class="badge badge-danger">Nonaktif</div>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('sesi-ujian.edit', $item->id) }}"
                                                    class="btn btn-sm btn-warning">Edit</a>

                                                <button type="button"
                                                    class="btn btn-sm btn-danger btn-delete"
                                                    data-id="{{ $item->id }}">
                                                    Hapus
                                                </button>

                                                <form id="delete-form-{{ $item->id }}"
                                                    action="{{ route('sesi-ujian.destroy', $item->id) }}"
                                                    method="POST" style="display:none;">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach

                                    @if ($sesiUjian->isEmpty())
                                        <tr>
                                            <td colspan="5" class="text-center">Belum ada data sesi ujian</td>
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
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.btn-delete').forEach(btn => {
        btn.addEventListener('click', function () {
            const id = this.dataset.id;

            Swal.fire({
                title: 'Yakin hapus sesi ini?',
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
});
</script>
