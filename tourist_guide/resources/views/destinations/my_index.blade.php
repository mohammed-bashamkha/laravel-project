{{-- resources/views/destinations/index.blade.php --}}
@extends('layouts.app')

@if (session('success'))
    <h4 style="color: green">{{session('success')}}</h4>
    @endif

    @if ($errors->any())
    <h4 style="color: red">{{implode(',', $errors->all())}}</h4>
    @endif

@section('content')
<div class="container">
    <h1 class="mb-4">وجهاتي</h1>
    <a href="{{ route('destinations.create') }}" class="btn btn-success mb-3">إضافة وجهة جديدة</a>
    <div class="row">
        @foreach($destinations as $destination)
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    @if($destination->images->first())
                        <img src="{{ asset('storage/' . $destination->images->first()->image_path) }}" class="card-img-top" alt="صورة وجهة" width="200" height="200">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $destination->name }}</h5>
                        <p class="card-text">{{ $destination->description }}</p>
                        <a href="{{ route('destinations.show', $destination->id) }}" class="btn btn-primary">عرض التفاصيل</a>
                        <a href="{{ route('destinations.edit', $destination->id) }}" class="btn btn-warning">تعديل</a>
                        <form action="{{ route('destinations.destroy', $destination->id) }}" method="POST" style="display:inline-block;">
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
