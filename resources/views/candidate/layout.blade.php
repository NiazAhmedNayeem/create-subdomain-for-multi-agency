<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Candidate Dashboard</title>
     <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

    <div class="flex h-screen">

        <!-- Sidebar -->
        <aside class="w-64 bg-green-700 text-white flex flex-col justify-between">

            <div class="p-6">

                <!-- Agency Name -->
                <h2 class="text-2xl font-bold mb-2">
                    {{ app('currentAgency')->name }}
                </h2>

                <p class="text-sm text-indigo-200 mb-10">
                    Candidate Panel
                </p>

                <!-- Menu -->
                <nav>
                    <ul class="space-y-4">

                        <li>
                            <a href="{{ route('candidate.dashboard', ['subdomain' => app('currentAgency')->subdomain]) }}"
                                class="block px-4 py-2 rounded hover:bg-indigo-600 transition">
                                Dashboard
                            </a>
                        </li>

                        <li>
                            <a href="#" class="block px-4 py-2 rounded hover:bg-indigo-600 transition">
                                My Profile
                            </a>
                        </li>

                        <li>
                            <a href="#" class="block px-4 py-2 rounded hover:bg-indigo-600 transition">
                                My Jobs
                            </a>
                        </li>

                        <li>
                            <a href="#" class="block px-4 py-2 rounded hover:bg-indigo-600 transition">
                                Billing
                            </a>
                        </li>

                    </ul>
                </nav>
            </div>

            <!-- Logout -->
            <div class="p-6">
                <form method="POST" action="{{ route('agency.logout', ['subdomain' => request()->route('subdomain')]) }}">
                    @csrf
                    <button type="submit"
                        class="w-full bg-red-500 hover:bg-red-600 text-white font-semibold px-4 py-2 rounded transition">
                        Logout
                    </button>
                </form>
            </div>

        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-10 overflow-y-auto">
            @yield('content')
        </main>

    </div>

</body>

</html>
