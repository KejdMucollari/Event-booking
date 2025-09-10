<x-layouts.app>
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold">All Events</h1>

          @if(session('status') === 'logged-in')
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            You're logged in!
        </div>
        @endif

        @auth
            @if(auth()->user()->hasRole(['organizer','admin']))
                <a href="{{ route('events.create') }}" 
                   class="bg-blue-500 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-600">
                    + Create Event
                </a>
            @endif
        @endauth
    </div>

    <!-- Events List -->
    <div class="space-y-6">
        @forelse($events as $event)
            <div class="flex bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition">
                
                <!-- Left Side: Event Image -->
                <div class="w-1/3">
                    @if($event->image)
                        <img src="{{ asset('storage/'.$event->image) }}" alt="{{ $event->title }}" 
                             class="w-full h-full object-cover">
                    @else
                        <img src="https://via.placeholder.com/400x250?text=Event+Image" 
                             alt="Default Image" 
                             class="w-full h-full object-cover">
                    @endif
                </div>

                <!-- Right Side: Event Info -->
                <div class="w-2/3 p-6 flex flex-col justify-between">
                    <!-- Title -->
                    <h2 class="text-2xl font-semibold text-gray-800 mb-2">{{ $event->title }}</h2>

                    <!-- Date & Location -->
                    <p class="text-gray-600">
                        📅 {{ $event->starts_at->format('M d, Y H:i') }}  
                        <br>📍 {{ $event->location }}
                    </p>

                    <!-- Price & Seats -->
                    <p class="mt-2 text-lg font-medium text-gray-700">
                        💵 ${{ $event->ticket_price }}  
                        | 🎟️ Seats: {{ $event->available_seats }}
                    </p>

                    <!-- Buttons -->
                    <div class="mt-4 flex space-x-2">
                        <a href="{{ route('events.show', $event) }}" 
                           class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 shadow">
                            View
                        </a>

                        @auth
                            @if(auth()->user()->hasRole(['organizer','admin']))
                                <a href="{{ route('events.edit', $event) }}" 
                                   class="bg-yellow-500 text-white px-4 py-2 rounded-lg hover:bg-yellow-600 shadow">
                                    Edit
                                </a>

                                <form action="{{ route('events.destroy', $event) }}" method="POST" 
                                      onsubmit="return confirm('Are you sure?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 shadow">
                                        Delete
                                    </button>
                                </form>
                            @endif
                        @endauth
                    </div>
                </div>
            </div>
           
        @empty
            <p class="text-gray-600 text-center">No events found.</p>
        @endforelse
    </div>
     <div class="mt-6">
               {{ $events->links() }}
            </div>
</x-layouts.app>
