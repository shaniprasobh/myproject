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

        // Define permissions
        $permissions = [
            'create company',
            'edit company',
            'delete company',
            'view company',
            'create employee',
            'edit employee',
            'delete employee',
            'view employee',
            'view profile',
            'change password',
            'manage roles'
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Create roles
        $superAdmin = Role::firstOrCreate(['name' => 'Super Admin']);
        $manager    = Role::firstOrCreate(['name' => 'Manager']);
        $employee   = Role::firstOrCreate(['name' => 'Employee']);

        // Assign permissions
        $superAdmin->givePermissionTo(Permission::all());

        $manager->givePermissionTo([
            'create company',
            'edit company',
            'view company',
            'create employee',
            'edit employee',
            'view employee',
            'manage roles'
        ]);

        $employee->givePermissionTo([
            'view profile',
            'change password',
        ]);
    }
}
