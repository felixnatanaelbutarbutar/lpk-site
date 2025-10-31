<?php

namespace Database\Seeders; // ✅ HARUS ADA namespace ini

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Role;

class RoleAndAdminSeeder extends Seeder
{
    public function run(): void
    {
        DB::transaction(function () {
            // 1️⃣ Buat role Admin & User (pakai lowercase biar konsisten)
            $adminRole = Role::firstOrCreate(['nama' => 'admin']);
            $userRole  = Role::firstOrCreate(['nama' => 'user']);

            // 2️⃣ Buat akun admin default
            $adminUser = User::firstOrCreate(
                ['email' => 'admin@example.com'],
                [
                    'name' => 'Administrator',
                    'password' => Hash::make('password123'),
                    'is_active' => true,
                ]
            );

            // 3️⃣ Hubungkan admin ke role admin
            $adminUser->roles()->syncWithoutDetaching([$adminRole->id]);
        });
    }
}
