<!DOCTYPE html>
<html>
<head>
    <title>Super Admin</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">

<div class="flex h-screen">

    <!-- Sidebar -->
    <div class="w-64 bg-gray-900 text-white p-6 flex flex-col justify-between">
        <div>
            <h2 class="text-2xl font-bold mb-10">Super Admin</h2>

            <ul class="space-y-4">
                <li>
                    <a href="{{ route('admin.dashboard') }}" class="hover:text-gray-300">Dashboard</a>
                </li>
                <li>
                    <a href="{{ route('admin.agencies') }}" class="hover:text-gray-300">Agencies</a>
                </li>
            </ul>
        </div>

        <!-- Logout Button -->
        <div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                        class="w-full bg-red-500 hover:bg-red-600 text-white font-semibold px-4 py-2 rounded transition">
                    Logout
                </button>
            </form>
        </div>
    </div>


    <!-- Content -->
    <div class="flex-1 p-10">
        @yield('content')
    </div>

</div>

</body>
</html>
