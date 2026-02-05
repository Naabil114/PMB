<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasUuid;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;


class SesiUjian extends Model
{
    use HasUuid;

    protected $table = 'sesi_ujian';

    protected $fillable = [
        'nama_sesi',
        'jam_mulai',
        'jam_selesai',
        'aktif',
    ];

    public function jadwalUjian()
    {
        return $this->hasMany(JadwalUjian::class, 'sesi_ujian_id');
    }

     public static function validate(array $data, $id = null)
    {
        $rules = [
            'nama_sesi'  => 'required|max:255|unique:sesi_ujian,nama_sesi,' . $id,
            'jam_mulai'  => 'required',
            'jam_selesai'=> 'required|after:jam_mulai',
            'aktif'      => 'required|boolean',
        ];

        $messages = [
            'nama_sesi.required' => 'Nama sesi wajib diisi.',
            'nama_sesi.unique'   => 'Nama sesi sudah digunakan.',
            'jam_mulai.required' => 'Jam mulai wajib diisi.',
            'jam_selesai.after'  => 'Jam selesai harus setelah jam mulai.',
            'aktif.required'     => 'Status wajib dipilih.',
        ];

        $validator = Validator::make($data, $rules, $messages);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
    }
}
