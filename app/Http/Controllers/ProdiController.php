<?php

namespace App\Http\Controllers;

use App\Models\ProgramStudi;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ProdiController extends Controller
{

    public function index()
    {
        $programStudi = ProgramStudi::all();
        return view('admin.program-studi.index', compact('programStudi'));
    }
    public function create()
    {
        return view('admin.program-studi.create');
    }

    public function store(Request $request)
    {
        try {
            ProgramStudi::validate($request->all());

            ProgramStudi::create([
                'kode_program' => $request->kode_program,
                'nama_program' => $request->nama_program,
                'jenjang' => $request->jenjang,
                'fakultas' => $request->fakultas,
                'deskripsi' => $request->deskripsi,
                'aktif' => $request->aktif ?? 1,
            ]);

            return redirect()->route('prodi.index')
                ->with('success', 'Data berhasil ditambahkan');

        } catch (ValidationException $e) {

            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan sistem: ' . $e->getMessage())->withInput();
        }
    }

    public function edit($id)
    {
        $prodi = ProgramStudi::findOrFail($id);
        return view('admin.program-studi.edit', compact('prodi'));
    }

    public function update(Request $request, $id)
    {
        try {
            ProgramStudi::validate($request->all(), $id);

            $programStudi = ProgramStudi::findOrFail($id);
            $programStudi->update([
                'kode_program' => $request->kode_program,
                'nama_program' => $request->nama_program,
                'jenjang' => $request->jenjang,
                'fakultas' => $request->fakultas,
                'deskripsi' => $request->deskripsi,
                'aktif' => $request->aktif ?? 1,
            ]);

            return redirect()->route('prodi.index')
                ->with('success', 'Data berhasil diperbarui');

        } catch (ValidationException $e) {

            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan sistem: ' . $e->getMessage())->withInput();
        }
    }

    public function destroy($id)
    {
        $prodi = ProgramStudi::findOrFail($id);

        if ($prodi->pendaftaran()->count() > 0) {
            return redirect()->route('prodi.index')
                ->with('error', 'Data Prodi ini tidak bisa dihapus karena sudah ada mahasiswa terkait.');
        }

        try {
            $prodi->delete();

            return redirect()->route('prodi.index')
                ->with('success', 'Data Prodi berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('prodi.index')
                ->with('error', 'Terjadi kesalahan saat menghapus data: ' . $e->getMessage());
        }
    }



}
