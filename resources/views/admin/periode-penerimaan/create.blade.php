@extends('layouts.admin.app')
@section('content')
<section class="section">
    <div class="section-header">
        <h1>Input Periode Penerimaan</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Periode</a></div>
            <div class="breadcrumb-item"><a href="#">Input Periode</a></div>
        </div>
    </div>

    <div class="section-body">
        <h2 class="section-title">Input Periode Penerimaan</h2>

        <div class="row">
            <div class="col-12 col-md-6 col-lg-6">
                <div class="card">

                    <form action="{{ route('periode.store') }}" method="POST"
                        class="needs-validation" novalidate>
                        @csrf

                        <div class="card-header">
                            <h4>Input Periode Penerimaan</h4>
                        </div>

                        <div class="card-body">

                            <div class="form-group">
                                <label>Nama Periode</label>
                                <input type="text" name="nama_periode"
                                    class="form-control @error('nama_periode') is-invalid @enderror"
                                    placeholder="Contoh: Gelombang 1"
                                    value="{{ old('nama_periode') }}" required>
                                @error('nama_periode')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @else
                                    <div class="invalid-feedback">Nama periode wajib diisi.</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Tahun Akademik</label>
                                <input type="text" name="tahun_akademik"
                                    class="form-control @error('tahun_akademik') is-invalid @enderror"
                                    placeholder="2025/2026"
                                    value="{{ old('tahun_akademik') }}" required>
                                @error('tahun_akademik')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @else
                                    <div class="invalid-feedback">Tahun akademik wajib diisi.</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Tanggal Mulai Pendaftaran</label>
                                <input type="date" name="tanggal_mulai_pendaftaran"
                                    class="form-control @error('tanggal_mulai_pendaftaran') is-invalid @enderror"
                                    value="{{ old('tanggal_mulai_pendaftaran') }}" required>
                                @error('tanggal_mulai_pendaftaran')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @else
                                    <div class="invalid-feedback">Tanggal mulai pendaftaran wajib diisi.</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Tanggal Selesai Pendaftaran</label>
                                <input type="date" name="tanggal_selesai_pendaftaran"
                                    class="form-control @error('tanggal_selesai_pendaftaran') is-invalid @enderror"
                                    value="{{ old('tanggal_selesai_pendaftaran') }}" required>
                                @error('tanggal_selesai_pendaftaran')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @else
                                    <div class="invalid-feedback">Tanggal selesai pendaftaran wajib diisi.</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Tanggal Mulai Ujian</label>
                                <input type="date" name="tanggal_mulai_ujian"
                                    class="form-control @error('tanggal_mulai_ujian') is-invalid @enderror"
                                    value="{{ old('tanggal_mulai_ujian') }}" required>
                                @error('tanggal_mulai_ujian')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @else
                                    <div class="invalid-feedback">Tanggal mulai ujian wajib diisi.</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Tanggal Selesai Ujian</label>
                                <input type="date" name="tanggal_selesai_ujian"
                                    class="form-control @error('tanggal_selesai_ujian') is-invalid @enderror"
                                    value="{{ old('tanggal_selesai_ujian') }}" required>
                                @error('tanggal_selesai_ujian')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @else
                                    <div class="invalid-feedback">Tanggal selesai ujian wajib diisi.</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Tanggal Pengumuman</label>
                                <input type="date" name="tanggal_pengumuman"
                                    class="form-control @error('tanggal_pengumuman') is-invalid @enderror"
                                    value="{{ old('tanggal_pengumuman') }}" required>
                                @error('tanggal_pengumuman')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @else
                                    <div class="invalid-feedback">Tanggal pengumuman wajib diisi.</div>
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
