<x-layouts.app title="Create Event">
    <h1 class="text-3xl font-bold mb-6">Create New Event</h1>

    <form action="{{ route('events.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @include('events._form', ['buttonText' => 'Create Event'])
    </form>
</x-layouts.app>
