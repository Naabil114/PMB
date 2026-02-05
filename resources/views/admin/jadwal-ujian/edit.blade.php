@extends('layouts.admin.app')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Edit Jadwal Ujian</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Jadwal Ujian</a></div>
            <div class="breadcrumb-item"><a href="#">Edit Jadwal Ujian</a></div>
        </div>
    </div>

    <div class="section-body">
        <h2 class="section-title">Edit Jadwal Ujian</h2>

        <div class="row">
            <div class="col-12 col-md-6 col-lg-6">

                <div class="card">
                    <form action="{{ route('jadwal-ujian.update', $jadwal->id) }}"
                          method="POST"
                          class="needs-validation"
                          novalidate>
                        @csrf
                        @method('PUT')

                        <div class="card-header">
                            <h4>Form Edit Jadwal Ujian</h4>
                        </div>

                        <div class="card-body">

                            <div class="form-group">
                                <label>Periode Penerimaan</label>
                                <select name="periode_penerimaan_id"
                                        class="form-control @error('periode_penerimaan_id') is-invalid @enderror"
                                        required>
                                    <option value="">Pilih</option>
                                    @foreach ($periode as $p)
                                        <option value="{{ $p->id }}"
                                            {{ $jadwal->periode_penerimaan_id == $p->id ? 'selected' : '' }}>
                                            {{ $p->nama_periode }} ({{ $p->tahun_akademik }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('periode_penerimaan_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @else
                                    <div class="invalid-feedback">Periode wajib dipilih.</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Tanggal Ujian</label>
                                <input type="date"
                                       name="tanggal_ujian"
                                       class="form-control @error('tanggal_ujian') is-invalid @enderror"
                                       value="{{ old('tanggal_ujian', $jadwal->tanggal_ujian->format('Y-m-d')) }}"
                                       required>
                                @error('tanggal_ujian')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @else
                                    <div class="invalid-feedback">Tanggal ujian wajib diisi.</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Sesi Ujian</label>
                                <select name="sesi_ujian_id"
                                        class="form-control @error('sesi_ujian_id') is-invalid @enderror"
                                        required>
                                    <option value="">-- Pilih Sesi --</option>
                                    @foreach ($sesi as $s)
                                        <option value="{{ $s->id }}"
                                            {{ $jadwal->sesi_ujian_id == $s->id ? 'selected' : '' }}>
                                            {{ $s->nama_sesi }} ({{ $s->jam_mulai }} - {{ $s->jam_selesai }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('sesi_ujian_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @else
                                    <div class="invalid-feedback">Sesi ujian wajib dipilih.</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Ruang Ujian</label>
                                <select name="ruang_ujian_id"
                                        class="form-control @error('ruang_ujian_id') is-invalid @enderror"
                                        required>
                                    <option value="">-- Pilih Ruang --</option>
                                    @foreach ($ruang as $r)
                                        <option value="{{ $r->id }}"
                                            {{ $jadwal->ruang_ujian_id == $r->id ? 'selected' : '' }}>
                                            {{ $r->nama_ruang }} ({{ $r->gedung }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('ruang_ujian_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @else
                                    <div class="invalid-feedback">Ruang ujian wajib dipilih.</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Kuota</label>
                                <input type="number"
                                       name="kuota"
                                       class="form-control @error('kuota') is-invalid @enderror"
                                       value="{{ old('kuota', $jadwal->kuota) }}"
                                       required>
                                @error('kuota')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @else
                                    <div class="invalid-feedback">Kuota wajib diisi.</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Status</label><br>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input"
                                           type="radio"
                                           name="aktif"
                                           value="1"
                                           {{ $jadwal->aktif ? 'checked' : '' }}>
                                    <label class="form-check-label">Aktif</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input"
                                           type="radio"
                                           name="aktif"
                                           value="0"
                                           {{ !$jadwal->aktif ? 'checked' : '' }}>
                                    <label class="form-check-label">Nonaktif</label>
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
