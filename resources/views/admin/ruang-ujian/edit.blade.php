@extends('layouts.admin.app')
@section('content')
<section class="section">
    <div class="section-header">
        <h1>Edit Ruang Ujian</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Ruang Ujian</a></div>
            <div class="breadcrumb-item">Edit</div>
        </div>
    </div>

    <div class="section-body">
        <h2 class="section-title">Edit Ruang Ujian</h2>

        <div class="row">
            <div class="col-12 col-md-6 col-lg-6">
                <div class="card">

                    <form action="{{ route('ruang-ujian.update', $ruang->id) }}"
                        method="POST" class="needs-validation" novalidate>
                        @csrf
                        @method('PUT')

                        <div class="card-header">
                            <h4>Edit Ruang Ujian</h4>
                        </div>

                        <div class="card-body">

                            <div class="form-group">
                                <label>Kode Ruang</label>
                                <input type="text" name="kode_ruang"
                                    class="form-control @error('kode_ruang') is-invalid @enderror"
                                    value="{{ old('kode_ruang', $ruang->kode_ruang) }}" required>
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
                                    value="{{ old('nama_ruang', $ruang->nama_ruang) }}" required>
                                @error('nama_ruang')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Gedung</label>
                                <input type="text" name="gedung"
                                    class="form-control @error('gedung') is-invalid @enderror"
                                    value="{{ old('gedung', $ruang->gedung) }}" required>
                                @error('gedung')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Kapasitas</label>
                                <input type="number" name="kapasitas"
                                    class="form-control @error('kapasitas') is-invalid @enderror"
                                    value="{{ old('kapasitas', $ruang->kapasitas) }}" required>
                                @error('kapasitas')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                    <label>Status</label>
                                    <div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="aktif" id="aktif1"
                                                value="1"
                                                {{ old('aktif', (string) $ruang->aktif) === '1' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="aktif1">Aktif</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="aktif" id="aktif0"
                                                value="0"
                                                {{ old('aktif', (string) $ruang->aktif) === '0' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="aktif0">Nonaktif</label>
                                        </div>
                                    </div>
                                </div>

                        </div>

                        <div class="card-footer text-right">
                            <a href="{{ route('ruang-ujian.index') }}" class="btn btn-secondary">Kembali</a>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</section>
@endsection
