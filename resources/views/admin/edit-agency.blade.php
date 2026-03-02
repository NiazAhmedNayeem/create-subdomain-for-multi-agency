@extends('admin.layout')

@section('content')
    <div class="max-w-3xl mx-auto py-10">
        <h1 class="text-3xl font-bold mb-6">Edit Agency</h1>

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('admin.agencies.update', $agency->id) }}" method="POST"
            class="bg-white shadow rounded p-6 space-y-4" x-data="subdomainCheck('{{ $agency->id }}', '{{ $agency->subdomain }}')">
            @csrf
            @method('PUT')

            <!-- Agency Name -->
            <div>
                <label class="block text-gray-700 font-semibold mb-2">Agency Name:</label>
                <input type="text" name="name" value="{{ old('name', $agency->name) }}" required
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <!-- Subdomain -->
            <div>
                <label class="block text-gray-700 font-semibold mb-2">Sub Domain:</label>
                <input type="text" name="subdomain" x-model="subdomain" @input.debounce.500="checkSubdomain()"
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    required>
                <p class="mt-1 text-sm" :class="status === 'available' ? 'text-green-600' : 'text-red-600'">
                    <span x-text="message"></span>
                </p>
            </div>

            <!-- Admin Email -->
            <div>
                <label class="block text-gray-700 font-semibold mb-2">Admin Email:</label>
                <input type="email" name="admin_email" value="{{ old('admin_email', $admin->email ?? '') }}" required
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <!-- Admin Password -->
            <div>
                <label class="block text-gray-700 font-semibold mb-2">Admin Password (leave blank to keep current):</label>
                <input type="password" name="admin_password"
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <!-- Submit Button -->
            <div class="pt-4">
                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded transition"
                    :disabled="status === 'taken'">
                    Update Agency
                </button>
            </div>
        </form>
    </div>

    <!-- Alpine.js CDN -->
    <script src="//unpkg.com/alpinejs" defer></script>

    <script>
        function subdomainCheck(agencyId, currentSubdomain) {
            return {
                subdomain: currentSubdomain,
                status: '',
                message: '',
                checkSubdomain() {
                    if (this.subdomain.length < 3) {
                        this.status = '';
                        this.message = '';
                        return;
                    }

                    fetch(`/admin/agencies/check-subdomain?subdomain=${this.subdomain}&exclude_id=${agencyId}`)
                        .then(res => res.json())
                        .then(data => {
                            if (data.available) {
                                this.status = 'available';
                                this.message = 'Subdomain is available';
                            } else {
                                this.status = 'taken';
                                this.message = 'Subdomain is already taken';
                            }
                        })
                        .catch(err => {
                            this.status = '';
                            this.message = '';
                            console.error(err);
                        });
                }
            }
        }
    </script>
@endsection
