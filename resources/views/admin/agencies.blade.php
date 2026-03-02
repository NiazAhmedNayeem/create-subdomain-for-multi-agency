@extends('admin.layout')

@section('content')
<h1 class="text-2xl font-bold mb-6">Agencies</h1>

<a href="#" class="bg-blue-500 text-white px-4 py-2 rounded">
    Create Agency
</a>

<table class="w-full mt-6 bg-white shadow rounded">
    <tr class="border-b">
        <th class="p-3 text-left">ID</th>
    </tr>

    @foreach(\Stancl\Tenancy\Database\Models\Tenant::all() as $tenant)
    <tr class="border-b">
        <td class="p-3">{{ $tenant->id }}</td>
    </tr>
    @endforeach
</table>
@endsection
