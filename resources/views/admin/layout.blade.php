<!DOCTYPE html>
<html>
<head>
    <title>Super Admin</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">

<div class="flex h-screen">

    <!-- Sidebar -->
    <div class="w-64 bg-gray-900 text-white p-6">
        <h2 class="text-2xl font-bold mb-10">Super Admin</h2>

        <ul class="space-y-4">
            <li>
                <a href="{{ route('admin.dashboard') }}">Dashboard</a>
            </li>
            <li>
                <a href="{{ route('admin.agencies') }}">Agencies</a>
            </li>
        </ul>
    </div>

    <!-- Content -->
    <div class="flex-1 p-10">
        @yield('content')
    </div>

</div>

</body>
</html>
