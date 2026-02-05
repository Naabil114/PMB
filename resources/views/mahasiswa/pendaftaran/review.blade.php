@extends('layouts.admin.app')

@section('content')
    <section class="section">

        <div class="section-header">
            <h1>Pendaftaran Mahasiswa</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Pendaftaran</a></div>
                <div class="breadcrumb-item">Review</div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Review Data Pendaftaran</h2>

            <div class="mb-4">
                <x-pendaftaran-progress :currentStep="5" />
            </div>

            <div class="row">
                <div class="col-12 col-lg-8">

                    <div class="card">

                        <div class="card-header">
                            <h4>Ringkasan Data</h4>
                        </div>

                        <div class="card-body">

                            <h6 class="text-primary mb-3">
                                <i class="fas fa-user"></i> Data Awal
                            </h6>
                            <ul class="list-group mb-4">

                                <li class="list-group-item">
                                    <strong>Jenjang:</strong> {{ $pendaftaran->jenjang }}
                                </li>
                            </ul>

                            <h6 class="text-primary mb-3">
                                <i class="fas fa-university"></i> Program Studi
                            </h6>
                            <ul class="list-group mb-4">
                                <li class="list-group-item">
                                    <strong>Program Studi:</strong>
                                    {{ $pendaftaran->programStudi->nama_program }}
                                </li>
                            </ul>

                            <h6 class="text-primary mb-3">
                                <i class="fas fa-graduation-cap"></i> Riwayat Pendidikan
                            </h6>
                            <ul class="list-group mb-4">
                                <li class="list-group-item">
                                    <strong>Pendidikan Terakhir:</strong>
                                    {{ $pendaftaran->pendidikan_terakhir }}
                                </li>
                                <li class="list-group-item">
                                    <strong>Institusi:</strong>
                                    {{ $pendaftaran->institusi_terakhir }}
                                </li>
                                <li class="list-group-item">
                                    <strong>Jurusan:</strong>
                                    {{ $pendaftaran->jurusan_terakhir }}
                                </li>
                                <li class="list-group-item">
                                    <strong>Tahun Lulus:</strong>
                                    {{ $pendaftaran->tahun_lulus }}
                                </li>
                                <li class="list-group-item">
                                    <strong>IPK:</strong>
                                    {{ $pendaftaran->ipk }}
                                </li>
                            </ul>

                            <h6 class="text-primary mb-3">
                                <i class="fas fa-calendar-alt"></i> Jadwal Ujian
                            </h6>
                            <ul class="list-group mb-4">
                                <li class="list-group-item">
                                    <strong>Tanggal:</strong>
                                    {{ $pendaftaran->jadwalUjian->tanggal_ujian }}
                                </li>
                                <li class="list-group-item d-flex align-items-center">
                                    <i class="fas fa-clock text-primary mr-2"></i>
                                    <div>
                                        <strong>Sesi:</strong>
                                        {{ $pendaftaran->jadwalUjian->sesi->nama_sesi }}
                                        <div class="text-muted small">
                                            {{ $pendaftaran->jadwalUjian->sesi->jam_mulai }}
                                            –
                                            {{ $pendaftaran->jadwalUjian->sesi->jam_selesai }}
                                        </div>
                                    </div>
                                </li>

                                <li class="list-group-item">
                                    <strong>Ruang:</strong>
                                    {{ $pendaftaran->jadwalUjian->ruang->nama_ruang }}
                                </li>
                            </ul>

                            <h6 class="text-primary mb-3">
                                <i class="fas fa-file"></i> Dokumen
                            </h6>
                            <ul class="list-group mb-4">
                                <li class="list-group-item">
                                    <strong>Dokumen PDF:</strong>
                                    <a href="{{ asset($pendaftaran->file_dokumen) }}" target="_blank"
                                        class="btn btn-sm btn-outline-primary ml-2">
                                        Lihat
                                    </a>
                                </li>
                                <li class="list-group-item">
                                    <strong>Foto:</strong>
                                    <a href="{{ asset($pendaftaran->foto) }}" target="_blank"
                                        class="btn btn-sm btn-outline-primary ml-2">
                                        Lihat
                                    </a>
                                </li>
                            </ul>

                            <div class="alert alert-warning">
                                <i class="fas fa-exclamation-triangle"></i>
                                Pastikan seluruh data sudah benar.
                                Setelah dikirim, data tidak dapat diubah.
                            </div>

                        </div>

                        <div class="card-footer text-right">
                            <form method="POST" id="submitForm"
                                action="{{ route('pendaftaran.submit', $pendaftaran->id) }}">
                                @csrf
                                <button type="submit" class="btn btn-success">
                                    <i class="fas fa-paper-plane"></i>
                                    Kirim Pendaftaran
                                </button>
                            </form>
                        </div>


                    </div>

                </div>
            </div>

        </div>
    </section>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('submitForm');

        if (!form) return;

        form.addEventListener('submit', function(e) {
            e.preventDefault();

            Swal.fire({
                title: 'Yakin mengirim pendaftaran?',
                text: 'Setelah dikirim, data tidak bisa diubah!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, kirim sekarang!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
</script>
