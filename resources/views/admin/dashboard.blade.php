@extends('admin.layout')

@section('content')
<h1 class="text-3xl font-bold mb-6">Super Admin Dashboard</h1>

<div class="grid grid-cols-3 gap-6">
    <div class="bg-white p-6 rounded shadow">
        <h2 class="text-gray-500">Super Admin</h2>
        <p class="text-3xl font-bold">{{ \App\Models\User::where('role','super_admin')->count() }}</p>
    </div>

    <!-- Total Agencies -->
    <div class="bg-white p-6 rounded shadow">
        <h2 class="text-gray-500">Total Agencies</h2>
        <p class="text-3xl font-bold">{{ \App\Models\Agency::count() }}</p>
    </div>

    <!-- Total Admins -->
    <div class="bg-white p-6 rounded shadow">
        <h2 class="text-gray-500">Total Agency Admins</h2>
        <p class="text-3xl font-bold">{{ \App\Models\User::where('role','agency_admin')->count() }}</p>
    </div>

    <!-- Total Users -->
    <div class="bg-white p-6 rounded shadow">
        <h2 class="text-gray-500">Total Users</h2>
        <p class="text-3xl font-bold">{{ \App\Models\User::count() }}</p>
    </div>
</div>
@endsection
