<?php

namespace App\Http\Controllers;

use App\Models\Pendaftar;
use Illuminate\Http\Request;

class PendaftarController extends Controller
{
    public function index()
    {
        $pendaftar =  Pendaftar::all();
        return view('admin.pendaftar.index', compact('pendaftar'));
    }
}
