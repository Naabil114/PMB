<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class NilaiUjianTemplateExport implements FromArray, WithHeadings
{
    public function headings(): array
    {
        return [
            'nomor_pendaftaran',
            'nilai_tulis',
            'nilai_wawancara',
            'nilai_total',
            'lulus',
            'grade',
            'catatan'
        ];
    }

    public function array(): array
    {
        return [
            [
                'PMB-202602034578',
                80,
                85,
                165,
                1,
                'A',
                'Nilai sangat baik'
            ],
            [
                'PMB-202602034579',
                70,
                65,
                135,
                0,
                'B',
                'Perlu perbaikan'
            ]
        ];
    }
}
