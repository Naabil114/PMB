@extends('layouts.admin.app')

@section('content')
<section class="section">

    <div class="section-header">
        <h1>Pendaftaran Mahasiswa</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Pendaftaran</a></div>
            <div class="breadcrumb-item">Step 1</div>
        </div>
    </div>

    <div class="section-body">
        <h2 class="section-title">Data Awal Pendaftaran</h2>

        <div class="mb-4">
            <x-pendaftaran-progress :currentStep="1" />
        </div>

        <div class="row">
            <div class="col-12 col-md-6 col-lg-6">

                <div class="card">

                    <form method="POST"
                          action="{{ route('pendaftaran.step1.store') }}"
                          class="needs-validation"
                          novalidate>
                        @csrf

                        <div class="card-header">
                            <h4>Form Data Awal</h4>
                        </div>

                        <div class="card-body">

                            <input type="hidden"
                                   name="periode_penerimaan_id"
                                   value="{{ $periode->id }}">

                            

                            <div class="form-group">
                                <label>Jenjang Pendidikan</label>
                                <select name="jenjang"
                                        class="form-control @error('jenjang') is-invalid @enderror"
                                        required>
                                    <option value="">Pilih Jenjang</option>
                                    <option value="S1" {{ old('jenjang') == 'S1' ? 'selected' : '' }}>S1</option>
                                    <option value="S2" {{ old('jenjang') == 'S2' ? 'selected' : '' }}>S2</option>
                                </select>
                                @error('jenjang')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @else
                                    <div class="invalid-feedback">
                                        Jenjang wajib dipilih.
                                    </div>
                                @enderror
                            </div>

                        </div>

                        <div class="card-footer text-right">
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
