<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\User;
use App\Models\Company;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Helpers\PermissionHelper;

class EmployeesController extends Controller
{
    // Delete an employee
    public function destroy($id)
    {
        $user = Auth::user();
        if (!PermissionHelper::isUserPermittedTo($user, 'delete employee')) {
            abort(403, 'You do not have permission to delete employees.');
        }
        $employee = Employee::findOrFail($id);
        $targetUser = $employee->user;
        // Restrict: Only Super Admin can delete Super Admins or Managers
        if ($targetUser && ($targetUser->hasRole('Super Admin') || $targetUser->hasRole('Manager'))) {
            if (!$user->hasRole('Super Admin')) {
                abort(403, 'Only Super Admin can delete Super Admin or Manager employees.');
            }
        }
        $userModel = $employee->user;
        $employee->delete();
        if ($userModel) {
            $userModel->delete();
        }
        return redirect()->route('employees.index')->with('success', 'Employee deleted successfully.');
    }
    // Update an employee
    public function update(Request $request, $id)
    {
        $user = Auth::user();
        if (!PermissionHelper::isUserPermittedTo($user, 'edit employee')) {
            abort(403, 'You do not have permission to edit employees.');
        }
        $employee = Employee::findOrFail($id);
        $user = $employee->user;

        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'company_id' => 'required|exists:companies,id',
            'mobile_number' => ['nullable', 'regex:/^[0-9]{10}$/'],
            'address' => 'nullable|string|max:255',
        ];
        // Only validate password if present
        if ($request->filled('password')) {
            $rules['password'] = 'required|string|min:8|confirmed';
        }
        if ($request->has('role')) {
            $rules['role'] = 'required|in:Manager,Employee';
        }
        $request->validate($rules);

        // Update user
        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
        $user->save();

        // Always sync user role if present in request
        if ($request->has('role')) {
            $newRole = $request->input('role');
            $user->syncRoles([$newRole]);
        }

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
        $user = Auth::user();
        if (!PermissionHelper::isUserPermittedTo($user, 'edit employee')) {
            abort(403, 'You do not have permission to edit employees.');
        }
        $employee = Employee::findOrFail($id);
        $companies = Company::all();
        $showRoleDropdown = true; // Always show the role dropdown
        $roles = ['Manager', 'Employee'];
        $targetUser = $employee->user;
        // Restrict: Only Super Admin can edit Super Admins or Managers
        if ($targetUser && ($targetUser->hasRole('Super Admin') || $targetUser->hasRole('Manager'))) {
            if (!$user->hasRole('Super Admin')) {
                abort(403, 'Only Super Admin can edit Super Admin or Manager employees.');
            }
        }
        return view('employees.edit', compact('employee', 'companies', 'showRoleDropdown', 'roles'));
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
        $user = Auth::user();
        if (!PermissionHelper::isUserPermittedTo($user, 'view employee')) {
            abort(403, 'You do not have permission to view employees.');
        }
        $employees = Employee::with('company')->get();
        return view('employees.index', compact('employees'));
    }

    // Show create employee form
    public function create()
    {
        $user = Auth::user();
        if (!PermissionHelper::isUserPermittedTo($user, 'create employee')) {
            abort(403, 'You do not have permission to create employees.');
        }
        $companies = Company::all();
        $currentUser = $user;
        $currentRole = null;
        if ($currentUser && method_exists($currentUser, 'getRoleNames')) {
            $roleNames = call_user_func([$currentUser, 'getRoleNames']);
            $currentRole = $roleNames && method_exists($roleNames, 'isNotEmpty') && $roleNames->isNotEmpty() ? $roleNames->first() : null;
        } elseif ($currentUser && property_exists($currentUser, 'role')) {
            $currentRole = $currentUser->role;
        }
        return view('employees.create', compact('companies', 'currentRole'));
    }

    // Store new employee
    public function store(Request $request)
    {
        $user = Auth::user();
        if (!PermissionHelper::isUserPermittedTo($user, 'create employee')) {
            abort(403, 'You do not have permission to create employees.');
        }
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'company_id' => 'required|exists:companies,id',
            'mobile_number' => ['nullable', 'regex:/^[0-9]{10}$/'],
            'address' => 'nullable|string|max:255',
            'role' => 'required|in:Manager,Employee',
        ]);

        // Generate temporary password
        $tempPassword = Str::random(8);

        // Create user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($tempPassword),
        ]);

        $user->assignRole($request->role);

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
        Log::channel('single')->info("New employee created. Temporary password: {$tempPassword}", [
            'employee_id' => $employee->id,
            'name'        => $employee->name,
            'email'       => $employee->email,
        ]);


        return redirect()->route('employees.index')
            ->with('success', 'Employee created successfully.');
    }

    // ...other methods from EmployeeController...
}
