<?php

namespace App\Http\Controllers\Agency\Candidate;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class CandidateAuthController extends Controller
{
    public function showRegister()
    {
        return view('candidate.auth.register');
    }

    public function register(Request $request)
    {
        $agency = app('currentAgency');

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'candidate',
            'agency_id' => $agency->id,
        ]);

        return redirect()->back()->with('success', 'Candidate registered successfully!');
    }

    public function showLogin()
    {
        return view('candidate.auth.login');
    }

    public function login(Request $request)
    {
        $agency = app('currentAgency');

        $credentials = $request->only('email', 'password');

        if (!Auth::attempt($credentials)) {
            return back()->with('error', 'Invalid credentials');
        }

        $user = Auth::user();

        // Must be client
        if ($user->role !== 'candidate') {
            Auth::logout();
            return back()->with('error', 'Access denied: Only candidate can login here.');
        }

        // Must belong to this agency
        if ($user->agency_id !== $agency->id) {
            Auth::logout();
            return back()->with('error', 'You cannot login to this agency. Wrong agency login.');
        }

        return redirect()->route('candidate.dashboard', [
            'subdomain' => $agency->subdomain
        ])->with('success', 'Welcome to your dashboard!');
    }
}
