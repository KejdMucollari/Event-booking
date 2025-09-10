<!-- Card Layout -->
<div class="bg-white rounded-2xl shadow-lg p-6 space-y-4">

    <!-- Title -->
    <div>
        <label for="title" class="block font-medium text-gray-700">Event Title</label>
        <input type="text" name="title" id="title"
               value="{{ old('title', $event->title ?? '') }}"
               class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200"
               placeholder="Enter event title">
        @error('title')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Description -->
    <div>
        <label for="description" class="block font-medium text-gray-700">Description</label>
        <textarea name="description" id="description"
                  class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200"
                  rows="4"
                  placeholder="Describe the event">{{ old('description', $event->description ?? '') }}</textarea>
        @error('description')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Date & Time -->
    <div>
        <label for="starts_at" class="block font-medium text-gray-700">Event Date & Time</label>
        <input type="datetime-local" name="starts_at" id="starts_at"
               value="{{ old('starts_at', isset($event) ? $event->starts_at->format('Y-m-d\TH:i') : '') }}"
               class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
        @error('starts_at')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Location -->
    <div>
        <label for="location" class="block font-medium text-gray-700">Location</label>
        <input type="text" name="location" id="location"
               value="{{ old('location', $event->location ?? '') }}"
               class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200"
               placeholder="Enter event location">
        @error('location')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Ticket Price -->
    <div>
        <label for="ticket_price" class="block font-medium text-gray-700">Ticket Price ($)</label>
        <input type="number" name="ticket_price" id="ticket_price" step="0.01"
               value="{{ old('ticket_price', $event->ticket_price ?? '') }}"
               class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200"
               placeholder="Enter ticket price">
        @error('ticket_price')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Available Seats -->
    <div>
        <label for="available_seats" class="block font-medium text-gray-700">Available Seats</label>
        <input type="number" name="available_seats" id="available_seats"
               value="{{ old('available_seats', $event->available_seats ?? '') }}"
               class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200"
               placeholder="Enter number of seats">
        @error('available_seats')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Event Image (optional) -->
    <div>
        <label for="image" class="block font-medium text-gray-700">Event Image</label>
        <input type="file" name="image" id="image"
               class="mt-1 block w-full text-gray-700">
        @error('image')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Submit Button -->
    <div class="pt-4">
        <button type="submit"
                class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600 shadow transition">
            {{ $buttonText ?? 'Create Event' }}
        </button>
    </div>

</div>
