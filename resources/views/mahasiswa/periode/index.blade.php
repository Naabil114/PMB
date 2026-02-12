@extends('layouts.admin.app')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Periode Pendaftaran</h1>
    </div>

    <div class="section-body">

        <div class="card">
            <div class="card-header">
                <h4>Daftar Periode</h4>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-bordered table-striped">
                    <thead class="text-center">
                        <tr>
                            <th>Periode</th>
                            <th>Tahun Akademik</th>
                            <th>Tanggal Pendaftaran</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($periodes as $periode)
                            @php
                                $now = now();
                                $isOpen = $periode->aktif && $now->between($periode->tanggal_mulai_pendaftaran, $periode->tanggal_selesai_pendaftaran);
                                $hasRegistered = $periode->pendaftaran->isNotEmpty();
                            @endphp
                            <tr>
                                <td>{{ $periode->nama_periode }}</td>
                                <td>{{ $periode->tahun_akademik }}</td>
                                <td>
                                    {{ $periode->tanggal_mulai_pendaftaran }} <br>
                                    s/d {{ $periode->tanggal_selesai_pendaftaran }}
                                </td>
                                <td class="text-center">
                                    @if ($isOpen)
                                        <span class="badge badge-success">Dibuka</span>
                                    @else
                                        <span class="badge badge-secondary">Ditutup</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if ($hasRegistered)
                                        <a href="{{ route('pendaftaran.kartu', $periode->id) }}" class="btn btn-sm btn-success" target="_blank">
                                            Cetak Kartu
                                        </a>
                                    @elseif ($isOpen)
                                        <a href="{{ route('pendaftaran.step1', $periode->id) }}" class="btn btn-sm btn-primary">
                                            Daftar
                                        </a>
                                    @else
                                        <button class="btn btn-sm btn-secondary" disabled>
                                            Tidak tersedia
                                        </button>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted">Belum ada periode</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</section>
@endsection
