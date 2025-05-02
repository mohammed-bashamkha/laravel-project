{{-- resources/views/destinations/show.blade.php
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $destination->name }}</h1>
    <p>{{ $destination->description }}</p>
    <div class="row">
        @foreach($destination->images as $image)
            <div class="col-md-3">
                <img  src="{{ asset('storage/' . $image->image_path) }}" class="img-fluid rounded mb-2">
            </div>
        @endforeach
    </div>
    <a href="{{ route('destinations.index') }}" class="btn btn-secondary">رجوع</a>
</div>
@endsection --}}

@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $destination->name }}</h1>
    <p>{{ $destination->description }}</p>

    {{-- عرض الوكالات المرتبطة --}}
    <h5 class="mt-4">الوكالات المرتبطة:</h5>
    @if($destination->agencies->isEmpty())
        <p>لا توجد وكالات مرتبطة بهذه الوجهة.</p>
    @else
        <ul>
            @foreach($destination->agencies as $agency)
                <li><a href="{{$agency->url}}">{{ $agency->name }}</a></li>
            @endforeach
        </ul>
    @endif

    {{-- عرض الصور --}}
    <div class="row mt-4">
        @foreach($destination->images as $image)
            <div class="col-md-3">
                <img src="{{ asset('storage/' . $image->image_path) }}" class="img-fluid rounded mb-2" alt="صورة">
            </div>
        @endforeach
    </div>

    <a href="{{ route('destinations.index') }}" class="btn btn-secondary mt-3">رجوع</a>
</div>
@endsection
