{{-- resources/views/destinations/show.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $destination->name }}</h1>
    <p>{{ $destination->description }}</p>
    <div class="row">
        @foreach($destination->images as $image)
            <div class="col-md-3">
                <img src="{{ asset('storage/' . $image->image_path) }}" class="img-fluid rounded mb-2">
            </div>
        @endforeach
    </div>
    <a href="{{ route('destinations.index') }}" class="btn btn-secondary">رجوع</a>
</div>
@endsection