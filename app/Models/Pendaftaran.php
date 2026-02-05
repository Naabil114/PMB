<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\HasUuid;

class Pendaftaran extends Model
{
    use HasUuid, SoftDeletes;

    protected $table = 'pendaftaran';

    protected $fillable = [
        'pendaftar_id',
        'periode_penerimaan_id',
        'program_studi_id',
        'jadwal_ujian_id',
        'pendidikan_terakhir',
        'institusi_terakhir',
        'jurusan_terakhir',
        'tahun_lulus',
        'ipk',
        'status_dokumen',
        'diverifikasi_oleh',
        'diverifikasi_pada',
        'alasan_penolakan',
        'status_pendaftaran',
        'status_ujian',
        'status_hasil',
        'dikirim_pada',
        'file_dokumen',
        'foto',
        'jenjang',
    ];

    public function pendaftar()
    {
        return $this->belongsTo(Pendaftar::class, 'pendaftar_id');
    }

    public function periode()
    {
        return $this->belongsTo(PeriodePenerimaan::class, 'periode_penerimaan_id');
    }

    public function programStudi()
    {
        return $this->belongsTo(ProgramStudi::class, 'program_studi_id');
    }

    public function jadwalUjian()
    {
        return $this->belongsTo(JadwalUjian::class, 'jadwal_ujian_id');
    }

    public function nilaiUjian()
    {
        return $this->hasOne(NilaiUjian::class, 'pendaftaran_id');
    }

    public function logNotifikasi()
    {
        return $this->hasMany(LogNotifikasi::class, 'pendaftaran_id');
    }
}
