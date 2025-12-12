<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Super Admin
        $admin = User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@example.com',
            'password' => Hash::make('password'),
        ]);
        $admin->assignRole('Super Admin');

        // 2. Manager
        $manager = User::create([
            'name' => 'Manager One',
            'email' => 'manager@example.com',
            'password' => Hash::make('password'),
        ]);
        $manager->assignRole('Manager');

        // 3. Staff
        $staff = User::create([
            'name' => 'Staff One',
            'email' => 'staff@example.com',
            'password' => Hash::make('password'),
        ]);
        $staff->assignRole('Staff');

        // 4. Finance
        $finance = User::create([
            'name' => 'Finance One',
            'email' => 'finance@example.com',
            'password' => Hash::make('password'),
        ]);
        $finance->assignRole('Finance');
    }
}
