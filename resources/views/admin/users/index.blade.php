<x-layouts.app>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User Management') }}
        </h2>
    </x-slot>

    <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <div class="bg-white shadow-sm sm:rounded-lg p-6">
            <!-- Search Form -->
            <form method="GET" action="{{ route('admin.users') }}" class="mb-4 flex gap-2">
                <input type="text" name="search" value="{{ $search }}" placeholder="Search by email"
                       class="border rounded-lg px-4 py-2 flex-1">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">
                    Search
                </button>
            </form>

            <!-- Users Table -->
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-2 border">Name</th>
                        <th class="px-4 py-2 border">Email</th>
                        <th class="px-4 py-2 border">Role</th>
                        <th class="px-4 py-2 border">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2 border">{{ $user->name }}</td>
                            <td class="px-4 py-2 border">{{ $user->email }}</td>
                            <td class="px-4 py-2 border">{{ $user->role?->name ?? 'No Role' }}</td>
                            <td class="px-4 py-2 border">
                                <form action="{{ route('admin.users.role', $user) }}" method="POST" class="flex gap-2">
                                    @csrf
                                    <select name="role_id" class="border rounded-lg px-2 py-1">
                                        @foreach(\App\Models\Role::all() as $role)
                                            <option value="{{ $role->id }}" 
                                                {{ $user->role_id == $role->id ? 'selected' : '' }}>
                                                {{ ucfirst($role->name) }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <button type="submit" class="bg-green-500 text-white px-3 py-1 rounded-lg hover:bg-green-600">
                                        Update
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-4 py-2 text-center">No users found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="mt-4">
                {{ $users->withQueryString()->links() }}
            </div>
        </div>
    </div>
    
</x-layouts.app>
