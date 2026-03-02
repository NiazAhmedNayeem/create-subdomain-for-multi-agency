<!DOCTYPE html>
<html>
<head>
    <title>Agency Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.3.2/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 p-6">

    <div class="max-w-5xl mx-auto bg-white shadow rounded p-6">
        <h1 class="text-2xl font-bold mb-4">Agency Dashboard</h1>
        <p class="mb-2">This is tenant: <strong>{{ tenant('id') }}</strong></p>

        <!-- Quick stats -->
        <div class="grid grid-cols-2 gap-4 mb-6">
            <div class="bg-blue-100 p-4 rounded text-center">
                <h2 class="text-lg font-semibold">Admins</h2>
                <p class="text-2xl">3</p>
            </div>
            <div class="bg-green-100 p-4 rounded text-center">
                <h2 class="text-lg font-semibold">Staff</h2>
                <p class="text-2xl">12</p>
            </div>
            <div class="bg-yellow-100 p-4 rounded text-center">
                <h2 class="text-lg font-semibold">Clients</h2>
                <p class="text-2xl">45</p>
            </div>
            <div class="bg-red-100 p-4 rounded text-center">
                <h2 class="text-lg font-semibold">Candidates</h2>
                <p class="text-2xl">120</p>
            </div>
        </div>

        <!-- Quick Links -->
        <div class="flex gap-4">
            <a href="#" class="bg-blue-500 text-white px-4 py-2 rounded">Manage Admins</a>
            <a href="#" class="bg-green-500 text-white px-4 py-2 rounded">Manage Staff</a>
            <a href="#" class="bg-yellow-500 text-white px-4 py-2 rounded">Manage Clients</a>
            <a href="#" class="bg-red-500 text-white px-4 py-2 rounded">Manage Candidates</a>
        </div>
    </div>

</body>
</html>
