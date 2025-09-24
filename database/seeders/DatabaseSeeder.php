<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Company;
use App\Models\Employee;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run()
    {

        // --- Seed roles & permissions first ---
        $this->call(RolesAndPermissionsSeeder::class);

        // --- Seed companies and ensure one exists ---
        $this->call(CompanySeeder::class);
        $company = Company::first();
        if (!$company) {
            // Try to create a default company if still missing
            $company = Company::create([
                'company_name' => 'Default Company',
                'address' => 'Default Address',
                'email' => 'default@company.com',
                'mobile_number' => '0000000000',
                'country_id' => 1,
                'state_id' => 1,
                'gst_number' => 'GST000000'
            ]);
            $this->command->warn("⚠️ No company found, created a default company.");
        }

        // --- Create Super Admin user ---
        $superAdmin = User::updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('password123'),
                'email_verified_at' => now(),
            ]
        );
        $superAdmin->assignRole('Super Admin');

        Employee::updateOrCreate(
            ['email' => $superAdmin->email],
            [
                'user_id' => $superAdmin->id,
                'company_id' => $company->id,
                'name' => $superAdmin->name,
                'mobile_number' => '9999999999',
                'address' => 'HQ Address',
                'status' => 1,
            ]
        );

        $this->command->info("✅ Super Admin created: admin@example.com / password123");

        // --- Create Manager user ---
        $manager = User::updateOrCreate(
            ['email' => 'manager@example.com'],
            [
                'name' => 'Manager User',
                'password' => Hash::make('password123'),
            ]
        );
        $manager->assignRole('Manager');

        Employee::updateOrCreate(
            ['email' => $manager->email],
            [
                'user_id' => $manager->id,
                'company_id' => $company->id,
                'name' => $manager->name,
                'mobile_number' => '8888888888',
                'address' => 'Manager Office',
                'status' => 1,
            ]
        );

        $this->command->info("✅ Manager created: manager@example.com / password123");

        // --- Call Employee Seeder for regular employees ---
        $this->call(EmployeeSeeder::class);
    }
}
