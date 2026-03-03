<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Super Admin Panel</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100">

    <div class="flex h-screen">

        <!-- Sidebar -->
        <aside class="w-64 bg-gray-900 text-white flex flex-col justify-between">
            <div class="p-6">
                <!-- Title -->
                <h2 class="text-2xl font-bold mb-10">Super Admin</h2>

                <!-- Menu -->
                <nav>
                    <ul class="space-y-4">
                        <li>
                            <a href="{{ route('admin.dashboard') }}"
                                class="block px-4 py-2 rounded hover:bg-gray-700 transition">
                                Dashboard
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.agencies') }}"
                                class="block px-4 py-2 rounded hover:bg-gray-700 transition">
                                Agencies
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>

            <!-- Logout Button -->
            <div class="p-6">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="w-full bg-red-500 hover:bg-red-600 text-white font-semibold px-4 py-2 rounded transition">
                        Logout
                    </button>
                </form>
            </div>
        </aside>

        <!-- Content Area -->
        <main class="flex-1 p-10 overflow-y-auto">
            @yield('content')
        </main>

    </div>

</body>

</html>
