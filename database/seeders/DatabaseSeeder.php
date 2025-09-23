<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Create default roles if they don't exist
        $roles = ['Admin', 'Manager', 'Employee'];
        foreach ($roles as $roleName) {
            Role::firstOrCreate(['name' => $roleName]);
        }

        // Create admin user
        $adminEmail = 'admin@example.com';
        $adminPassword = 'password';

        $adminUser = User::firstOrCreate(
            ['email' => $adminEmail],
            [
                'name' => 'Admin User',
                'password' => Hash::make($adminPassword),
                'email_verified_at' => now(),
            ]
        );

        // Assign Admin role
        if (!$adminUser->hasRole('Admin')) {
            $adminUser->assignRole('Admin');
        }

        $this->command->info("Admin user created: $adminEmail / $adminPassword");
    


        $this->call([
            CompanySeeder::class,
            EmployeeSeeder::class,
        ]);
    }
}
