<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        // Pastikan role 'admin' sudah ada
        $adminRole = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);

        // Cek apakah admin sudah ada
        $admin = User::firstOrCreate(
            ['email' => 'admin@mori.id'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('password123'),
                'is_active' => true,
            ]
        );

        // Beri role admin jika belum
        if (!$admin->hasRole('admin')) {
            $admin->assignRole($adminRole);
        }

        $this->command->info('✅ Akun admin berhasil dibuat:');
        $this->command->info('Email: admin@mori.id');
        $this->command->info('Password: password123');
    }
}
