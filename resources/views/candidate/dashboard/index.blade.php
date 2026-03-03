@extends('candidate.layout')

@section('content')
    <h1 class="text-3xl font-bold mb-8 text-gray-800">
        Welcome, {{ auth()->user()->name }} 👋
    </h1>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        <!-- Card 1 -->
        <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
            <h2 class="text-lg font-semibold text-gray-700 mb-2">
                Active Services
            </h2>
            <p class="text-3xl font-bold text-indigo-600">
                3
            </p>
        </div>

        <!-- Card 2 -->
        <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
            <h2 class="text-lg font-semibold text-gray-700 mb-2">
                Pending Tasks
            </h2>
            <p class="text-3xl font-bold text-yellow-500">
                2
            </p>
        </div>

        <!-- Card 3 -->
        <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
            <h2 class="text-lg font-semibold text-gray-700 mb-2">
                Total Payments
            </h2>
            <p class="text-3xl font-bold text-green-600">
                ৳ 12,500
            </p>
        </div>

    </div>

    <div class="mt-10 bg-white p-6 rounded-xl shadow">
        <h2 class="text-xl font-semibold mb-4 text-gray-700">
            Account Overview
        </h2>

        <p class="text-gray-600">
            You are logged in under <strong>{{ app('currentAgency')->name }}</strong>.
            All your services and billing are managed by this agency.
        </p>
    </div>
@endsection
