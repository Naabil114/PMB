@extends('layouts.admin.app')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Edit Prodi</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Prodi</a></div>
                <div class="breadcrumb-item"><a href="#">Edit Prodi</a></div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Edit Prodi</h2>

            <div class="row">
                <div class="col-12 col-md-6 col-lg-6">
                    <div class="card">
                        <form action="{{ route('prodi.update', $prodi->id) }}" method="POST" class="needs-validation"
                            novalidate>
                            @csrf
                            @method('PUT')
                            <div class="card-header">
                                <h4>Edit Prodi</h4>
                            </div>

                            <div class="card-body">
                                <div class="form-group">
                                    <label>Kode Program</label>
                                    <input type="text" name="kode_program"
                                        class="form-control @error('kode_program') is-invalid @enderror"
                                        placeholder="Masukkan kode program"
                                        value="{{ old('kode_program', $prodi->kode_program) }}" required>
                                    @error('kode_program')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @else
                                        <div class="invalid-feedback">Kode Program wajib diisi.</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>Nama Program Studi</label>
                                    <input type="text" name="nama_program"
                                        class="form-control @error('nama_program') is-invalid @enderror"
                                        placeholder="Masukkan nama program studi"
                                        value="{{ old('nama_program', $prodi->nama_program) }}" required>
                                    @error('nama_program')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @else
                                        <div class="invalid-feedback">Nama Program Studi wajib diisi.</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>Jenjang</label>
                                    <div>
                                        @foreach (['S2', 'S3'] as $jenjang)
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input @error('jenjang') is-invalid @enderror"
                                                    type="radio" name="jenjang" id="jenjang{{ $jenjang }}"
                                                    value="{{ $jenjang }}"
                                                    {{ old('jenjang', $prodi->jenjang) == $jenjang ? 'checked' : '' }}>
                                                <label class="form-check-label"
                                                    for="jenjang{{ $jenjang }}">{{ $jenjang }}</label>
                                            </div>
                                        @endforeach
                                        @error('jenjang')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Fakultas</label>
                                    <input type="text" name="fakultas"
                                        class="form-control @error('fakultas') is-invalid @enderror"
                                        placeholder="Masukkan nama fakultas"
                                        value="{{ old('fakultas', $prodi->fakultas) }}" required>
                                    @error('fakultas')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @else
                                        <div class="invalid-feedback">Fakultas wajib diisi.</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>Deskripsi</label>
                                    <textarea name="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror"
                                        placeholder="Masukkan deskripsi program studi" style="min-height: 150px;" required>{{ old('deskripsi', $prodi->deskripsi) }}</textarea>
                                    @error('deskripsi')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @else
                                        <div class="invalid-feedback">Deskripsi wajib diisi.</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>Status</label>
                                    <div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="aktif" id="aktif1"
                                                value="1"
                                                {{ old('aktif', (string) $prodi->aktif) === '1' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="aktif1">Aktif</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="aktif" id="aktif0"
                                                value="0"
                                                {{ old('aktif', (string) $prodi->aktif) === '0' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="aktif0">Nonaktif</label>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="card-footer text-right">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection
