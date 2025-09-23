<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions
        Permission::firstOrCreate(['name' => 'create company']);
        Permission::firstOrCreate(['name' => 'edit company']);
        Permission::firstOrCreate(['name' => 'delete company']);
        Permission::firstOrCreate(['name' => 'view company']);

        Permission::firstOrCreate(['name' => 'create employee']);
        Permission::firstOrCreate(['name' => 'edit employee']);
        Permission::firstOrCreate(['name' => 'delete employee']);
        Permission::firstOrCreate(['name' => 'view employee']);

        // Create roles and assign permissions
        $admin = Role::firstOrCreate(['name' => 'admin']);
        $admin->givePermissionTo(Permission::all());

        $manager = Role::firstOrCreate(['name' => 'manager']);
        $manager->givePermissionTo([
            'create company',
            'edit company',
            'view company',
            'create employee',
            'edit employee',
            'view employee',
        ]);

        $employee = Role::firstOrCreate(['name' => 'employee']);
        $employee->givePermissionTo([
            'view company',
            'view employee',
            'edit employee',
        ]);
    }
}
