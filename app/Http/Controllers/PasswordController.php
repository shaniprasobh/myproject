<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PasswordController extends Controller
{
    public function showChangeForm()
    {
        return view('auth.change-password'); // Blade view
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);

        $user = Auth::user();

        // Check current password
        if (!Hash::check($request->current_password, $user->password)) {
            \Log::info('Password change failed: current password incorrect', ['user_id' => $user->id]);
            return back()->withErrors(['current_password' => 'Current password is incorrect']);
        }

        // Update password
        $user->password = Hash::make($request->new_password);
        $saved = $user->save();

        if ($saved) {
            \Log::info('Password updated successfully', ['user_id' => $user->id]);
            return redirect()->route('password.change')->with('success', 'Password updated successfully!');
        } else {
            \Log::warning('Password update failed', ['user_id' => $user->id]);
            return back()->with('error', 'Password could not be updated. Please try again.');
        }
    }
}
