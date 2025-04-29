@extends('layouts.app')
<div class="container">
    <h1 class="text-center">الوجهات السياحية</h1>

    <div class="grid">
        @foreach ($destinations as $destination)
            <div class="card">
                @if($destination->images->count() > 0)
                    <img src="{{ asset('storage/' . $destination->images[0]->image_path) }}" alt="{{ $destination->name }}">
                @else
                    <img src="{{ asset('no-image.png') }}" alt="No Image">
                @endif
                <div class="content">
                    <h2>{{ $destination->name }}</h2>
                    <a href="{{ route('destinations', $destination->id) }}" class="button">عرض التفاصيل</a>
                </div>
            </div>
        @endforeach
    </div>
</div>
