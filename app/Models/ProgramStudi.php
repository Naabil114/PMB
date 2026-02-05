<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasUuid;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class ProgramStudi extends Model
{
    use HasUuid;

    protected $table = 'program_studi';

    protected $fillable = [
        'kode_program',
        'nama_program',
        'jenjang',
        'fakultas',
        'deskripsi',
        'aktif',
    ];

    public function pendaftaran()
    {
        return $this->hasMany(Pendaftaran::class, 'program_studi_id');
    }

    public static function validate(array $data, $id = null)
{
    $rules = [
        'kode_program' => 'required|max:255|unique:program_studi,kode_program,' . $id,
        'nama_program' => 'required|max:255',
        'jenjang'      => 'required|in:S2,S3',
        'fakultas'     => 'required|max:255',
        'aktif'        => 'required|boolean'
    ];

    $messages = [
        'kode_program.required' => 'Kode program wajib diisi.',
        'kode_program.max'      => 'Kode program maksimal 255 karakter.',
        'kode_program.unique'   => 'Kode program sudah digunakan.',
        'nama_program.required' => 'Nama program studi wajib diisi.',
        'nama_program.max'      => 'Nama program maksimal 255 karakter.',
        'jenjang.required'      => 'Jenjang wajib dipilih.',
        'jenjang.in'            => 'Jenjang harus S2 atau S3.',
        'fakultas.required'     => 'Fakultas wajib diisi.',
        'fakultas.max'          => 'Fakultas maksimal 255 karakter.',
        'aktif.required'        => 'Status aktif wajib diisi.',
        'aktif.boolean'         => 'Status aktif harus berupa true atau false.'
    ];

    $validator = Validator::make($data, $rules, $messages);

    if ($validator->fails()) {
        throw new ValidationException($validator);
    }
}

}
