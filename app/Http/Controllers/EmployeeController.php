<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Show the profile of the logged-in user (if they have an employee record).
     */
    public function profile()
    {
        $employee = \App\Models\Employee::where('user_id', auth()->id())->with('company')->first();
        if (!$employee) {
            abort(404, 'Employee profile not found.');
        }
        return view('employees.show', compact('employee'));
    }
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
            'designation' => 'nullable|string|max:255',
            'company_id' => 'nullable|exists:companies,id',
            'email' => 'nullable|email',
            'mobile_number' => 'nullable|string|max:15',
        ]);

        // If email is provided, create a user and send credentials
        $userId = null;
        $plainPassword = null;
        if (!empty($validated['email'])) {
            $plainPassword = \Str::random(8);
            $user = \App\Models\User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => bcrypt($plainPassword),
            ]);
            $userId = $user->id;

            // Send email
            \Mail::to($validated['email'])->send(new \App\Mail\EmployeeAccountMail($validated['email'], $plainPassword));
        }

        $employee = \App\Models\Employee::create(array_merge($validated, ['user_id' => $userId]));
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
            'designation' => 'nullable|string|max:255',
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
