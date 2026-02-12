<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\PeriodePenerimaan;
use Carbon\Carbon;

class PeriodePendaftaranController extends Controller
{

    public function index()
{
    $periodes = PeriodePenerimaan::with([
        'pendaftaran' => function ($q) {
            $q->where('pendaftar_id', session('pendaftar_id'));
        }
    ])
    ->orderBy('tanggal_mulai_pendaftaran', 'desc')
    ->get();

    return view('mahasiswa.periode.index', compact('periodes'));
}


    
}
