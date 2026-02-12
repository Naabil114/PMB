@extends('layouts.admin.app')

@section('content')
    <section class="section">

        <div class="section-header">
            <h1>Pendaftaran Mahasiswa</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Pendaftaran</a></div>
                <div class="breadcrumb-item">Step 3</div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Riwayat Pendidikan & Jadwal Ujian</h2>

            <div class="mb-4">
                <x-pendaftaran-progress :currentStep="3" />
            </div>

            <div class="row">
                <div class="col-12 col-lg-8">

                    <div class="card">

                        <form method="POST" action="{{ route('pendaftaran.step3.store', $pendaftaran->id) }}"
                            class="needs-validation" novalidate>
                            @csrf

                            <div class="card-header">
                                <h4>Form Riwayat Pendidikan</h4>
                            </div>

                            <div class="card-body">

                                <h6 class="mb-3 text-primary">
                                    <i class="fas fa-graduation-cap"></i> Riwayat Pendidikan Terakhir
                                </h6>

                                <div class="form-group">
                                    <label>Pendidikan Terakhir</label>
                                    <select name="pendidikan_terakhir"
                                        class="form-control @error('pendidikan_terakhir') is-invalid @enderror" required>
                                        <option value="">-- Pilih Pendidikan Terakhir --</option>
                                        <option value="SMA/SMK"
                                            {{ old('pendidikan_terakhir') == 'SMA/SMK' ? 'selected' : '' }}>
                                            SMA / SMK
                                        </option>
                                        <option value="D3" {{ old('pendidikan_terakhir') == 'D3' ? 'selected' : '' }}>
                                            D3
                                        </option>
                                        <option value="S1" {{ old('pendidikan_terakhir') == 'S1' ? 'selected' : '' }}>
                                            S1
                                        </option>
                                        <option value="S2" {{ old('pendidikan_terakhir') == 'S2' ? 'selected' : '' }}>
                                            S2
                                        </option>
                                    </select>

                                    @error('pendidikan_terakhir')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @else
                                        <div class="invalid-feedback">Wajib diisi.</div>
                                    @enderror
                                </div>


                                <div class="form-group">
                                    <label>Nama Sekolah / Kampus</label>
                                    <input type="text" name="institusi_terakhir"
                                        class="form-control @error('institusi_terakhir') is-invalid @enderror"
                                        placeholder="Nama Sekolah / Kampus" value="{{ old('institusi_terakhir') }}"
                                        required>
                                    @error('institusi_terakhir')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @else
                                        <div class="invalid-feedback">Wajib diisi.</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>Jurusan</label>
                                    <input type="text" name="jurusan_terakhir"
                                        class="form-control @error('jurusan_terakhir') is-invalid @enderror"
                                        placeholder="Jurusan" value="{{ old('jurusan_terakhir') }}" required>
                                    @error('jurusan_terakhir')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @else
                                        <div class="invalid-feedback">Wajib diisi.</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>Tahun Lulus</label>
                                    <select name="tahun_lulus"
                                        class="form-control @error('tahun_lulus') is-invalid @enderror" required>
                                        <option value="">-- Pilih Tahun Lulus --</option>
                                        @for ($year = date('Y'); $year >= 1990; $year--)
                                            <option value="{{ $year }}"
                                                {{ old('tahun_lulus') == $year ? 'selected' : '' }}>
                                                {{ $year }}
                                            </option>
                                        @endfor
                                    </select>

                                    @error('tahun_lulus')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @else
                                        <div class="invalid-feedback">Wajib diisi.</div>
                                    @enderror
                                </div>


                                <div class="form-group">
                                    <label>IPK</label>
                                    <input type="text" name="ipk"
                                        class="form-control @error('ipk') is-invalid @enderror" placeholder="Contoh: 3.75"
                                        value="{{ old('ipk') }}" required>
                                    @error('ipk')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @else
                                        <div class="invalid-feedback">Wajib diisi.</div>
                                    @enderror
                                </div>

                                <hr>

                                <h6 class="mb-3 text-primary">
                                    <i class="fas fa-calendar-alt"></i> Pilih Jadwal Ujian
                                </h6>

                                <div class="form-group">
                                    <label class="font-weight-bold mb-2">
                                        Pilih Jadwal Ujian
                                    </label>

                                    @foreach ($jadwal as $j)
                                        <div class="custom-control custom-radio mb-3">
                                            <input type="radio" id="jadwal{{ $j->id }}" name="jadwal_ujian_id"
                                                value="{{ $j->id }}"
                                                class="custom-control-input @error('jadwal_ujian_id') is-invalid @enderror"
                                                {{ old('jadwal_ujian_id') == $j->id ? 'checked' : '' }} required>

                                            <label class="custom-control-label" for="jadwal{{ $j->id }}">
                                                <div class="d-flex align-items-start">
                                                    <div class="mr-3 text-primary">
                                                        <i class="fas fa-calendar-alt fa-lg"></i>
                                                    </div>

                                                    <div>
                                                        <div class="font-weight-bold">
                                                            {{ \Carbon\Carbon::parse($j->tanggal_ujian)->translatedFormat('d F Y') }}
                                                        </div>

                                                        <div class="text-muted small mt-1">
                                                            <i class="fas fa-clock mr-1"></i>
                                                            {{ $j->sesi->nama_sesi }}
                                                            ({{ $j->sesi->jam_mulai }} – {{ $j->sesi->jam_selesai }})
                                                        </div>

                                                        <div class="text-muted small">
                                                            <i class="fas fa-door-open mr-1"></i>
                                                            Ruang {{ $j->ruang->nama_ruang }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </label>

                                        </div>
                                    @endforeach

                                    @error('jadwal_ujian_id')
                                        <div class="invalid-feedback d-block">
                                            {{ $message }}
                                        </div>
                                    @else
                                        <div class="invalid-feedback d-block">
                                            Silakan pilih salah satu jadwal ujian.
                                        </div>
                                    @enderror
                                </div>


                            </div>

                            <div class="card-footer d-flex justify-content-between">
                                <a href="{{ route('pendaftaran.step2', $pendaftaran->id) }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left"></i> Kembali
                                </a>

                                <button type="submit" class="btn btn-primary">
                                    Lanjut
                                </button>
                            </div>


                        </form>

                    </div>

                </div>
            </div>

        </div>
    </section>
@endsection
