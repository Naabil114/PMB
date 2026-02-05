<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasUuid;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class RuangUjian extends Model
{
    use HasUuid;

    protected $table = 'ruang_ujian';

    protected $fillable = [
        'kode_ruang',
        'nama_ruang',
        'gedung',
        'kapasitas',
        'aktif',
    ];

    public function jadwalUjian()
    {
        return $this->hasMany(JadwalUjian::class, 'ruang_ujian_id');
    }

    public static function validate(array $data, $id = null)
    {
        $rules = [
            'kode_ruang' => 'required|max:50|unique:ruang_ujian,kode_ruang,' . $id,
            'nama_ruang' => 'required|max:255',
            'gedung'     => 'required|max:255',
            'kapasitas'  => 'required|integer|min:1',
            'aktif'      => 'required|boolean',
        ];

        $messages = [
            'kode_ruang.required' => 'Kode ruang wajib diisi.',
            'kode_ruang.unique'   => 'Kode ruang sudah digunakan.',
            'nama_ruang.required' => 'Nama ruang wajib diisi.',
            'gedung.required'     => 'Gedung wajib diisi.',
            'kapasitas.required'  => 'Kapasitas wajib diisi.',
            'kapasitas.integer'   => 'Kapasitas harus berupa angka.',
            'kapasitas.min'       => 'Kapasitas minimal 1.',
            'aktif.required'      => 'Status wajib dipilih.',
        ];

        $validator = Validator::make($data, $rules, $messages);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
    }
}
