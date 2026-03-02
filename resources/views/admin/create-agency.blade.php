@extends('admin.layout')

@section('content')
<h1 class="text-2xl font-bold mb-6">Create Agency</h1>

<form method="POST" action="{{ route('admin.agencies.store') }}">
    @csrf

    <input type="text" name="name" placeholder="Agency Name"
           class="border p-2 w-full mb-4">

    <button class="bg-blue-500 text-white px-4 py-2 rounded">
        Create
    </button>
</form>
@endsection
