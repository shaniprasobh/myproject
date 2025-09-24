<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\User;
use App\Models\Company;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class EmployeesController extends Controller
{
    // Delete an employee
    public function destroy($id)
    {
        $employee = Employee::findOrFail($id);
        $user = $employee->user;
        $employee->delete();
        if ($user) {
            $user->delete();
        }
        return redirect()->route('employees.index')->with('success', 'Employee deleted successfully.');
    }
    // Update an employee
    public function update(Request $request, $id)
    {
        $employee = Employee::findOrFail($id);
        $user = $employee->user;

        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'company_id' => 'required|exists:companies,id',
            'mobile_number' => 'nullable|string|max:15',
            'address' => 'nullable|string|max:255',
        ];
        // Only validate password if present
        if ($request->filled('password')) {
            $rules['password'] = 'required|string|min:8|confirmed';
        }
        $request->validate($rules);

        // Update user
        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
        $user->save();

        // Update employee
        $employee->update([
            'name' => $request->name,
            'email' => $request->email,
            'company_id' => $request->company_id,
            'mobile_number' => $request->mobile_number,
            'address' => $request->address,
        ]);

        return redirect()->route('employees.index')->with('success', 'Employee updated successfully.');
    }
    // Show the form for editing an employee
    public function edit($id)
    {
        $employee = Employee::findOrFail($id);
        $companies = Company::all();
        return view('employees.edit', compact('employee', 'companies'));
    }
    // Show a single employee
    public function show($id)
    {
        $employee = Employee::with('company')->findOrFail($id);
        return view('employees.show', compact('employee'));
    }
    // Show all employees
    public function index()
    {
    \Log::info('Test log message from EmployeesController@index');
    $employees = Employee::with('company')->get();
    return view('employees.index', compact('employees'));
    }

    // Show create employee form
    public function create()
    {
        $companies = Company::all();
        return view('employees.create', compact('companies'));
    }

    // Store new employee
    public function store(Request $request)
    {
        \Log::info('Test log message: store method called');
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'company_id' => 'required|exists:companies,id',
            'mobile_number' => 'nullable|string|max:15',
            'address' => 'nullable|string|max:255',
        ]);

        // Generate temporary password
        $tempPassword = Str::random(8);

        // Create user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($tempPassword),
        ]);

        $user->assignRole('Employee');

        // Create employee linked to user
        $employee = Employee::create([
            'user_id' => $user->id,
            'name' => $request->name,
            'email' => $request->email,
            'company_id' => $request->company_id,
            'mobile_number' => $request->mobile_number,
            'address' => $request->address,
            'status' => 1,
        ]);

       // Log the temporary password safely (for development only)
\Log::channel('single')->info("New employee created. Temporary password: {$tempPassword}", [
    'employee_id' => $employee->id,
    'name'        => $employee->name,
    'email'       => $employee->email,
]);


        return redirect()->route('employees.index')
            ->with('success', 'Employee created successfully.');
    }

    // ...other methods from EmployeeController...
}
