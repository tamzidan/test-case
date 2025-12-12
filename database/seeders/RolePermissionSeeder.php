<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // 2. Daftar Permission Sesuai Gambar
        $permissions = [
            // Users
            'view-users', 'create-users', 'edit-users', 'delete-users',
            // Customers
            'view-customers', 'create-customers', 'edit-customers', 'delete-customers',
            // Projects
            'view-projects', 'create-projects', 'edit-projects', 'delete-projects',
            // Tasks
            'view-tasks', 'create-tasks', 'edit-tasks', 'delete-tasks',
            // Orders
            'view-orders', 'create-orders', 'edit-orders', 'delete-orders',
            // Finance
            'view-finance', 'create-finance', 'edit-finance', 'delete-finance',
            // Reports
            'view-reports',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // 3. Create Roles & Assign Permissions

        // A. Super Admin: All Permissions
        $roleAdmin = Role::create(['name' => 'Super Admin']);
        $roleAdmin->givePermissionTo(Permission::all());

        // B. Manager
        // Matrix: Orders(CRU), Projects(CRUD), Tasks(CRUD), Reports(R)
        $roleManager = Role::create(['name' => 'Manager']);
        $roleManager->givePermissionTo([
            'view-orders', 'create-orders', 'edit-orders', // No delete
            'view-projects', 'create-projects', 'edit-projects', 'delete-projects',
            'view-tasks', 'create-tasks', 'edit-tasks', 'delete-tasks',
            'view-reports',
            // Tambahan logis: Manager biasanya perlu lihat customer/user untuk manage project
            'view-customers', 'create-customers', 'edit-customers',
            'view-users',
        ]);

        // C. Staff
        // Matrix: Projects(RU - Scope), Tasks(CRUD)
        $roleStaff = Role::create(['name' => 'Staff']);
        $roleStaff->givePermissionTo([
            'view-projects', // Read Only (Edit dibatasi scope logika nanti)
            'view-tasks', 'create-tasks', 'edit-tasks', 'delete-tasks', // Full CRUD Task
        ]);

        // D. Finance
        // Matrix: Finance(CRUD), Projects(R), Orders(RU)
        $roleFinance = Role::create(['name' => 'Finance']);
        $roleFinance->givePermissionTo([
            'view-finance', 'create-finance', 'edit-finance', 'delete-finance',
            'view-projects',
            'view-orders', 'edit-orders', // Update status/detail only
            'view-customers',
            'view-reports', // Biasanya Finance butuh laporan juga
        ]);
    }
}
