<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\User;
use App\Models\Company;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the employees.
     */
    public function index()
    {
        $employees = Employee::with('company')->get();
        return view('employees.index', compact('employees'));
    }

    /**
     * Show the form for creating a new employee.
     */
    public function create()
    {
        $companies = Company::all();
        return view('employees.create', compact('companies'));
    }

    /**
     * Store a newly created employee in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'          => 'required|string|max:255',
            'email'         => 'required|email|unique:users,email',
            'company_id'    => 'required|exists:companies,id',
            'mobile_number' => 'nullable|string|max:15',
            'address'       => 'nullable|string|max:255',
        ]);

        // Generate a temporary password
        $tempPassword = Str::random(8);

        // Create User account
        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($tempPassword),
        ]);

        // Assign Employee role (requires spatie/laravel-permission)
        $user->assignRole('Employee');

        // Create Employee record
        $employee = Employee::create([
            'user_id'       => $user->id,
            'name'          => $request->name,
            'email'         => $request->email,
            'company_id'    => $request->company_id,
            'mobile_number' => $request->mobile_number,
            'address'       => $request->address,
            'status'        => 1,
        ]);

        // Log the temporary password (check storage/logs/laravel.log)
        Log::info("New employee created", [
            'employee_id'        => $employee->id,
            'name'               => $employee->name,
            'email'              => $employee->email,
            'temporary_password' => $tempPassword
        ]);

        return redirect()->route('employees.index')
            ->with('success', 'Employee created successfully. Temporary password logged in laravel.log.');
    }

    /**
     * Show the form for editing the specified employee.
     */
    public function edit(Employee $employee)
    {
        $companies = Company::all();
        return view('employees.edit', compact('employee', 'companies'));
    }

    /**
     * Update the specified employee in storage.
     */
    public function update(Request $request, Employee $employee)
    {
        $request->validate([
            'name'          => 'required|string|max:255',
            'email'         => 'required|email|unique:users,email,' . $employee->user_id,
            'company_id'    => 'required|exists:companies,id',
            'mobile_number' => 'nullable|string|max:15',
            'address'       => 'nullable|string|max:255',
        ]);

        // Update user
        $employee->user->update([
            'name'  => $request->name,
            'email' => $request->email,
        ]);

        // Update employee record
        $employee->update([
            'name'          => $request->name,
            'email'         => $request->email,
            'company_id'    => $request->company_id,
            'mobile_number' => $request->mobile_number,
            'address'       => $request->address,
        ]);

        return redirect()->route('employees.index')
            ->with('success', 'Employee updated successfully.');
    }

    /**
     * Remove the specified employee from storage.
     */
    public function destroy(Employee $employee)
    {
        // Delete user and employee together
        if ($employee->user) {
            $employee->user->delete();
        }
        $employee->delete();

        return redirect()->route('employees.index')
            ->with('success', 'Employee deleted successfully.');
    }
}
