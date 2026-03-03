<?php

namespace App\Http\Controllers\Agency\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class ClientAuthController extends Controller
{
    public function showRegister()
    {
        return view('client.auth.register');
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
            'role' => 'client',
            'agency_id' => $agency->id,
        ]);

        return redirect()->back()->with('success', 'Client registered successfully!');
    }

    public function showLogin()
    {
        return view('client.auth.login');
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
        if ($user->role !== 'client') {
            Auth::logout();
            return back()->with('error', 'Access denied: Only clients can login here.');
        }

        // Must belong to this agency
        if ($user->agency_id !== $agency->id) {
            Auth::logout();
            return back()->with('error', 'You cannot login to this agency. Wrong agency login.');
        }

        return redirect()->route('client.dashboard', [
            'subdomain' => $agency->subdomain
        ])->with('success', 'Welcome to your dashboard!');
    }
}
