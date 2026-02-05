<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\NilaiUjian;
use Illuminate\Http\Request;

class YudisiumController extends Controller
{
  
    public function index()
    {
        $lulus = NilaiUjian::with([
                'pendaftaran.pendaftar',
                'pendaftaran.programStudi'
            ])
            ->where('lulus', 1)
            ->whereHas('pendaftaran', function ($q) {
                $q->where('status_ujian', 'completed');
            })
            ->orderByDesc('nilai_total')
            ->get();

        $tidakLulus = NilaiUjian::with([
                'pendaftaran.pendaftar',
                'pendaftaran.programStudi'
            ])
            ->where('lulus', 0)
            ->whereHas('pendaftaran', function ($q) {
                $q->where('status_ujian', 'completed');
            })
            ->orderByDesc('nilai_total')
            ->get();

        return view('admin.yudisium.index', compact('lulus', 'tidakLulus'));
    }
}
