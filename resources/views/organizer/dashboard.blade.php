<x-layouts.app>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            My Events
        </h2>
    </x-slot>

    <div class="py-12 space-y-6">
        @forelse($events as $event)
            <div class="flex bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition">
                <!-- Image -->
                <div class="w-1/3">
                    <img src="{{ $event->image ? asset('storage/'.$event->image) : 'https://via.placeholder.com/400x250?text=Event+Image' }}" 
                         class="w-full h-full object-cover" alt="{{ $event->title }}">
                </div>

                <!-- Info -->
                <div class="w-2/3 p-6 flex flex-col justify-between">
                    <h2 class="text-2xl font-semibold">{{ $event->title }}</h2>
                    <p>📅 {{ $event->starts_at->format('M d, Y H:i') }} | 📍 {{ $event->location }}</p>
                    <p>💵 ${{ $event->ticket_price }} | 🎟️ Seats: {{ $event->available_seats }}</p>
                    
                    <div class="mt-4 flex space-x-2">
                        <a href="{{ route('events.show', $event) }}" 
                           class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 shadow">
                            View
                        </a>

                        <a href="{{ route('events.edit', $event) }}" 
                           class="bg-yellow-500 text-white px-4 py-2 rounded-lg hover:bg-yellow-600 shadow">
                            Edit
                        </a>

                        <form action="{{ route('events.destroy', $event) }}" method="POST"
                              onsubmit="return confirm('Are you sure?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 shadow">
                                Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-gray-600 text-center">You have no events.</p>
        @endforelse
    </div>
</x-layouts.app>
