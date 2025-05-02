{{-- resources/views/destinations/edit.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>تعديل وجهة</h1>
    <form action="{{ route('destinations.update', $destination->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">الاسم</label>
            <input type="text" class="form-control" name="name" id="name" value="{{ $destination->name }}" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">الوصف</label>
            <textarea class="form-control" name="description" id="description" required>{{ $destination->description }}</textarea>
        </div>
        
        <div class="mb-3">
            <label for="agencies" class="form-label">الوكالات المرتبطة</label>
            <select name="agencies[]" id="agencies" class="form-control" multiple>
                @foreach($agencies as $agency)
                    <option value="{{ $agency->id }}">{{ $agency->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="images" class="form-label">إضافة صور جديدة</label>
            <input type="file" class="form-control" name="images[]" id="images" multiple>
        </div>
        <button type="submit" class="btn btn-warning">تحديث</button>
        <a href="{{ route('destinations.index') }}" class="btn btn-secondary">رجوع</a>
    </form>
</div>
@endsection