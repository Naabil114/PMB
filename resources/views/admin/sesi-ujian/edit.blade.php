@extends('layouts.admin.app')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Edit Sesi Ujian</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Sesi Ujian</a></div>
                <div class="breadcrumb-item">Edit</div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Edit Sesi Ujian</h2>

            <div class="row">
                <div class="col-12 col-md-6 col-lg-6">
                    <div class="card">

                        <form action="{{ route('sesi-ujian.update', $sesi->id) }}" method="POST" class="needs-validation"
                            novalidate>
                            @csrf
                            @method('PUT')

                            <div class="card-header">
                                <h4>Edit Sesi Ujian</h4>
                            </div>

                            <div class="card-body">

                                <div class="form-group">
                                    <label>Nama Sesi</label>
                                    <input type="text" name="nama_sesi"
                                        class="form-control @error('nama_sesi') is-invalid @enderror"
                                        value="{{ old('nama_sesi', $sesi->nama_sesi) }}" required>
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
                                        value="{{ old('jam_mulai', $sesi->jam_mulai) }}" required>
                                    @error('jam_mulai')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>Jam Selesai</label>
                                    <input type="time" name="jam_selesai"
                                        class="form-control @error('jam_selesai') is-invalid @enderror"
                                        value="{{ old('jam_selesai', $sesi->jam_selesai) }}" required>
                                    @error('jam_selesai')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>Status</label>
                                    <div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="aktif" id="aktif1"
                                                value="1"
                                                {{ old('aktif', (string) $sesi->aktif) === '1' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="aktif1">Aktif</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="aktif" id="aktif0"
                                                value="0"
                                                {{ old('aktif', (string) $sesi->aktif) === '0' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="aktif0">Nonaktif</label>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="card-footer text-right">
                                <a href="{{ route('sesi-ujian.index') }}" class="btn btn-secondary">Kembali</a>
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
