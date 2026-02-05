@extends('layouts.admin.app')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Manajemen Pengguna</h1>
    </div>

    <div class="section-body">
        <div class="card">
            <div class="card-header">
                <h4>Daftar Pengguna</h4>
                <a href="{{ route('users.create') }}" class="btn btn-primary ml-auto">
                    Tambah Pengguna
                </a>
            </div>

            <div class="card-body table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $user->nama_lengkap }}</td>
                            <td>{{ $user->username }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <span class="badge badge-info">
                                    {{ $user->role->nama_role }}
                                </span>
                            </td>
                            <td>
                                {!! $user->aktif 
                                    ? '<span class="badge badge-success">Aktif</span>' 
                                    : '<span class="badge badge-danger">Nonaktif</span>' !!}
                            </td>
                            <td>
                                <a href="{{ route('users.edit',$user->id) }}"
                                    class="btn btn-warning btn-sm">Edit</a>

                                <form action="{{ route('users.destroy',$user->id) }}"
                                    method="POST" style="display:inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm"
                                        onclick="return confirm('Hapus pengguna ini?')">
                                        Hapus
                                    </button>
                                </form>
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
