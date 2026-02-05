<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\HasUuid;

class NilaiUjian extends Model
{
    use HasUuid, SoftDeletes;

    protected $table = 'nilai_ujian';

    protected $fillable = [
        'pendaftaran_id',
        'nilai_tulis',
        'nilai_wawancara',
        'nilai_total',
        'lulus',
        'grade',
        'catatan',
        'dinilai_oleh',
        'dinilai_pada',
    ];

    public function pendaftaran()
    {
        return $this->belongsTo(Pendaftaran::class, 'pendaftaran_id');
    }

    public function penilai()
    {
        return $this->belongsTo(User::class, 'dinilai_oleh');
    }
}
