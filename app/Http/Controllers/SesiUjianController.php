<?php

namespace App\Http\Controllers;

use App\Models\SesiUjian;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class SesiUjianController extends Controller
{
    public function index()
    {
        $sesiUjian = SesiUjian::all();
        return view('admin.sesi-ujian.index', compact('sesiUjian'));
    }

    public function create()
    {
        return view('admin.sesi-ujian.create');
    }

    public function store(Request $request)
    {
        try {
            SesiUjian::validate($request->all());

            SesiUjian::create([
                'nama_sesi' => $request->nama_sesi,
                'jam_mulai' => $request->jam_mulai,
                'jam_selesai' => $request->jam_selesai,
                'aktif' => $request->aktif ?? 1,
            ]);

            return redirect()->route('sesi-ujian.index')
                ->with('success', 'Sesi ujian berhasil ditambahkan');

        } catch (ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        }
    }

    public function edit($id)
    {
        $sesi = SesiUjian::findOrFail($id);
        return view('admin.sesi-ujian.edit', compact('sesi'));
    }

    public function update(Request $request, $id)
    {
        try {
            SesiUjian::validate($request->all(), $id);

            $sesi = SesiUjian::findOrFail($id);
            $sesi->update($request->all());

            return redirect()->route('sesi-ujian.index')
                ->with('success', 'Sesi ujian berhasil diperbarui');

        } catch (ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        }
    }

    public function destroy($id)
    {
        $sesi = SesiUjian::findOrFail($id);
        $sesi->delete();

        return redirect()->route('sesi-ujian.index')
            ->with('success', 'Sesi ujian berhasil dihapus');
    }
}
