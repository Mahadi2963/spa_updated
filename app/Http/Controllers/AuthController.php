<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Student;
use App\Models\Teacher;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'role' => 'required|in:student,teacher',
            'contact' => 'required|string|max:20',
            'image' => 'nullable|image|max:2048',
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);

        if ($request->hasFile('image')) {
            $validatedData['image'] = $request->file('image')->store('images/users', 'public');
        }

        $user = User::create($validatedData);

        // No longer creating Student/Teacher here; handled in User model.

        return redirect()->route('login')->with('message', 'Registration successful, awaiting admin verification.');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $credentials['email'])->where('is_verified', true)->first();

        if ($user && Auth::attempt(['email' => $credentials['email'], 'password' => $credentials['password']])) {
            return $this->redirectBasedOnRole($user);
        }

        return redirect()->back()->withErrors(['error' => 'Invalid credentials or account not verified.']);
    }

    private function redirectBasedOnRole($user)
    {
        switch ($user->role) {
            case 'admin':
                return redirect()->route('admin.dashboard')->with('message', 'Login successful!');
            case 'teacher':
                return redirect()->route('teacher.dashboard')->with('message', 'Login successful!');
            case 'student':
                return redirect()->route('student.dashboard')->with('message', 'Login successful!');
            default:
                return redirect()->route('login')->withErrors(['error' => 'Role not recognized.']);
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('message', 'Logged out successfully.');
    }
}
