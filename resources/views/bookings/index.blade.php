<x-layouts.app>
    <h1 class="text-2xl font-bold mb-6">My Bookings</h1>
@forelse($bookings as $booking)
    <div class="bg-white p-4 rounded-lg shadow mb-4 flex justify-between items-center">
        <!-- Left side: Booking details -->
        <div>
            <p><strong>Event:</strong> {{ $booking->event->title }}</p>
            <p><strong>Tickets:</strong> {{ $booking->tickets }}</p>
            <p><strong>Total:</strong> ${{ $booking->total_amount }}</p>
            <p><strong>Status:</strong> {{ ucfirst($booking->status) }}</p>
        </div>

        <!-- Right side: Buttons (PayPal + Manage) -->
        <div class="flex gap-2 items-center">
            <!-- PayPal button -->
            <form action="{{ route('paypal.pay') }}" method="POST">
                @csrf
                <input type="hidden" name="booking_id" value="{{ $booking->id }}">
                <button type="submit" class="paypal-btn-md">
                    <img src="https://www.paypalobjects.com/webstatic/mktg/logo/pp_cc_mark_111x69.jpg" 
                         alt="PayPal" class="paypal-logo-md">
                    Pay
                </button>
            </form>

            <!-- Manage button -->
            <a href="{{ route('bookings.show', $booking) }}" 
               class="manage-btn-md">
                Manage
            </a>
        </div>
    </div>
@empty
    <p>You have no bookings yet.</p>
@endforelse

<style>
/* PayPal button medium size */
.paypal-btn-md {
    background-color: #ffc439;
    color: #003087;
    font-weight: bold;
    padding: 8px 18px; /* medium padding */
    border: none;
    border-radius: 5px;
    display: inline-flex;
    align-items: center;
    cursor: pointer;
    font-size: 15px;
}

.paypal-btn-md:hover {
    background-color: #ffb347;
}

.paypal-logo-md {
    height: 20px; /* medium logo */
    margin-right: 8px;
}

/* Manage button medium size */
.manage-btn-md {
    background-color: #3b82f6; /* blue-500 */
    color: #fff;
    padding: 8px 18px;
    border-radius: 5px;
    font-size: 15px;
    display: inline-flex;
    align-items: center;
    text-decoration: none;
}

.manage-btn-md:hover {
    background-color: #2563eb; /* blue-600 */
}
</style>



    {{ $bookings->links() }}
</x-layouts.app>
