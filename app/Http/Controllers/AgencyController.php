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

    // Show Create Form
    public function create()
    {
        return view('admin.create-agency');
    }

    // Store new agency + admin
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'admin_email' => 'required|email|unique:users,email',
            'admin_password' => 'required|string|min:6',
        ]);

        $agency = Agency::create([
            'name' => $request->name,
            'subdomain' => strtolower(str_replace(' ', '', $request->name)),
        ]);

        User::create([
            'name' => $request->name . ' Admin',
            'email' => $request->admin_email,
            'password' => Hash::make($request->admin_password),
            'role' => 'agency_admin',
            'agency_id' => $agency->id,
        ]);

        return redirect()->route('admin.agencies')->with('success', 'Agency created with Admin!');
    }

    // Show Edit Form
    public function edit(Agency $agency)
    {
        $admin = $agency->admins->first();
        return view('admin.edit-agency', compact('agency', 'admin'));
    }

    // Update Agency + Admin
    public function update(Request $request, Agency $agency)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'admin_email' => 'required|email|unique:users,email,' . optional($agency->admins->first())->id,
            'admin_password' => 'nullable|string|min:6',
        ]);

        $agency->update([
            'name' => $request->name,
            'subdomain' => strtolower(str_replace(' ', '', $request->name)),
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

    // Delete Agency + Admin
    public function destroy(Agency $agency)
    {
        $agency->delete(); // cascade deletes admins if foreign key is set
        return redirect()->route('admin.agencies')->with('success', 'Agency deleted successfully!');
    }
}
