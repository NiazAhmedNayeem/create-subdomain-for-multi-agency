@extends('admin.layout')

@section('content')
    <div class="max-w-3xl mx-auto py-10">
        <h1 class="text-3xl font-bold mb-6">Create New Agency</h1>

        <form action="{{ route('admin.agencies.store') }}" method="POST" class="bg-white shadow rounded p-6 space-y-4"
            x-data="subdomainCheck()">
            @csrf

            <div>
                <label class="block text-gray-700 font-semibold mb-2">Agency Name:</label>
                <input type="text" name="name" required
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label class="block text-gray-700 font-semibold mb-2">Sub Domain:</label>
                <input type="text" name="subdomain" required x-model="subdomain" @input.debounce.500="checkSubdomain()"
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="example: myagency">
                <p class="mt-1 text-sm" :class="status === 'available' ? 'text-green-600' : 'text-red-600'">
                    <span x-text="message"></span>
                </p>
            </div>

            <div>
                <label class="block text-gray-700 font-semibold mb-2">Admin Email:</label>
                <input type="email" name="admin_email" required
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label class="block text-gray-700 font-semibold mb-2">Admin Password:</label>
                <input type="password" name="admin_password" required
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div class="pt-4">
                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded transition"
                    :disabled="status === 'taken'">
                    Create Agency
                </button>
            </div>
        </form>
    </div>

    <!-- Alpine.js CDN -->
    <script src="//unpkg.com/alpinejs" defer></script>

    <script>
        function subdomainCheck() {
            return {
                subdomain: '',
                status: '',
                message: '',
                checkSubdomain() {
                    if (this.subdomain.length < 3) {
                        this.status = '';
                        this.message = '';
                        return;
                    }

                    fetch(`/admin/agencies/check-subdomain?subdomain=${this.subdomain}`)
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
