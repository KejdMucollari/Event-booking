<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Gate;




class EventController extends Controller
{
    //so only loged in users can acces
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }


    /**
     * Display a listing of the resource.
     */
    public function index(Event $event)
    {
        $events = Event::latest()->paginate(3);

        if (auth()->check()) {
            $user = auth()->user();
            if ($user->hasRole('organizer')) {
                return view('organizer.index', compact('events')); // <-- new organizer view
            }
        }
        return view('events.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('events.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'starts_at' => 'required|date',
            'location' => 'required|string|max:255',
            'ticket_price' => 'required|numeric|min:0',
            'available_seats' => 'required|integer|min:1',   //why numeric and integer 
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('events', 'public');
        }

        $validated['user_id'] = auth()->id();

        Event::create($validated);

        return redirect()->route('events.index')->with('sucess', 'Event created sucessfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        return view('events.show', compact('event'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        if (Gate::denies('update', $event)) {
            abort(403, 'Unauthorized action.');
        }

        if ($event->user_id !== auth()->id() && !auth()->user()->hasRole('admin')) {
            abort(403);
        }
        return view('events.edit', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event)
    {

        if (Gate::denies('update', $event)) {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'starts_at' => 'required|date',
            'location' => 'required|string|max:255',
            'ticket_price' => 'required|numeric|min:0',
            'available_seats' => 'required|integer|min:1',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('events', 'public');
        }

        $event->update($validated);

        return redirect()->route('events.index')->with('success', 'Event updated successfully!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        if (Gate::denies('delete', $event)) {
            abort(403, 'Unauthorized action.');
        }

        $event->delete();

        return redirect()->route('events.index')
            ->with('success', 'Event deleted successfully!');
    }


    //organiser dashboard 
    public function myEvents()
    {
        $events = Event::where('user_id', auth()->id())->get();

        return view('organizer.events', compact('events'));
    }
}
