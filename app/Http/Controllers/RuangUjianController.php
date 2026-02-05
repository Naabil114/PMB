<?php

namespace App\Http\Controllers;

use App\Models\RuangUjian;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class RuangUjianController extends Controller
{
    public function index()
    {
        $ruangUjian = RuangUjian::all();
        return view('admin.ruang-ujian.index', compact('ruangUjian'));
    }

    public function create()
    {
        return view('admin.ruang-ujian.create');
    }

    public function store(Request $request)
    {
        try {
            RuangUjian::validate($request->all());

            RuangUjian::create([
                'kode_ruang' => $request->kode_ruang,
                'nama_ruang' => $request->nama_ruang,
                'gedung'     => $request->gedung,
                'kapasitas'  => $request->kapasitas,
                'aktif'      => $request->aktif ?? 1,
            ]);

            return redirect()->route('ruang-ujian.index')
                ->with('success', 'Ruang ujian berhasil ditambahkan');

        } catch (ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        }
    }

    public function edit($id)
    {
        $ruang = RuangUjian::findOrFail($id);
        return view('admin.ruang-ujian.edit', compact('ruang'));
    }

    public function update(Request $request, $id)
    {
        try {
            RuangUjian::validate($request->all(), $id);

            $ruang = RuangUjian::findOrFail($id);
            $ruang->update($request->all());

            return redirect()->route('ruang-ujian.index')
                ->with('success', 'Ruang ujian berhasil diperbarui');

        } catch (ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        }
    }

    public function destroy($id)
    {
        $ruang = RuangUjian::findOrFail($id);

        if ($ruang->jadwalUjian()->count() > 0) {
            return redirect()->route('ruang-ujian.index')
                ->with('error', 'Ruang ujian tidak bisa dihapus karena sudah digunakan di jadwal ujian.');
        }

        $ruang->delete();

        return redirect()->route('ruang-ujian.index')
            ->with('success', 'Ruang ujian berhasil dihapus');
    }
}
