@extends('layouts.admin.app')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Edit Pengguna</h1>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12 col-md-6 col-lg-6">
                <div class="card">

                    <form action="{{ route('users.update', $user->id) }}" method="POST"
                        class="needs-validation" novalidate>
                        @csrf
                        @method('PUT')

                        <div class="card-header">
                            <h4>Form Edit Pengguna</h4>
                        </div>

                        <div class="card-body">

                            <div class="form-group">
                                <label>Nama Lengkap</label>
                                <input type="text" name="nama_lengkap"
                                    class="form-control"
                                    value="{{ old('nama_lengkap', $user->nama_lengkap) }}" required>
                            </div>

                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" name="username"
                                    class="form-control"
                                    value="{{ old('username', $user->username) }}" required>
                            </div>

                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" name="email"
                                    class="form-control"
                                    value="{{ old('email', $user->email) }}" required>
                            </div>

                            <div class="form-group">
                                <label>Telepon</label>
                                <input type="text" name="telepon"
                                    class="form-control"
                                    value="{{ old('telepon', $user->telepon) }}">
                            </div>

                            <div class="form-group">
                                <label>Role</label>
                                <select name="role_id" class="form-control" required>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}"
                                            {{ $user->role_id == $role->id ? 'selected' : '' }}>
                                            {{ $role->nama_role }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Password (kosongkan jika tidak diganti)</label>
                                <input type="password" name="password" class="form-control">
                            </div>

                        </div>

                        <div class="card-footer text-right">
                            <button class="btn btn-primary">Update</button>
                            <a href="{{ route('users.index') }}" class="btn btn-secondary">
                                Kembali
                            </a>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</section>
@endsection
