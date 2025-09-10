<x-layouts.app title="Edit Event">
    <h1 class="text-3xl font-bold mb-6">Edit Event: {{ $event->title }}</h1>

    <form action="{{ route('events.update', $event) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('events._form', ['buttonText' => 'Update Event'])
    </form>
</x-layouts.app>
