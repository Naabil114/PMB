<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // ambil role Admin
        $roleAdmin = DB::table('role')
            ->where('nama_role', 'Admin')
            ->first();

        DB::table('users')->insert([
            'id' => Str::uuid(),
            'role_id' => $roleAdmin->id,
            'nama_lengkap' => 'Administrator',
            'username' => 'admin',
            'telepon' => '081234567890',
            'email' => 'admin@mail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('admin123'),
            'aktif' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
