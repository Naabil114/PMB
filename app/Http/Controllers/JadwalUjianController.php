<?php

namespace App\Http\Controllers;

use App\Models\JadwalUjian;
use App\Models\PeriodePenerimaan;
use App\Models\SesiUjian;
use App\Models\RuangUjian;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class JadwalUjianController extends Controller
{
    public function index()
    {
        $jadwalUjian = JadwalUjian::with(['periode', 'sesi', 'ruang'])->get();
        return view('admin.jadwal-ujian.index', compact('jadwalUjian'));
    }

    public function create()
    {
        $periode = PeriodePenerimaan::where('aktif', 1)->get();
        $sesi = SesiUjian::where('aktif', 1)->get();
        $ruang = RuangUjian::where('aktif', 1)->get();

        return view('admin.jadwal-ujian.create', compact('periode', 'sesi', 'ruang'));
    }



    public function store(Request $request)
{
    try {
        JadwalUjian::validate($request->all());

        JadwalUjian::create([
            ...$request->except('aktif'),
            'aktif' => 1,
            'jumlah_terdaftar' => 0,
        ]);

        return redirect()
            ->route('jadwal-ujian.index')
            ->with('success', 'Jadwal ujian berhasil ditambahkan');

    } catch (ValidationException $e) {
        return back()
            ->withErrors($e->errors())
            ->withInput();
    }
}


    public function edit($id)
    {
        return view('admin.jadwal-ujian.edit', [
            'jadwal' => JadwalUjian::findOrFail($id),
            'periode' => PeriodePenerimaan::all(),
            'sesi' => SesiUjian::all(),
            'ruang' => RuangUjian::all(),
        ]);
    }

    public function update(Request $request, $id)
    {
        try {
            JadwalUjian::validate($request->all());

            $jadwal = JadwalUjian::findOrFail($id);
            $jadwal->update($request->all());

            return redirect()->route('jadwal-ujian.index')
                ->with('success', 'Jadwal ujian berhasil diperbarui');

        } catch (ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        }
    }

    public function destroy($id)
    {
        $jadwal = JadwalUjian::findOrFail($id);

        if ($jadwal->pendaftaran()->count() > 0) {
            return redirect()->route('jadwal-ujian.index')
                ->with('error', 'Jadwal tidak bisa dihapus karena sudah ada pendaftar.');
        }

        $jadwal->delete();

        return redirect()->route('jadwal-ujian.index')
            ->with('success', 'Jadwal ujian berhasil dihapus');
    }
}
