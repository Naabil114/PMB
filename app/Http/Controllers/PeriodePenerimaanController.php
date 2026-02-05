<?php

namespace App\Http\Controllers;

use App\Models\PeriodePenerimaan;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class PeriodePenerimaanController extends Controller
{
    public function index()
    {
        $periode = PeriodePenerimaan::all();
        return view('admin.periode-penerimaan.index', compact('periode'));
    }

    public function create()
    {
        return view('admin.periode-penerimaan.create');
    }

    public function store(Request $request)
    {
        try {
            PeriodePenerimaan::validate($request->all());

            PeriodePenerimaan::create([
                'nama_periode' => $request->nama_periode,
                'tahun_akademik' => $request->tahun_akademik,
                'tanggal_mulai_pendaftaran' => $request->tanggal_mulai_pendaftaran,
                'tanggal_selesai_pendaftaran' => $request->tanggal_selesai_pendaftaran,
                'tanggal_mulai_ujian' => $request->tanggal_mulai_ujian,
                'tanggal_selesai_ujian' => $request->tanggal_selesai_ujian,
                'tanggal_pengumuman' => $request->tanggal_pengumuman,
                'aktif' => $request->aktif ?? 1,
            ]);

            return redirect()->route('periode.index')
                ->with('success', 'Periode penerimaan berhasil ditambahkan');

        } catch (ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan sistem: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $periode = PeriodePenerimaan::findOrFail($id);
        return view('admin.periode-penerimaan.edit', compact('periode'));
    }

    public function update(Request $request, $id)
    {
        try {
            PeriodePenerimaan::validate($request->all(), $id);

            $periode = PeriodePenerimaan::findOrFail($id);
            $periode->update($request->all());

            return redirect()->route('periode.index')
                ->with('success', 'Periode penerimaan berhasil diperbarui');

        } catch (ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        }
    }

    public function destroy($id)
    {
        $periode = PeriodePenerimaan::findOrFail($id);

        if ($periode->pendaftaran()->count() > 0) {
            return redirect()->route('periode.index')
                ->with('error', 'Periode tidak bisa dihapus karena sudah ada pendaftaran.');
        }

        $periode->delete();

        return redirect()->route('periode.index')
            ->with('success', 'Periode penerimaan berhasil dihapus');
    }
}
