<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Event Booking' }}</title>

    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
</head>
<body class="bg-gray-100 text-gray-900">

    <!-- Navbar -->
    <nav class="bg-white shadow mb-6">
        <div class="container mx-auto flex justify-between items-center p-4">
            
            <!-- Logo -->
            <a href="{{ url('/') }}" class="text-2xl font-bold text-blue-600 hover:text-blue-700 transition">
                EventOpia
            </a>

            <!-- Navigation Links -->
            <div class="flex items-center space-x-4">
                <a href="{{ route('events.index') }}" class="text-gray-700 hover:text-blue-600 font-medium transition">
                    Events
                </a>

                @auth
                    <!-- Dropdown -->
                    <div class="relative group">
                        <button class="flex items-center bg-gray-100 px-3 py-1 rounded-lg hover:bg-gray-200 transition">
                            Hi, {{ auth()->user()->name }}
                            <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" 
                                 viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>

                        <!-- Dropdown Menu -->
                        <div class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg opacity-0 group-hover:opacity-100 
                                    invisible group-hover:visible transition-all z-50">
                            <ul class="py-2">
                                @if(auth()->user()->hasRole('organizer'))
                                    <li>
                                        <a href="{{ route('organizer.dashboard') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">
                                            My Events
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('events.create') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">
                                            Create Event
                                        </a>
                                    </li>
                                @endif
                                 @if(auth()->user()->hasRole('user'))
                                    <li>
                                        <a href="{{ route('bookings.index') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">
                                            My Bookings
                                        </a>
                                    </li>
                                @endif
                                @if(auth()->user()->hasRole('admin'))
                                    <li>
                                        <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">
                                            Admin Dashboard
                                        </a>
                                    </li>
                                @endif
                                <li>
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" 
                                                class="w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100">
                                            Logout
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="bg-blue-500 text-white px-3 py-1 rounded-lg hover:bg-blue-600 transition">
                        Login
                    </a>
                    <a href="{{ route('register') }}" class="bg-green-500 text-white px-3 py-1 rounded-lg hover:bg-green-600 transition">
                        Register
                    </a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="container mx-auto px-4">
        {{ $slot }}
    </main>

    <!-- Footer -->
    <footer class="text-center py-6 text-gray-600">
        © {{ date('Y') }} EventOpia. All rights reserved.
    </footer>

</body>
</html>
