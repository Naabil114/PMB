@extends('layouts.admin.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Manajemen Nilai Ujian</h1>
        </div>
        <div class="alert alert-info">
            <h6 class="mb-2"><strong>Petunjuk Pengisian File Nilai Ujian</strong></h6>
            <ul class="mb-0">
                <li>Gunakan template resmi yang disediakan sistem.</li>
                <li>Jangan mengubah nama kolom pada baris pertama.</li>
                <li><strong>Nomor pendaftaran</strong> diisi dengan format: <code>PMB-XXXXXXXXXXXX</code>.</li>
                <li>Nilai tulis dan wawancara diisi angka <strong>0 – 100</strong>.</li>
                <li>Kolom <strong>lulus</strong> diisi <strong>1</strong> (lulus) atau <strong>0</strong> (tidak lulus).
                </li>
                <li>File harus disimpan dalam format <strong>.xlsx</strong>.</li>
            </ul>
        </div>


        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <h4>Import Nilai Ujian</h4>
                </div>
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('warning'))
                    <div class="alert alert-warning">
                        {{ session('warning') }}
                    </div>
                @endif


                <div class="card-body">
                    <div class="mb-3">
                        <a href="{{ route('nilai.template') }}" class="btn btn-success">
                            <i class="fas fa-download"></i> Unduh Template Nilai (XLSX)
                        </a>
                    </div>

                    <form action="{{ route('nilai.import') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label>Upload File Nilai (.xlsx)</label>
                            <input type="file" name="file" class="form-control" required>
                        </div>

                        <button class="btn btn-primary">
                            <i class="fas fa-upload"></i> Upload & Simpan Nilai
                        </button>
                    </form>

                    <hr>

                    <h5 class="mt-4">Data Nilai Ujian</h5>

                    <div class="table-responsive mt-3">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nomor Pendaftaran</th>
                                    <th>Nama Pendaftar</th>
                                    <th>Nilai Tulis</th>
                                    <th>Nilai Wawancara</th>
                                    <th>Nilai Total</th>
                                    <th>Status</th>
                                    <th>Grade</th>
                                    <th>Catatan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($nilai as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            {{ $item->pendaftaran->pendaftar->nomor_pendaftaran ?? '-' }}
                                        </td>
                                        <td>
                                            {{ $item->pendaftaran->pendaftar->nama_lengkap ?? '-' }}
                                        </td>
                                        <td>{{ $item->nilai_tulis }}</td>
                                        <td>{{ $item->nilai_wawancara }}</td>
                                        <td><strong>{{ $item->nilai_total }}</strong></td>
                                        <td>
                                            @if ($item->lulus)
                                                <span class="badge badge-success">Lulus</span>
                                            @else
                                                <span class="badge badge-danger">Tidak Lulus</span>
                                            @endif
                                        </td>
                                        <td>{{ $item->grade }}</td>
                                        <td>{{ $item->catatan }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="text-center">
                                            Belum ada data nilai ujian
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection
