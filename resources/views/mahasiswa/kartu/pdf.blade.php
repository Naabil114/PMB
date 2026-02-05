<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Kartu Pendaftaran</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .box {
            border: 1px solid #000;
            padding: 10px;
            margin-bottom: 15px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        td {
            padding: 6px;
            vertical-align: top;
        }
        .title {
            font-weight: bold;
            margin-bottom: 5px;
        }
    </style>
</head>
<body>

<div class="header">
    <h3>KARTU PENDAFTARAN MAHASISWA BARU</h3>
    <p>{{ $pendaftaran->periode->nama_periode }} - {{ $pendaftaran->periode->tahun_akademik }}</p>
</div>

<div class="box">
    <div class="title">Data Pendaftar</div>
    <table>
        <tr>
            <td width="30%">Nomor Pendaftaran</td>
            <td>: {{ $pendaftaran->pendaftar->nomor_pendaftaran }}</td>
        </tr>
        <tr>
            <td>Nama Lengkap</td>
            <td>: {{ $pendaftaran->pendaftar->nama_lengkap }}</td>
        </tr>
        <tr>
            <td>Email</td>
            <td>: {{ $pendaftaran->pendaftar->email }}</td>
        </tr>
        <tr>
            <td>Telepon</td>
            <td>: {{ $pendaftaran->pendaftar->telepon }}</td>
        </tr>
        <tr>
            <td>Program Studi</td>
            <td>: {{ $pendaftaran->programStudi->nama_program }}</td>
        </tr>
    </table>
</div>

<div class="box">
    <div class="title">Jadwal Ujian</div>
    <table>
        <tr>
            <td width="30%">Tanggal Ujian</td>
            <td>: {{ $pendaftaran->jadwalUjian->tanggal_ujian }}</td>
        </tr>
        <tr>
            <td>Sesi</td>
            <td>:
                {{ $pendaftaran->jadwalUjian->sesi->nama_sesi }}
                ({{ $pendaftaran->jadwalUjian->sesi->jam_mulai }} -
                {{ $pendaftaran->jadwalUjian->sesi->jam_selesai }})
            </td>
        </tr>
        <tr>
            <td>Ruang</td>
            <td>: {{ $pendaftaran->jadwalUjian->ruang->nama_ruang }}</td>
        </tr>
        <tr>
            <td>Gedung</td>
            <td>: {{ $pendaftaran->jadwalUjian->ruang->gedung }}</td>
        </tr>
    </table>
</div>

<div style="margin-top: 40px; text-align: right;">
    <p>{{ now()->format('d F Y') }}</p>
    <p><b>Panitia PMB</b></p>
</div>

</body>
</html>
