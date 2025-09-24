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

        $adminUser = User::updateOrCreate(
            ['email' => $adminEmail],
            [
                'name' => 'Admin User',
                'password' => Hash::make($adminPassword),
                'email_verified_at' => now(),
            ]
        );
        
        // Debug: Output admin user info to log
        \Log::info('Admin user after seeder:', ['user' => $adminUser]);

        // Assign Admin role
        if (!$adminUser->hasRole('Admin')) {
            $adminUser->assignRole('Admin');
        }

        // Create Employee record for admin if not exists
        $adminCompany = \App\Models\Company::first();
        \App\Models\Employee::updateOrCreate(
            [
                'email' => $adminEmail,
            ],
            [
                'user_id' => $adminUser->id,
                'company_id' => $adminCompany ? $adminCompany->id : null,
                'name' => 'Admin User',
                'mobile_number' => '9999999999',
                'address' => 'Admin Address',
                'status' => 1,
            ]
        );

        $this->command->info("Admin user created: $adminEmail / $adminPassword");

        $this->call([
            CompanySeeder::class,
            EmployeeSeeder::class,
        ]);


        // Ensure every user has a matching Employee record
        $company = \App\Models\Company::first();
        foreach (\App\Models\User::all() as $user) {
            \App\Models\Employee::updateOrCreate(
                [
                    'user_id' => $user->id,
                    'email' => $user->email,
                ],
                [
                    'company_id' => $company ? $company->id : null,
                    'name' => $user->name,
                    'mobile_number' => '9999999999',
                    'address' => 'Default Address',
                    'status' => 1,
                ]
            );
        }

        // Ensure every user has a matching Employee record
        $company = \App\Models\Company::first();
        foreach (\App\Models\User::all() as $user) {
            \App\Models\Employee::updateOrCreate(
                [
                    'email' => $user->email,
                ],
                [
                    'user_id' => $user->id,
                    'company_id' => $company ? $company->id : null,
                    'name' => $user->name,
                    'mobile_number' => '9999999999',
                    'address' => 'Default Address',
                    'status' => 1,
                ]
            );
        }
    }
}
