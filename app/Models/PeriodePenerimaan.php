<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasUuid;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class PeriodePenerimaan extends Model
{
    use HasUuid;

    protected $table = 'periode_penerimaan';

    protected $fillable = [
        'nama_periode',
        'tahun_akademik',
        'tanggal_mulai_pendaftaran',
        'tanggal_selesai_pendaftaran',
        'tanggal_mulai_ujian',
        'tanggal_selesai_ujian',
        'tanggal_pengumuman',
        'aktif',
    ];

    public function pendaftaran()
    {
        return $this->hasMany(Pendaftaran::class, 'periode_penerimaan_id');
    }

    public function jadwalUjian()
    {
        return $this->hasMany(JadwalUjian::class, 'periode_penerimaan_id');
    }

    public static function validate(array $data, $id = null)
    {
        $rules = [
            'nama_periode' => 'required|max:255|unique:periode_penerimaan,nama_periode,' . $id,
            'tahun_akademik' => 'required|max:20',
            'tanggal_mulai_pendaftaran' => 'required|date',
            'tanggal_selesai_pendaftaran' => 'required|date|after_or_equal:tanggal_mulai_pendaftaran',
            'tanggal_mulai_ujian' => 'required|date',
            'tanggal_selesai_ujian' => 'required|date|after_or_equal:tanggal_mulai_ujian',
            'tanggal_pengumuman' => 'required|date',
            'aktif' => 'required|boolean',
        ];

        $messages = [
            'nama_periode.required' => 'Nama periode wajib diisi.',
            'nama_periode.unique' => 'Nama periode sudah digunakan.',
            'tahun_akademik.required' => 'Tahun akademik wajib diisi.',
            'tanggal_mulai_pendaftaran.required' => 'Tanggal mulai pendaftaran wajib diisi.',
            'tanggal_selesai_pendaftaran.after_or_equal' => 'Tanggal selesai pendaftaran tidak valid.',
            'tanggal_selesai_ujian.after_or_equal' => 'Tanggal selesai ujian tidak valid.',
            'aktif.required' => 'Status aktif wajib diisi.',
        ];

        $validator = Validator::make($data, $rules, $messages);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
    }
}
