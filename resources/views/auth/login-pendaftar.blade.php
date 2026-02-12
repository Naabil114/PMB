@extends('layouts.admin.auth')

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                <div class="login-brand mb-1 text-center">
                    {{-- <img src="/logo.png" alt="logo" width="100" class="shadow-light rounded-circle"> --}}
                </div>

                <h6 class="fs-5 text-center text-primary">
                    PMB
                </h6>

                <div class="card card-primary">
                    <div class="card-header">
                        <h4>Login Pendaftar</h4>
                    </div>

                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {!! nl2br(e(session('success'))) !!}
                            </div>
                        @endif
                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('pendaftar.login') }}">
                            @csrf

                            <div class="form-group">
                                <label>Nomor Pendaftaran</label>
                                <input type="text" name="nomor_pendaftaran"
                                    class="form-control @error('nomor_pendaftaran') is-invalid @enderror"
                                     required autofocus>
                                @error('nomor_pendaftaran')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Kode Akses</label>
                                <input type="password" name="kode_akses"
                                    class="form-control @error('kode_akses') is-invalid @enderror" required>
                                @error('kode_akses')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-lg btn-block">
                                    Login
                                </button>
                            </div>

                            <div class="text-center mt-3">
                                <a href="{{ route('pendaftar.register.form') }}">
                                    Belum punya akun? Daftar di sini
                                </a>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
