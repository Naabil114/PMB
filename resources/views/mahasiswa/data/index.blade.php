@extends('layouts.admin.app')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Data Pendaftar</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Pendaftar</a></div>
                <div class="breadcrumb-item">Data</div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Data Pendaftar</h2>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Pendaftar</h4>

                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped" id="table-2">
                                    <thead>
                                        <tr>
                                            <th class="text-center">No</th>
                                            <th>Nomor Pendaftaran</th>
                                            <th>Nama Lengkap</th>
                                            <th>Tempat Lahir</th>
                                            <th>Tanggal Lahir</th>
                                            <th>Jenis Kelamin</th>
                                            <th>Agama</th>
                                            <th>Alamat</th>
                                            <th>WhatsApp</th>
                                            <th>Email</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="text-center">1</td>
                                            <td>{{ $pendaftar->nomor_pendaftaran }}</td>
                                            <td>{{ $pendaftar->nama_lengkap }}</td>
                                            <td>{{ $pendaftar->tempat_lahir }}</td>
                                            <td>{{ date_format($pendaftar->tanggal_lahir, 'd-m-Y') ?? '-' }}</td>
                                            <td>{{ $pendaftar->jenis_kelamin }}</td>
                                            <td>{{ $pendaftar->agama }}</td>
                                            <td>{{ $pendaftar->alamat }}</td>
                                            <td>{{ $pendaftar->whatsapp }}</td>
                                            <td>{{ $pendaftar->email }}</td>
                                        </tr>
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
