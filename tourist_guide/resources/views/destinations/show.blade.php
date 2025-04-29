<div class="container">
    <h1>{{ $destination->name }}</h1>

    <div class="destination-details">
        @foreach ($destination->images as $image)
            <img src="{{ asset('storage/' . $image->image_path) }}" alt="Destination Image">
        @endforeach
    </div>

    <p>{{ $destination->description }}</p>

    <h2>اختر وكالة سفر:</h2>
    @foreach ($destination->agencies as $agency)
        <a href="{{ $agency->link }}" target="_blank" class="agency-link">{{ $agency->name }}</a>
    @endforeach
</div>
