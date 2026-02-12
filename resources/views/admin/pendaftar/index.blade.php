@extends('layouts.admin.app')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Daftar Pendaftar</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Pendaftar</a></div>
                <div class="breadcrumb-item">Daftar</div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Daftar Pendaftar</h2>

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
                                            <th>Jenis Kelamin</th>
                                            <th>Agama</th>
                                            <th>Alamat</th>
                                            <th>WhatsApp</th>
                                            <th>Email</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($pendaftar as $prodi)
                                            <tr>
                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                <td>{{ $prodi->nomor_pendaftaran }}</td>
                                                <td>{{ $prodi->nama_lengkap }}</td>
                                                <td>{{ $prodi->tempat_lahir }}</td>
                                                <td>{{ $prodi->jenis_kelamin }}</td>
                                                <td>{{ $prodi->agama }}</td>
                                                <td>{{ $prodi->alamat }}</td>
                                                <td>{{ $prodi->whatsapp }}</td>
                                                <td>{{ $prodi->email }}</td>
                                                
                                                

                                            </tr>
                                        @endforeach
                                        @if ($pendaftar->isEmpty())
                                            <tr>
                                                <td colspan="8" class="text-center">Belum ada data pendaftar</td>
                                            </tr>
                                        @endif
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


