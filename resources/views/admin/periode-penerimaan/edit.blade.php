@extends('layouts.admin.app')
@section('content')
<section class="section">
    <div class="section-header">
        <h1>Edit Periode Penerimaan</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Periode</a></div>
            <div class="breadcrumb-item"><a href="#">Edit Periode</a></div>
        </div>
    </div>

    <div class="section-body">
        <h2 class="section-title">Edit Periode Penerimaan</h2>

        <div class="row">
            <div class="col-12 col-md-6 col-lg-6">
                <div class="card">

                    <form action="{{ route('periode.update', $periode->id) }}"
                        method="POST" class="needs-validation" novalidate>
                        @csrf
                        @method('PUT')

                        <div class="card-header">
                            <h4>Edit Periode Penerimaan</h4>
                        </div>

                        <div class="card-body">

                            <div class="form-group">
                                <label>Nama Periode</label>
                                <input type="text" name="nama_periode"
                                    class="form-control @error('nama_periode') is-invalid @enderror"
                                    value="{{ old('nama_periode', $periode->nama_periode) }}"
                                    required>
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
                                    value="{{ old('tahun_akademik', $periode->tahun_akademik) }}"
                                    required>
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
                                    value="{{ old('tanggal_mulai_pendaftaran', $periode->tanggal_mulai_pendaftaran) }}"
                                    required>
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
                                    value="{{ old('tanggal_selesai_pendaftaran', $periode->tanggal_selesai_pendaftaran) }}"
                                    required>
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
                                    value="{{ old('tanggal_mulai_ujian', $periode->tanggal_mulai_ujian) }}"
                                    required>
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
                                    value="{{ old('tanggal_selesai_ujian', $periode->tanggal_selesai_ujian) }}"
                                    required>
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
                                    value="{{ old('tanggal_pengumuman', $periode->tanggal_pengumuman) }}"
                                    required>
                                @error('tanggal_pengumuman')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @else
                                    <div class="invalid-feedback">Tanggal pengumuman wajib diisi.</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                    <label>Status</label>
                                    <div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="aktif" id="aktif1"
                                                value="1"
                                                {{ old('aktif', (string) $periode->aktif) === '1' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="aktif1">Aktif</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="aktif" id="aktif0"
                                                value="0"
                                                {{ old('aktif', (string) $periode->aktif) === '0' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="aktif0">Nonaktif</label>
                                        </div>
                                    </div>
                                </div>

                        </div>

                        <div class="card-footer text-right">
                            <a href="{{ route('periode.index') }}" class="btn btn-secondary">Kembali</a>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>

                    </form>

                </div>
            </div>
        </div>

    </div>
</section>
@endsection
