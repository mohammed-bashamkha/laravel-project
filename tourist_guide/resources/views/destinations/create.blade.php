{{-- resources/views/destinations/create.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>إضافة وجهة جديدة</h1>
    <form action="{{ route('destinations.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">الاسم</label>
            <input type="text" class="form-control" name="name" id="name" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">الوصف</label>
            <textarea class="form-control" name="description" id="description" required></textarea>
        </div>
        <div class="mb-3">
            <label for="images" class="form-label">الصور</label>
            <input type="file" class="form-control" name="images[]" id="images" multiple>
        </div>
        <div class="mb-3">
            <label for="agencies" class="form-label">الوكالات المرتبطة</label>
            <select name="agencies[]" id="agencies" class="form-control" multiple>
                @foreach($agencies as $agency)
                    <option value="{{ $agency->id }}">{{ $agency->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-success">إضافة</button>
        <a href="{{ route('destinations.index') }}" class="btn btn-secondary">رجوع</a>
    </form>
</div>
@endsection