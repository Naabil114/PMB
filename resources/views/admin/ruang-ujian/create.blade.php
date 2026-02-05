@extends('layouts.admin.app')
@section('content')
<section class="section">
    <div class="section-header">
        <h1>Input Ruang Ujian</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Ruang Ujian</a></div>
            <div class="breadcrumb-item">Input</div>
        </div>
    </div>

    <div class="section-body">
        <h2 class="section-title">Input Ruang Ujian</h2>

        <div class="row">
            <div class="col-12 col-md-6 col-lg-6">
                <div class="card">

                    <form action="{{ route('ruang-ujian.store') }}" method="POST"
                        class="needs-validation" novalidate>
                        @csrf

                        <div class="card-header">
                            <h4>Input Ruang Ujian</h4>
                        </div>

                        <div class="card-body">

                            <div class="form-group">
                                <label>Kode Ruang</label>
                                <input type="text" name="kode_ruang"
                                    class="form-control @error('kode_ruang') is-invalid @enderror"
                                    placeholder="Contoh: R101"
                                    value="{{ old('kode_ruang') }}" required>
                                @error('kode_ruang')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @else
                                    <div class="invalid-feedback">Kode ruang wajib diisi.</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Nama Ruang</label>
                                <input type="text" name="nama_ruang"
                                    class="form-control @error('nama_ruang') is-invalid @enderror"
                                    placeholder="Ruang Teori 1"
                                    value="{{ old('nama_ruang') }}" required>
                                @error('nama_ruang')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @else
                                    <div class="invalid-feedback">Nama ruang wajib diisi.</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Gedung</label>
                                <input type="text" name="gedung"
                                    class="form-control @error('gedung') is-invalid @enderror"
                                    placeholder="Gedung A"
                                    value="{{ old('gedung') }}" required>
                                @error('gedung')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @else
                                    <div class="invalid-feedback">Gedung wajib diisi.</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Kapasitas</label>
                                <input type="number" name="kapasitas"
                                    class="form-control @error('kapasitas') is-invalid @enderror"
                                    placeholder="40"
                                    value="{{ old('kapasitas') }}" required>
                                @error('kapasitas')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @else
                                    <div class="invalid-feedback">Kapasitas wajib diisi.</div>
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
