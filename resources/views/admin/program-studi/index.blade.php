@extends('layouts.admin.app')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Daftar Program Studi</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Prodi</a></div>
                <div class="breadcrumb-item">Daftar</div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Daftar Program Studi</h2>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Program Studi</h4>
                            <a href="{{ route('prodi.create') }}" class="btn btn-primary ml-auto">Tambah Prodi</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped" id="table-2">
                                    <thead>
                                        <tr>
                                            <th class="text-center">No</th>
                                            <th>Kode Program</th>
                                            <th>Nama Program Studi</th>
                                            <th>Jenjang</th>
                                            <th>Fakultas</th>
                                            <th>Deskripsi</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($programStudi as $prodi)
                                            <tr>
                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                <td>{{ $prodi->kode_program }}</td>
                                                <td>{{ $prodi->nama_program }}</td>
                                                <td>{{ $prodi->jenjang }}</td>
                                                <td>{{ $prodi->fakultas }}</td>
                                                <td>{{ Str::limit($prodi->deskripsi, 50) }}</td>
                                                <td>
                                                    @if ($prodi->aktif)
                                                        <div class="badge badge-success">Aktif</div>
                                                    @else
                                                        <div class="badge badge-danger">Nonaktif</div>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ route('prodi.edit', $prodi->id) }}"
                                                        class="btn btn-sm btn-warning">Edit</a>

                                                    <button type="button" class="btn btn-sm btn-danger btn-delete"
                                                        data-id="{{ $prodi->id }}">
                                                        Hapus
                                                    </button>

                                                    <form id="delete-form-{{ $prodi->id }}"
                                                        action="{{ route('prodi.destroy', $prodi->id) }}" method="POST"
                                                        style="display:none;">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                </td> 

                                            </tr>
                                        @endforeach
                                        @if ($programStudi->isEmpty())
                                            <tr>
                                                <td colspan="8" class="text-center">Belum ada data program studi</td>
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
                const prodiId = this.getAttribute('data-id');

                Swal.fire({
                    title: 'Yakin hapus prodi ini?',
                    text: "Data yang sudah dihapus tidak bisa dikembalikan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('delete-form-' + prodiId).submit();
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
