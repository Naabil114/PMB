<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Tymon\JWTAuth\Contracts\JWTSubject;
use App\Traits\HasUuid;

class Pendaftar extends Authenticatable implements JWTSubject
{
    use HasUuid, SoftDeletes;

    protected $table = 'pendaftar';
    protected $primaryKey = 'id';
    public $timestamps = true; 

    protected $fillable = [
        'nomor_pendaftaran',
        'kode_akses',
        'nama_lengkap',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'agama',
        'alamat',
        // 'telepon',
        'whatsapp',
        'email',
    ];

    protected $hidden = [
        'kode_akses',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function getAuthIdentifierName()
    {
        return 'nomor_pendaftaran';
    }

    public function getAuthPassword()
    {
        return $this->kode_akses;
    }

    public function pendaftaran()
    {
        return $this->hasMany(Pendaftaran::class, 'pendaftar_id');
    }
}
