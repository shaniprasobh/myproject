<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Employee;


class ProfileController extends Controller
{
    // Show logged-in user profile
    public function show()
    {
        $user = Auth::user();
        $employee = Employee::where('user_id', $user->id)->first();

        return view('profile.show', compact('user', 'employee'));
    }

    // Show edit form
    public function edit()
    {
        $user = Auth::user();
        $employee = Employee::where('user_id', $user->id)->first();

        return view('profile.edit', compact('user', 'employee'));
    }

    // Update profile
    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'designation' => 'nullable|string|max:255',
            'mobile_number' => 'nullable|string|max:15',
            'address' => 'nullable|string|max:500',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        // Update user info
        $user->update($request->only('name', 'email'));

        // Update password if provided
        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
            $user->save();
        }

        // Update employee info if exists
        $employee = Employee::where('user_id', $user->id)->first();
        if ($employee) {
            $employee->update($request->only('designation', 'mobile_number', 'address'));
        }

        return redirect()->route('profile.show')->with('success', 'Profile updated successfully.');
    }
}
