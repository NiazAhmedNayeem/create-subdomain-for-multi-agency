<!DOCTYPE html>
<html>

<head>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen bg-gradient-to-br from-green-600 to-red-600 flex items-center justify-center">

    <div class="bg-white p-8 rounded-2xl shadow-2xl w-96">

        <h2 class="text-2xl font-bold text-center mb-6">
            {{ app('currentAgency')->name }} Candidate Login
        </h2>

        @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="bg-red-100 text-red-600 p-2 rounded mb-4 text-sm">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('candidate.login.store', ['subdomain' => app('currentAgency')->subdomain]) }}">
            @csrf

            <label class="text-sm font-medium text-gray-700">Email</label>
            <input type="email" name="email" placeholder="Email" class="w-full border p-2 mb-3 rounded" required>

            <label class="text-sm font-medium text-gray-700">Password</label>
            <input type="password" name="password" placeholder="Password" class="w-full border p-2 mb-4 rounded"
                required>

            <button class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700">
                Login
            </button>
        </form>

        <p class="text-center mt-4">
            Don't have an account? <a href="{{ route('candidate.register', ['subdomain' => app('currentAgency')->subdomain]) }}"
            class="text-blue-600 hover:underline">Register</a>
        </p>

    </div>

</body>

</html>
