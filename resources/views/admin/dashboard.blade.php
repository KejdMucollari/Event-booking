<x-layouts.app>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <!-- Welcome Card -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                {{ __("Welcome, Admin!") }}
            </div>
        </div>

        <!-- Quick Links / Actions -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Manage Users Card -->
            <div class="bg-blue-50 border-l-4 border-blue-500 shadow rounded-lg p-6 hover:shadow-lg transition">
                <h3 class="text-lg font-semibold text-blue-700 mb-2">Manage Users</h3>
                <p class="text-blue-600 mb-4">Search, promote or demote users easily.</p>
                <a href="{{ route('admin.users') }}" 
                   class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 shadow">
                    Go to User Management
                </a>
            </div>

            <!-- Other Cards Placeholder -->
            <div class="bg-green-50 border-l-4 border-green-500 shadow rounded-lg p-6 hover:shadow-lg transition">
                <h3 class="text-lg font-semibold text-green-700 mb-2">Manage Events</h3>
                <p class="text-green-600 mb-4">View, create or edit events.</p>
                <a href="{{ route('events.index') }}" 
                   class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 shadow">
                    Go to Events
                </a>
            </div>
        </div>
    </div>
</x-layouts.app>
