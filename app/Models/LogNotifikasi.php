<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasUuid;

class LogNotifikasi extends Model
{
    use HasUuid;

    protected $table = 'log_notifikasi';

    protected $fillable = [
        'pendaftaran_id',
        'nomor_penerima',
        'jenis_notifikasi',
        'template_pesan',
        'dikirim_pada',
        'status',
        'pesan_error',
    ];

    public function pendaftaran()
    {
        return $this->belongsTo(Pendaftaran::class, 'pendaftaran_id');
    }
}
