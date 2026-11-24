<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    // Show Registration Page
    public function showRegistrationForm()
    {
        if (Auth::check()) {
            if (Auth::user()->role === 'admin') {
                return redirect()->route('dashboard');
            }

            return redirect()->route('user.dashboard');
        }

        return view('auth.register');
    }

    // Register New User
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        // Always assign normal user role
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'user',
        ]);

        // Automatically login registered user
        Auth::login($user);

        $request->session()->regenerate();

        return redirect()
            ->route('user.dashboard')
            ->with('success', 'Registration successful! Welcome to BlogSphere.');
    }
}
