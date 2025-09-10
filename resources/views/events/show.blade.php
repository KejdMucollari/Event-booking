<x-layouts.app title="{{ $event->title }}">
    <div class="bg-white rounded-2xl shadow-lg overflow-hidden flex flex-col md:flex-row">
        
        <!-- Event Image -->
        <div class="md:w-1/3 w-full">
            @if($event->image)
                <img src="{{ asset('storage/'.$event->image) }}" 
                     alt="{{ $event->title }}" 
                     class="w-full h-full object-cover">
            @else
                <img src="https://via.placeholder.com/400x250?text=Event+Image" 
                     alt="Default Image" 
                     class="w-full h-full object-cover">
            @endif
        </div>

        <!-- Event Info -->
        <div class="md:w-2/3 w-full p-6 flex flex-col justify-between">
            <h2 class="text-3xl font-bold text-gray-800 mb-4">{{ $event->title }}</h2>
            
            <p class="text-gray-600 mb-2">
                📅 {{ $event->starts_at->format('M d, Y H:i') }}  
                <br>📍 {{ $event->location }}
            </p>

            <p class="text-lg font-medium text-gray-700 mb-2">
                💵 ${{ $event->ticket_price }} | 🎟️ Seats: {{ $event->available_seats }}
            </p>

            <p class="text-gray-800 mb-4">{{ $event->description ?? 'No description provided.' }}</p>

     <!-- Action Buttons -->
<div class="flex justify-between items-center">
    <!-- Left side: Back button -->
    <a href="{{ route('events.index') }}" 
       class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 shadow">
        Back to Events
    </a>
 


    <!-- Right side: Booking form -->
    @auth
        @if(auth()->user()->hasRole('user'))
            <form action="{{ route('bookings.store', $event) }}" method="POST" class="flex items-center">
                @csrf
                <label for="tickets" class="mr-2 text-gray-700">Tickets:</label>
                <input type="number" name="tickets" id="tickets" min="1" max="{{ $event->available_seats }}"
                       class="border rounded p-2 w-24">

                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded ml-2 hover:bg-blue-600 shadow">
                    Book Event
                </button>
            </form>
        @endif
    @endauth
</div>

                @auth
                  @if(auth()->user()->hasRole('admin') || auth()->id() === $event->user_id)
                   <a href="{{ route('events.edit', $event) }}" 
                    class="bg-yellow-500 text-white px-4 py-2 rounded-lg hover:bg-yellow-600 shadow">Edit</a>

                      <form action="{{ route('events.destroy', $event) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 shadow">Delete</button>
                      </form>
                   @endif
                @endauth
            </div>
        </div>
    </div>
</x-layouts.app>
    