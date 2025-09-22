<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Company;
use App\Models\Employee;
use Illuminate\Support\Facades\Hash;

class EmployeeSeeder extends Seeder
{
    public function run()
    {
        // Ensure company exists
        $company = Company::firstOrCreate(
            ['company_name' => 'Admin Company'],
            [
                'address' => '123 Main Street',
                'email' => 'info@admincompany.com',
                'mobile_number' => '9999999999',
                'country_id' => 1,
                'state_id' => 1,
                'gst_number' => 'GST123456'
            ]
        );

        // Ensure admin user exists
        $adminUser = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin User',
                'password' => Hash::make('password'),
            ]
        );

        // Create Employee linked to admin user & company
        Employee::firstOrCreate(
            ['employee_code' => 'EMP001'], // unique check
            [
                'user_id' => $adminUser->id,
                'company_id' => $company->id,
                'name' => $adminUser->name,
                'email' => $adminUser->email,
                'mobile_number' => '9999999999',
                'address' => '123 Admin Street',
                'status' => 1
            ]
        );
    }
}
