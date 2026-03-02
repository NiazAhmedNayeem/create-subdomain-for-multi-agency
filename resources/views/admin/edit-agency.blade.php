@extends('admin.layout')

@section('content')
<div class="max-w-3xl mx-auto py-10">
    <h1 class="text-3xl font-bold mb-6">Edit Agency</h1>

    <form action="{{ route('admin.agencies.update', $agency->id) }}" method="POST" class="bg-white shadow rounded p-6 space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="block text-gray-700 font-semibold mb-2">Agency Name:</label>
            <input type="text" name="name" value="{{ $agency->name }}" required
                   class="w-full border border-gray-300 rounded px-3 py-2">
        </div>

        <div>
            <label class="block text-gray-700 font-semibold mb-2">Admin Email:</label>
            <input type="email" name="admin_email" value="{{ $admin->email ?? '' }}" required
                   class="w-full border border-gray-300 rounded px-3 py-2">
        </div>

        <div>
            <label class="block text-gray-700 font-semibold mb-2">Admin Password (leave blank to keep current):</label>
            <input type="password" name="admin_password"
                   class="w-full border border-gray-300 rounded px-3 py-2">
        </div>

        <div class="pt-4">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded">
                Update Agency
            </button>
        </div>
    </form>
</div>
@endsection
