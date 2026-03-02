<?php

namespace App\Http\Controllers;

use App\Models\Agency;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AgencyController extends Controller
{
    public function index()
    {
        $agencies = Agency::with('admins')->get();
        return view('admin.agencies', compact('agencies'));
    }

    public function create()
    {
        return view('admin.create-agency');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'subdomain' => 'required|string|max:50|alpha_dash|unique:agencies,subdomain',
            'admin_email' => 'required|email|unique:users,email',
            'admin_password' => 'required|string|min:6',
        ]);

        $subdomain = strtolower(str_replace(' ', '', $request->subdomain));

        if (Agency::where('subdomain', $subdomain)->exists()) {
            return back()->withInput()->withErrors(['subdomain' => 'This subdomain is already taken.']);
        }

        $agency = Agency::create([
            'name' => $request->name,
            'subdomain' => $subdomain,
        ]);

        // Create Admin User for this agency
        User::create([
            'name' => $request->name . ' Agency Admin',
            'email' => $request->admin_email,
            'password' => Hash::make($request->admin_password),
            'role' => 'agency_admin',
            'agency_id' => $agency->id,
        ]);

        return redirect()->route('admin.agencies')->with('success', 'Agency created successfully with Admin!');
    }

    public function edit(Agency $agency)
    {
        $admin = $agency->admins->first();
        return view('admin.edit-agency', compact('agency', 'admin'));
    }

    public function update(Request $request, Agency $agency)
{
    // Validate input
    $request->validate([
        'name' => 'required|string|max:255',
        'subdomain' => 'required|string|max:255|unique:agencies,subdomain,' . $agency->id,
        'admin_email' => 'required|email|unique:users,email,' . optional($agency->admins->first())->id,
        'admin_password' => 'nullable|string|min:6',
    ]);

    $agency->update([
        'name' => $request->name,
        'subdomain' => strtolower(str_replace(' ', '', $request->subdomain)),
    ]);

    $admin = $agency->admins->first();
    if ($admin) {
        $admin->update([
            'email' => $request->admin_email,
            'password' => $request->admin_password ? Hash::make($request->admin_password) : $admin->password,
        ]);
    }

    return redirect()->route('admin.agencies')->with('success', 'Agency updated successfully!');
}

    public function destroy(Agency $agency)
    {
        $agency->delete();
        return redirect()->route('admin.agencies')->with('success', 'Agency deleted successfully!');
    }
}
