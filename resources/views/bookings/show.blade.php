<x-layouts.app>
    <h1 class="text-2xl font-bold mb-6">Booking Details</h1>

    <div class="bg-white p-6 rounded-lg shadow flex justify-between items-center">
        <!-- Booking info -->
        <div>
            <p><strong>Event:</strong> {{ $booking->event->title }}</p>
            <p><strong>Tickets:</strong> {{ $booking->tickets }}</p>
            <p><strong>Total Amount:</strong> ${{ $booking->total_amount }}</p>
            <p><strong>Status:</strong> {{ ucfirst($booking->status) }}</p>
        </div>

        <!-- Buttons -->
        <div class="flex space-x-2">
            <!-- Delete Button -->
            <form action="{{ route('bookings.destroy', $booking) }}" method="POST" 
                  onsubmit="return confirm('Are you sure you want to delete this booking?');">
                @csrf
                @method('DELETE')
                <button type="submit" 
                        class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition">
                    Delete
                </button>
            </form>

            <!-- Manage Button (kept if needed) -->
            <a href="{{ route('bookings.index') }}" 
               class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition">
                Back to My Bookings
            </a>
        </div>
    </div>
</x-layouts.app>
