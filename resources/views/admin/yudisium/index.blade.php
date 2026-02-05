@extends('layouts.admin.app')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Yudisium & Kelulusan</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Yudisium</a></div>
            <div class="breadcrumb-item">Kelulusan</div>
        </div>
    </div>

    <div class="section-body">
        <h2 class="section-title">Peserta Ujian</h2>
        <p class="section-lead">
            Menampilkan peserta yang telah mengikuti ujian dan dikelompokkan berdasarkan kelulusan.
        </p>

        <div class="card">
            <div class="card-header">
                <h4>Daftar Peserta</h4>
            </div>

            <div class="card-body">

                <ul class="nav nav-tabs" id="yudisiumTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="lulus-tab" data-toggle="tab" href="#lulus" role="tab">
                            Lulus
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="tidak-lulus-tab" data-toggle="tab" href="#tidak-lulus" role="tab">
                            Tidak Lulus
                        </a>
                    </li>
                </ul>

                <div class="tab-content mt-3">

                    <div class="tab-pane fade show active" id="lulus" role="tabpanel">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>No Pendaftaran</th>
                                        <th>Nama</th>
                                        <th>Program Studi</th>
                                        <th>Nilai Total</th>
                                        <th>Grade</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($lulus as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->pendaftaran->pendaftar->nomor_pendaftaran }}</td>
                                            <td>{{ $item->pendaftaran->pendaftar->nama_lengkap }}</td>
                                            <td>{{ $item->pendaftaran->programStudi->nama_program }}</td>
                                            <td>{{ $item->nilai_total }}</td>
                                            <td>{{ $item->grade }}</td>
                                            <td>
                                                <span class="badge badge-success">Lulus</span>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center">
                                                Tidak ada peserta lulus
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="tidak-lulus" role="tabpanel">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>No Pendaftaran</th>
                                        <th>Nama</th>
                                        <th>Program Studi</th>
                                        <th>Nilai Total</th>
                                        <th>Grade</th>
                                        <th>Status</th>
                                        <th>Catatan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($tidakLulus as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->pendaftar->nomor_pendaftaran }}</td>
                                            <td>{{ $item->pendaftar->nama_lengkap }}</td>
                                            <td>{{ $item->pendaftaran->programStudi->nama_program }}</td>
                                            <td>{{ $item->nilai_total }}</td>
                                            <td>{{ $item->grade }}</td>
                                            <td>
                                                <span class="badge badge-danger">Tidak Lulus</span>
                                            </td>
                                            <td>{{ $item->catatan ?? '-' }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8" class="text-center">
                                                Tidak ada peserta tidak lulus
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
</section>
@endsection
