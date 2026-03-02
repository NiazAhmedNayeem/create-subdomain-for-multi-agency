@extends('admin.layout')

@section('content')
<div class="max-w-6xl mx-auto mt-8">

    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Agencies</h1>
        <a href="{{ route('admin.agencies.create') }}"
           class="bg-blue-500 hover:bg-blue-600 text-white px-5 py-2 rounded shadow-md transition duration-300">
            Create Agency
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white shadow rounded-lg">
            <thead>
                <tr class="bg-gray-100 text-left">
                    <th class="px-4 py-3 border-b">ID</th>
                    <th class="px-4 py-3 border-b">Agency Name</th>
                    <th class="px-4 py-3 border-b">Admin Email</th>
                    <th class="px-4 py-3 border-b">Subdomain</th>
                    <th class="px-4 py-3 border-b">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach (\App\Models\Agency::with('admins')->get() as $agency)
                    @php
                        $admin = $agency->admins->first();
                    @endphp
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-4 py-3">{{ $agency->id }}</td>
                        <td class="px-4 py-3">{{ $agency->name }}</td>
                        <td class="px-4 py-3">{{ $admin ? $admin->email : '-' }}</td>
                        <td class="px-4 py-3">
                            <a href="http://{{ $agency->subdomain }}.lvh.me:8000" target="_blank"
                               class="text-blue-600 hover:underline">
                               {{ $agency->subdomain }}.lvh.me
                            </a>
                        </td>
                        <td class="px-4 py-3 space-x-2">
                            <a href="{{ route('admin.agencies.edit', $agency->id) }}"
                               class="bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1 rounded">Edit</a>

                            <form action="{{ route('admin.agencies.destroy', $agency->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded"
                                        onclick="return confirm('Are you sure you want to delete this agency?')">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
@endsection
