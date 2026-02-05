<?php

namespace App\Http\Controllers;

use App\Models\ProgramStudi;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
{
    $rekap = ProgramStudi::withCount([
    'pendaftaran as total_submit' => function ($q) {
        $q->where('status_pendaftaran', 'submitted');
    },
    'pendaftaran as total_verified' => function ($q) {
        $q->where('status_pendaftaran', 'verified');
    },
    'pendaftaran as total_rejected' => function ($q) {
        $q->where('status_pendaftaran', 'rejected');
    },
])->get();


    return view('admin.dashboard', compact('rekap'));
}
}
