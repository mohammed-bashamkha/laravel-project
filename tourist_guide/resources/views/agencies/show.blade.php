{{-- resources/views/destinations/show.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $agencies->name }}</h1>
    <p><a href="{{ $agencies->url }}">{{ $agencies->url }}</a></p>
    <div class="row">
    </div>
    <a href="{{ route('agencies.index') }}" class="btn btn-secondary">رجوع</a>
</div>
@endsection