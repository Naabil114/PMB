<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasUuid;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Carbon\Carbon;

class JadwalUjian extends Model
{
    use HasUuid;

    protected $table = 'jadwal_ujian';

    protected $fillable = [
        'periode_penerimaan_id',
        'tanggal_ujian',
        'sesi_ujian_id',
        'ruang_ujian_id',
        'kuota',
        'jumlah_terdaftar',
        'aktif',
    ];

    protected $casts = [
        'tanggal_ujian' => 'date',
        'aktif' => 'boolean',
    ];


    public function periode()
    {
        return $this->belongsTo(PeriodePenerimaan::class, 'periode_penerimaan_id');
    }

    public function sesi()
    {
        return $this->belongsTo(SesiUjian::class, 'sesi_ujian_id');
    }

    public function ruang()
    {
        return $this->belongsTo(RuangUjian::class, 'ruang_ujian_id');
    }

    public function pendaftaran()
    {
        return $this->hasMany(Pendaftaran::class, 'jadwal_ujian_id');
    }


    public static function validate(array $data)
    {
        $rules = [
            'periode_penerimaan_id' => 'required|exists:periode_penerimaan,id',
            'tanggal_ujian'         => 'required|date',
            'sesi_ujian_id'         => 'required|exists:sesi_ujian,id',
            'ruang_ujian_id'        => 'required|exists:ruang_ujian,id',
            'kuota'                 => 'required|integer|min:1',
        ];

        $messages = [
            'periode_penerimaan_id.required' => 'Periode wajib dipilih.',
            'tanggal_ujian.required'         => 'Tanggal ujian wajib diisi.',
            'sesi_ujian_id.required'         => 'Sesi ujian wajib dipilih.',
            'ruang_ujian_id.required'        => 'Ruang ujian wajib dipilih.',
            'kuota.required'                 => 'Kuota wajib diisi.',
            'kuota.min'                      => 'Kuota minimal 1.',
        ];

        $validator = Validator::make($data, $rules, $messages);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
    }


    public function getTanggalFormattedAttribute()
    {
        return Carbon::parse($this->tanggal_ujian)
            ->translatedFormat('d F Y');
    }
}
