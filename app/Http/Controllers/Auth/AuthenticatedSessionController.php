<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\Agency;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('email', 'password');

        $host = $request->getHost();
        $subdomain = explode('.', $host)[0]; // niaz, java etc.

        $agency = \App\Models\Agency::where('subdomain', $subdomain)->first();

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            $request->session()->regenerate();

            // Super Admin → always main domain
            if ($user->role === 'super_admin') {
                if ($agency) {
                    Auth::logout();
                    return redirect('http://lvh.me:8000/login')
                        ->with('error', 'Super Admin must login from main domain');
                }
                return redirect()->intended('/admin/dashboard');
            }

            // Agency Admin / Client → must match agency subdomain
            if (!$agency || $user->agency_id !== $agency->id) {
                Auth::logout();
                return back()->withErrors([
                    'email' => 'You cannot login to this agency.'
                ]);
            }

            // Redirect by role
            if ($user->role === 'agency_admin' || $user->role === 'client') {
                return redirect()->intended('/agency/dashboard');
            }

            return redirect()->intended('/');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
