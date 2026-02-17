<?php
namespace App\Http\Controllers;
use App\Models\NilaiUjian;
use Illuminate\Http\Request;
use App\Imports\NilaiUjianImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\NilaiUjianTemplateExport;


class NilaiUjianController extends Controller
{
    public function index()
    {
        $nilai = NilaiUjian::with('pendaftaran.pendaftar')
        ->latest()
        ->get();
        return view('admin.nilai-ujian.index', compact('nilai'));
    }

    public function downloadTemplate()
    {
        return Excel::download(
            new NilaiUjianTemplateExport,
            'template_nilai_ujian.xlsx'
        );
    }

   public function import(Request $request)
{
    $request->validate([
        'file' => 'required|mimes:xlsx'
    ]);

    $import = new NilaiUjianImport();
    Excel::import($import, $request->file('file'));

    return back()->with('success',
        "Import selesai :
        {$import->insert} ditambahkan,
        {$import->update} diperbarui,
        {$import->skip} dilewati"
    );
}

}

