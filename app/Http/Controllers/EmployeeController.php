<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\User; 
use App\Models\Company;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\EmployeeCreated;


class EmployeeController extends Controller
{
    /**
     * Show the profile of the logged-in employee.
     */
    public function profile()
    {
        $user = auth()->user();
        \Log::info('Profile debug', ['user_id' => $user ? $user->id : null, 'user_email' => $user ? $user->email : null]);
        $employee = Employee::where('user_id', $user->id)->first();
        if (!$employee && $user) {
            // Fallback: try to find by email
            $employee = Employee::where('email', $user->email)->first();
            \Log::info('Profile fallback by email', ['employee' => $employee]);
        }
        if (!$employee) {
            abort(404, 'Employee profile not found.');
        }
        return view('employees.profile', compact('employee'));
    }
    public function index()
    {
        $employees = Employee::with('company')->get();
        return view('employees.index', compact('employees'));
    }

    public function create()
    {
        $companies = Company::all();
        return view('employees.create', compact('companies'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'company_id' => 'required|exists:companies,id',
            'mobile_number' => 'nullable|string|max:15',
        'address' => 'nullable|string',
    ]);

    // Generate a random password
    $tempPassword = Str::random(8);

    // Create user for login
    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($tempPassword),
    ]);

    // Assign Employee role
    $user->assignRole('Employee');

    // Create employee linked to user
    $employee = Employee::create([
        'user_id' => $user->id,
        'company_id' => $request->company_id,
        'name' => $request->name,
        'email' => $request->email,
        'mobile_number' => $request->mobile_number,
        'address' => $request->address,
    ]);

    // ⚠️ Store plain password in session just once (to show to admin)
    session()->flash('employee_password', $tempPassword);

    return redirect()->route('employees.index')
        ->with('success', 'Employee created successfully. Password: ' . $tempPassword);
}


    public function show(Employee $employee)
    {
        return view('employees.show', compact('employee'));
    }

    public function edit(Employee $employee)
    {
        $companies = Company::all();
        return view('employees.edit', compact('employee', 'companies'));
    }

    public function update(Request $request, Employee $employee)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:employees,email,' . $employee->id,
            'company_id' => 'nullable|exists:companies,id',
            'mobile_number' => 'nullable|string|max:15',
            'address' => 'required|string',
        ]);

        $employee->update($request->only([
            'name', 'email', 'company_id', 'mobile_number', 'address'
        ]));

        return redirect()->route('employees.index')
                         ->with('success', 'Employee updated successfully.');
    }

    public function destroy(Employee $employee)
    {
        $employee->delete();
        return redirect()->route('employees.index')
                         ->with('success', 'Employee deleted successfully.');
    }
}
