@extends('layouts.admin.app')

@section('content')
    <section class="section">

        <div class="section-header">
            <h1>Pendaftaran Mahasiswa</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Pendaftaran</a></div>
                <div class="breadcrumb-item">Step 4</div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Upload Dokumen</h2>

            <div class="mb-4">
                <x-pendaftaran-progress :currentStep="4" />
            </div>

            <div class="row">
                <div class="col-12 col-md-6 col-lg-6">

                    <div class="card">

                        <form method="POST" action="{{ route('pendaftaran.step4.store', $pendaftaran->id) }}"
                            enctype="multipart/form-data" class="needs-validation" novalidate>
                            @csrf

                            <div class="card-header">
                                <h4>Form Upload Berkas</h4>
                            </div>

                            <div class="card-body">

                                <div class="form-group">
                                    <label>Dokumen (PDF)</label>
                                    <input type="file" name="file_dokumen"
                                        class="form-control-file @error('file_dokumen') is-invalid @enderror"
                                        accept="application/pdf" required>
                                    <small class="form-text text-muted">
                                        Format PDF, maksimal ukuran sesuai ketentuan.
                                    </small>
                                    @error('file_dokumen')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @else
                                        <div class="invalid-feedback d-block">
                                            Dokumen wajib diunggah (PDF).
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>Foto (JPG / JPEG)</label>
                                    <input type="file" name="foto"
                                        class="form-control-file @error('foto') is-invalid @enderror"
                                        accept="image/jpeg,image/jpg" required>
                                    <small class="form-text text-muted">
                                        Format JPG / JPEG, latar belakang bebas.
                                    </small>
                                    @error('foto')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @else
                                        <div class="invalid-feedback d-block">
                                            Foto wajib diunggah (JPG / JPEG).
                                        </div>
                                    @enderror
                                </div>

                            </div>

                            <div class="card-footer d-flex justify-content-between">
                                <a href="{{ route('pendaftaran.step3', $pendaftaran->id) }}" class="btn btn-secondary">
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
