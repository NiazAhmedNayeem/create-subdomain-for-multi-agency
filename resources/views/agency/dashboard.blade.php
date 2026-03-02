@extends('agency.layout')

@section('content')

<h1 class="text-3xl font-bold mb-8">
    Agency Dashboard
</h1>

<div class="grid grid-cols-4 gap-6">

    <div class="bg-white p-6 rounded-lg shadow">
        <h2 class="text-gray-500">Total Staff</h2>
        <p class="text-3xl font-bold">
            {{ \App\Models\User::where('agency_id',$agency->id)->where('role','staff')->count() }}
        </p>
    </div>
    
    <div class="bg-white p-6 rounded-lg shadow">
        <h2 class="text-gray-500">Total Clients</h2>
        <p class="text-3xl font-bold">
            {{ \App\Models\User::where('agency_id',$agency->id)->where('role','client')->count() }}
        </p>
    </div>

    <div class="bg-white p-6 rounded-lg shadow">
        <h2 class="text-gray-500">Candidate</h2>
        <p class="text-3xl font-bold">{{ \App\Models\User::where('agency_id',$agency->id)->where('role','candidate')->count() }}</p>
    </div>

    <div class="bg-white p-6 rounded-lg shadow">
        <h2 class="text-gray-500">Revenue</h2>
        <p class="text-3xl font-bold">$0</p>
    </div>

</div>

@endsection
