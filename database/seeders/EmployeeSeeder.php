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
            $this->command->warn("⚠️ No company found. Please seed a company first.");
            return;
        }

        // Sample employees
        $employeesData = [
            [
                'name' => 'Employee User',
                'email' => 'employee@example.com',
                'mobile_number' => '7777777777',
            ],
            [
                'name' => 'John Doe',
                'email' => 'john@example.com',
                    'mobile_number' => '1234567890',
                    'address' => '123 Main St',
            ],
            [
                'name' => 'Jane Smith',
                'email' => 'jane@example.com',
                    'mobile_number' => '9876543210',
                    'address' => '456 Elm St',
            ],
        ];

        foreach ($employeesData as $data) {
            $password = 'password123';

            $user = User::updateOrCreate(
                ['email' => $data['email']],
                [
                    'name' => $data['name'],
                    'password' => Hash::make($password),
                ]
            );

            if (!$user->hasRole('Employee')) {
                $user->assignRole('Employee');
            }

            Employee::updateOrCreate(
                ['email' => $data['email']],
                [
                    'user_id' => $user->id,
                    'company_id' => $company->id,
                    'name' => $data['name'],
                    'mobile_number' => $data['mobile_number'],
                    'address' => 'Default Address',
                    'status' => 1,
                ]
            );

            $this->command->info("✅ Employee {$data['name']} created with password: $password");
        }
    }
}
