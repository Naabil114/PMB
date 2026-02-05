@extends('layouts.admin.app')
@section('content')
<section class="section">
    <div class="section-header">
        <h1>Input Sesi Ujian</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Sesi Ujian</a></div>
            <div class="breadcrumb-item">Input</div>
        </div>
    </div>

    <div class="section-body">
        <h2 class="section-title">Input Sesi Ujian</h2>

        <div class="row">
            <div class="col-12 col-md-6 col-lg-6">
                <div class="card">

                    <form action="{{ route('sesi-ujian.store') }}" method="POST"
                        class="needs-validation" novalidate>
                        @csrf

                        <div class="card-header">
                            <h4>Input Sesi Ujian</h4>
                        </div>

                        <div class="card-body">

                            <div class="form-group">
                                <label>Nama Sesi</label>
                                <input type="text" name="nama_sesi"
                                    class="form-control @error('nama_sesi') is-invalid @enderror"
                                    placeholder="Contoh: Sesi 1"
                                    value="{{ old('nama_sesi') }}" required>
                                @error('nama_sesi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @else
                                    <div class="invalid-feedback">Nama sesi wajib diisi.</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Jam Mulai</label>
                                <input type="time" name="jam_mulai"
                                    class="form-control @error('jam_mulai') is-invalid @enderror"
                                    value="{{ old('jam_mulai') }}" required>
                                @error('jam_mulai')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @else
                                    <div class="invalid-feedback">Jam mulai wajib diisi.</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Jam Selesai</label>
                                <input type="time" name="jam_selesai"
                                    class="form-control @error('jam_selesai') is-invalid @enderror"
                                    value="{{ old('jam_selesai') }}" required>
                                @error('jam_selesai')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @else
                                    <div class="invalid-feedback">Jam selesai wajib diisi.</div>
                                @enderror
                            </div>

                            <input type="hidden" name="aktif" value="1">

                        </div>

                        <div class="card-footer text-right">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</section>
@endsection
