@extends('admin.layout')

@section('content')
<h1 class="text-3xl font-bold mb-6">Super Admin Dashboard</h1>

<div class="grid grid-cols-3 gap-6">
    <div class="bg-white p-6 rounded shadow">
        <h2 class="text-gray-500">Total Agencies</h2>
        <p class="text-3xl font-bold">{{ \Stancl\Tenancy\Database\Models\Tenant::count() }}</p>
    </div>
</div>
@endsection
