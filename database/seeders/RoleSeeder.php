<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('role')->insert([
            'id' => Str::uuid(),
            'nama_role' => 'Admin',
            'deskripsi' => 'Administrator Sistem',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
