{{-- @extends('layouts.app')
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
</div> --}}
{{-- resources/views/destinations/index.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">وكالات السفريات</h1>
    <a href="{{ route('agencies.create') }}" class="btn btn-success mb-3">إضافة وجهة جديدة</a>
    <div class="row">
        @foreach($agencies as $agency)
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title">{{ $agency->name }}</h5>
                        <p class="card-text">{{ $agency->url }}</p>
                        <a href="{{ route('agencies.show', $agency->id) }}" class="btn btn-primary">عرض التفاصيل</a>
                        <a href="{{ route('agencies.edit', $agency->id) }}" class="btn btn-warning">تعديل</a>
                        <form action="{{ route('agencies.destroy', $agency->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('هل أنت متأكد من الحذف؟')">حذف</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection


