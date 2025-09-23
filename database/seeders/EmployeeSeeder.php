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
        $company = Company::first();

        if (!$company) {
            $this->command->info("No company found. Please seed a company first.");
            return;
        }

        // List of sample employees
        $employeesData = [
            ['name' => 'John Doe', 'email' => 'john@example.com', 'mobile_number' => '9000000001'],
            ['name' => 'Jane Smith', 'email' => 'jane@example.com', 'mobile_number' => '9000000002'],
            ['name' => 'Alice Johnson', 'email' => 'alice@example.com', 'mobile_number' => '9000000003'],
        ];

        foreach ($employeesData as $data) {
            // Skip if the email is the admin email
            if ($data['email'] === 'admin@admin.com') {
                continue;
            }
            $password = \Illuminate\Support\Str::random(8); // random 8-character password

            // Create or update user (not admin)
            $user = User::updateOrCreate(
                ['email' => $data['email']],
                [
                    'name' => $data['name'],
                    'password' => Hash::make($password),
                ]
            );

            // Create or update employee and link to user
            $employee = Employee::updateOrCreate(
                [
                    'email' => $data['email'],
                ],
                [
                    'user_id' => $user->id,
                    'company_id' => $company->id,
                    'name' => $data['name'],
                    'mobile_number' => $data['mobile_number'],
                    'address' => 'Default Address',
                    'password' => Hash::make($password), // store hashed password
                    'status' => 1,
                ]
            );

            // Output password to console for testing
            $this->command->info("Employee {$data['name']} created/updated with password: $password");
        }
    }
}
