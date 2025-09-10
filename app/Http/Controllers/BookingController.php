<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class BookingController extends Controller
{
    /**
     * Display the authenticated user's bookings.
     */
    public function index()
    {
        $bookings = auth()->user()
            ->bookings()
            ->with('event')
            ->latest()
            ->paginate(5);

        return view('bookings.index', compact('bookings'));
    }

    /**
     * Store a new booking.
     */
    public function store(Request $request, Event $event)
    {
        $request->validate([
            'tickets' => 'required|integer|min:1|max:' . $event->available_seats,
        ]);

        DB::transaction(function () use ($request, $event) {
            // Create booking
            Booking::create([
                'user_id' => auth()->id(),
                'event_id' => $event->id,
                'tickets' => $request->tickets,
                'total_amount' => $event->ticket_price * $request->tickets,
                'status' => 'pending',
            ]);

            // Reduce available seats
            // $event->decrement('available_seats', $request->tickets);
        });

        return redirect()->route('bookings.index')->with('success', 'Booking confirmed!');
    }
    public function show(Booking $booking)
    {

        return view('bookings.show', compact('booking'));
    }

    public function destroy(Booking $booking)
    {
        // qe vetem owneri booking te ket te drejte ta fshije ate 
        if ($booking->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        // Delete booking
        $booking->delete();

        return redirect()
            ->route('bookings.index')
            ->with('success', 'Booking deleted successfully.');
    }
}
