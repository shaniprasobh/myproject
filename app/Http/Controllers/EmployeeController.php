<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Company;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\EmployeeCreated;


class EmployeeController extends Controller
{
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
            'email' => 'required|email|unique:employees,email',
            'company_id' => 'required|exists:companies,id',
            'mobile_number' => 'nullable|string|max:15',
            'address' => 'nullable|string',
        ]);

        // Generate a random password
        $tempPassword = Str::random(8);

        // Create employee
        $employee = Employee::create([
            'name' => $request->name,
            'email' => $request->email,
            'company_id' => $request->company_id,
            'mobile_number' => $request->mobile_number,
            'address' => $request->address,
            'password' => Hash::make($tempPassword),
        ]);

        // Send email to employee
        Mail::to($employee->email)->send(new EmployeeCreated($employee, $tempPassword));

        return redirect()->route('employees.index')
                         ->with('success', 'Employee created successfully and email sent.');
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
            'address' => 'nullable|string',
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
