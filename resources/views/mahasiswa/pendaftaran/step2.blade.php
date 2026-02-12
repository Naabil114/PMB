@extends('layouts.admin.app')

@section('content')
    <section class="section">

        <div class="section-header">
            <h1>Pendaftaran Mahasiswa</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Pendaftaran</a></div>
                <div class="breadcrumb-item">Step 2</div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Pilihan Program Studi</h2>

            <div class="mb-4">
                <x-pendaftaran-progress :currentStep="2" />
            </div>

            <div class="row">
                <div class="col-12 col-md-6 col-lg-6">

                    <div class="card">

                        <form method="POST" action="{{ route('pendaftaran.step2.store', $pendaftaran->id) }}"
                            class="needs-validation" novalidate>
                            @csrf

                            <div class="card-header">
                                <h4>Form Pilih Program Studi</h4>
                            </div>

                            <div class="card-body">

                                <div class="form-group">
                                    <label>Program Studi</label>
                                    <select name="program_studi_id"
                                        class="form-control @error('program_studi_id') is-invalid @enderror" required>
                                        <option value="">Pilih Program Studi</option>
                                        @foreach ($prodi as $p)
                                            <option value="{{ $p->id }}"
                                                {{ old('program_studi_id') == $p->id ? 'selected' : '' }}>
                                                {{ $p->nama_program }} - {{ $p->jenjang }}
                                            </option>
                                        @endforeach
                                    </select>

                                    @error('program_studi_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @else
                                        <div class="invalid-feedback">
                                            Program studi wajib dipilih.
                                        </div>
                                    @enderror
                                </div>

                            </div>

                            <div class="card-footer d-flex justify-content-between">
                                <a href="{{ route('pendaftaran.step1', $pendaftaran->periode_penerimaan_id) }}"
                                    class="btn btn-secondary">
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
