<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
   
</head>
<body class="bg-gray-100 text-gray-900">
    <nav class="bg-white shadow p-4 flex justify-between">
        <a href="{{ route('events.index') }}" class="font-bold">Event Booking</a>
        <div>
            @auth
                <span class="mr-3">Hi, {{ auth()->user()->name }}</span>
                <a href="{{ route('bookings.index') }}" class="mr-3">My Bookings</a>
                <form class="inline" action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="text-red-600">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="mr-3">Login</a>
                <a href="{{ route('register') }}">Register</a>
            @endauth
        </div>
    </nav>
    <main class="container mx-auto mt-6">
        @if(session('success'))
            <div class="bg-green-100 text-green-800 p-3 mb-4 rounded">{{ session('success') }}</div>
        @endif
        @yield('content')
    </main>
</body>
</html>
