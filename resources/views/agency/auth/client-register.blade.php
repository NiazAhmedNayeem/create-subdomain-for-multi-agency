<!DOCTYPE html>
<html>

<head>
    <title>Client Register</title>
   <script src="https://cdn.tailwindcss.com"></script>
</head>

<body
    class="min-h-screen bg-gradient-to-br from-indigo-600 via-purple-600 to-blue-500 flex items-center justify-center px-4">

    <div class="w-full max-w-md">

        <!-- Card -->
        <div class="bg-white shadow-2xl rounded-2xl p-8">

            <!-- Agency Badge -->
            <div class="text-center mb-6">
                <div class="inline-block bg-indigo-100 text-indigo-700 px-4 py-1 rounded-full text-sm font-semibold">
                    {{ app('currentAgency')->name }}
                </div>

                <h2 class="text-2xl font-bold mt-4 text-gray-800">
                    Client Registration
                </h2>

                <p class="text-gray-500 text-sm mt-1">
                    Create your account to access services
                </p>
            </div>

            <!-- Success Message -->
            @if (session('success'))
                <div class="bg-green-100 text-green-700 p-3 rounded-lg mb-4 text-sm">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Validation Errors -->
            @if ($errors->any())
                <div class="bg-red-100 text-red-600 p-3 rounded-lg mb-4 text-sm">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Form -->
            <form method="POST"
                action="{{ route('client.register.store', ['subdomain' => app('currentAgency')->subdomain]) }}"
                class="space-y-4">
                @csrf

                <!-- Name -->
                <div>
                    <label class="text-sm font-medium text-gray-700">Full Name</label>
                    <input type="text" name="name" value="{{ old('name') }}"
                        class="w-full mt-1 px-4 py-2 border rounded-xl focus:ring-2 focus:ring-indigo-500 focus:outline-none"
                        required>
                </div>

                <!-- Email -->
                <div>
                    <label class="text-sm font-medium text-gray-700">Email Address</label>
                    <input type="email" name="email" value="{{ old('email') }}"
                        class="w-full mt-1 px-4 py-2 border rounded-xl focus:ring-2 focus:ring-indigo-500 focus:outline-none"
                        required>
                </div>

                <!-- Password -->
                <div>
                    <label class="text-sm font-medium text-gray-700">Password</label>
                    <input type="password" name="password"
                        class="w-full mt-1 px-4 py-2 border rounded-xl focus:ring-2 focus:ring-indigo-500 focus:outline-none"
                        required>
                </div>

                <!-- Submit -->
                <button type="submit"
                    class="w-full bg-indigo-600 text-white py-2 rounded-xl font-semibold hover:bg-indigo-700 transition duration-200 shadow-md">
                    Create Account
                </button>
            </form>

            <p class="text-center mt-4">
                Already have an account? <a
                    href="{{ route('agency.login', ['subdomain' => app('currentAgency')->subdomain]) }}"
                    class="text-blue-600 hover:underline">Login</a>
            </p>

        </div>

        <!-- Footer -->
        <p class="text-center text-white text-xs mt-6 opacity-80">
            © {{ date('Y') }} {{ app('currentAgency')->name }}. All rights reserved.
        </p>

    </div>

</body>

</html>
