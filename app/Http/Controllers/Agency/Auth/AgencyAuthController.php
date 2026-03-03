<?php

namespace App\Http\Controllers\Agency\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AgencyAuthController extends Controller
{
    public function showLogin()
    {
        return view('agency.auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $agency = request()->attributes->get('agency');
        $credentials = $request->only('email', 'password');

        if (Auth::attempt(array_merge($credentials, ['agency_id' => $agency->id]))) {
            $request->session()->regenerate();
            $user = Auth::user();

            if ($user->role === 'agency_admin') {
                return redirect()->intended(route('agency.dashboard', $agency->subdomain));
            } elseif ($user->role === 'client') {
                return redirect()->intended(route('client.dashboard', $agency->subdomain));
            } elseif ($user->role === 'candidate') {
                return redirect()->intended(route('candidate.dashboard', $agency->subdomain));
            }

            return redirect('/');
        }

        return back()->withErrors(['email' => 'Invalid credentials or unauthorized access.']);
    }


    public function clientShowRegister()
    {
        return view('agency.auth.client-register');
    }

    public function clientRegister(Request $request)
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

    public function candidateShowRegister()
    {
        return view('agency.auth.candidate-register');
    }

    public function candidateRegister(Request $request)
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
}
