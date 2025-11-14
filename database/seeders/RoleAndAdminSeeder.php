<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Role;

class RoleAndAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::transaction(function () {
            // 1️⃣ Buat role Admin & User
            $adminRole = Role::firstOrCreate(['nama' => 'admin']);
            $userRole  = Role::firstOrCreate(['nama' => 'user']);

            // 2️⃣ Buat akun admin default
            $adminUser = User::firstOrCreate(
                ['email' => 'admin@example.com'],
                [
                    'name' => 'Administrator',
                    'password' => Hash::make('password123'),
                    'is_active' => true,
                    // ⚠️ PERBAIKAN PENTING: Set is_admin ke true
                    'is_admin' => true, 
                ]
            );

            // 3️⃣ Hubungkan admin ke role admin (untuk fleksibilitas role-based)
            $adminUser->roles()->syncWithoutDetaching([$adminRole->id]);

            $this->command->info('Akun Admin (admin@example.com) dan role telah berhasil dibuat.');
        });
    }
}