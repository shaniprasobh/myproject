<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees = \App\Models\Employee::with('company')->get();
        return view('employees.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $companies = \App\Models\Company::all();
        return view('employees.create', compact('companies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'company_id' => 'nullable|exists:companies,id',
            'email' => 'nullable|email',
            'mobile_number' => 'nullable|string|max:15',
        ]);
        $employee = \App\Models\Employee::create($validated);
        return redirect()->route('employees.index')->with('success', 'Employee created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $employee = \App\Models\Employee::with('company')->findOrFail($id);
        return view('employees.show', compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $employee = \App\Models\Employee::findOrFail($id);
        $companies = \App\Models\Company::all();
        return view('employees.edit', compact('employee', 'companies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'company_id' => 'nullable|exists:companies,id',
            'email' => 'nullable|email',
            'mobile_number' => 'nullable|string|max:15',
        ]);
        $employee = \App\Models\Employee::findOrFail($id);
        $employee->update($validated);
        return redirect()->route('employees.index')->with('success', 'Employee updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $employee = \App\Models\Employee::findOrFail($id);
        $employee->delete();
        return redirect()->route('employees.index')->with('success', 'Employee deleted successfully.');
    }
}
