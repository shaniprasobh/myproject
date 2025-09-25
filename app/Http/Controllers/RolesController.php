<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesController extends Controller
{
    // Show the manage roles & permissions page
    public function manage(Request $request)
    {
        $roles = Role::all();
        $permissions = Permission::all();
        $selectedRole = null;
        $selectedPermissions = [];
        if ($request->has('role_id') && $request->role_id) {
            $selectedRole = Role::find($request->role_id);
            if ($selectedRole) {
                $selectedPermissions = $selectedRole->permissions->pluck('name')->toArray();
            }
        }
        return view('roles.manage', compact('roles', 'permissions', 'selectedRole', 'selectedPermissions'));
    }

    // Update permissions for a role
    public function manageUpdate(Request $request)
    {
        $request->validate([
            'role_id' => 'required|exists:roles,id',
            'permissions' => 'array',
            'permissions.*' => 'string|exists:permissions,name',
        ]);
        $role = Role::findOrFail($request->role_id);
        $role->syncPermissions($request->input('permissions', []));
        return redirect()->route('roles.manage', ['role_id' => $role->id])->with('success', 'Role permissions updated successfully.');
    }
}
