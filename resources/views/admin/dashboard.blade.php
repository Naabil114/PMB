@extends('layouts.admin.app')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Dashboard PMB</h1>
    </div>

    <div class="section-body">

        <div class="card">
            <div class="card-header">
                <h4>Rekap Pendaftar per Program Studi</h4>
            </div>

            <div class="card-body table-responsive">
                <table class="table table-striped table-bordered">
                    <thead class="text-center">
                        <tr>
                            <th rowspan="2">No</th>
                            <th rowspan="2">Program Studi</th>
                            <th rowspan="2">Jenjang</th>
                            <th rowspan="2">Fakultas</th>
                            <th colspan="3">Status Pendaftaran</th>
                            <th rowspan="2">Total</th>
                        </tr>
                        <tr>
                            <th>Submitted</th>
                            <th>Verified</th>
                            <th>Rejected</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($rekap as $prodi)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>{{ $prodi->nama_program }}</td>
                            <td class="text-center">
                                <span class="badge badge-info">
                                    {{ $prodi->jenjang }}
                                </span>
                            </td>
                            <td>{{ $prodi->fakultas }}</td>

                            <td class="text-center">
                                <span class="badge badge-primary">
                                    {{ $prodi->total_submit }}
                                </span>
                            </td>

                            <td class="text-center">
                                <span class="badge badge-success">
                                    {{ $prodi->total_verified }}
                                </span>
                            </td>

                            <td class="text-center">
                                <span class="badge badge-danger">
                                    {{ $prodi->total_rejected }}
                                </span>
                            </td>

                            <td class="text-center font-weight-bold">
                                {{ 
                                    $prodi->total_submit 
                                    + $prodi->total_verified 
                                    + $prodi->total_rejected 
                                }}
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center">
                                Belum ada data pendaftar
                            </td>
                        </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>
        </div>

    </div>
</section>
@endsection
