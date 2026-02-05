@extends('layouts.admin.app')

@section('content')
    <div class="container">
        <h4>Periode Pendaftaran</h4>

        <table class="table table-bordered">
            <thead>
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
                        $isOpen =
                            $periode->aktif &&
                            $now->between($periode->tanggal_mulai_pendaftaran, $periode->tanggal_selesai_pendaftaran);
                    @endphp

                    <tr>
                        <td>{{ $periode->nama_periode }}</td>
                        <td>{{ $periode->tahun_akademik }}</td>
                        <td>
                            {{ $periode->tanggal_mulai_pendaftaran }} <br>
                            s/d {{ $periode->tanggal_selesai_pendaftaran }}
                        </td>
                        <td>
                            @if ($isOpen)
                                <span class="badge badge-success">Dibuka</span>
                            @else
                                <span class="badge badge-secondary">Ditutup</span>
                            @endif
                        </td>
                        <td>
                            @php
                                $hasRegistered = $periode->pendaftaran->isNotEmpty();
                            @endphp

                            @if ($hasRegistered)
                                <a href="{{ route('pendaftaran.kartu', $periode->id) }}" class="btn btn-sm btn-success"
                                    target="_blank">
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
                        <td colspan="5" class="text-center">Belum ada periode</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
