@extends('layouts.admin.app')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Cek Status Kelulusan</h1>
    </div>

    <div class="section-body">

        <div class="card">
            <div class="card-body">
                

                <form action="{{ route('cek.kelulusan.cek') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label>Nomor Pendaftaran</label>
                        <input type="text" name="nomor_pendaftaran" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" class="form-control" required>
                    </div>

                    <button class="btn btn-primary mt-3">Cek Kelulusan</button>
                </form>
            </div>
        </div>

    </div>
</section>
@endsection
