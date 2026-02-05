<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasUuid;

class Role extends Model
{
    use HasUuid;

    protected $table = 'role';

    protected $fillable = [
        'nama_role',
        'deskripsi',
    ];

    public function users()
    {
        return $this->hasMany(User::class, 'role_id');
    }
}
