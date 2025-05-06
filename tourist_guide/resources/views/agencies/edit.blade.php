{{-- resources/views/destinations/edit.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>تعديل وكالة سفريات</h1>
    <form action="{{ route('agencies.update', $agency->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">الاسم</label>
            <input type="text" class="form-control" name="name" id="name" value="{{ $agency->name }}" required>
        </div>
        <div class="mb-3">
            <label for="url" class="form-label">رابط صفحة الوكالة</label>
            <input type='url' class="form-control" name="url" id="url" value="{{$agency->url}}" required></ع>
        </div>
        </div>
        <button type="submit" class="btn btn-warning">تحديث</button>
        <a href="{{ route('agencies.index') }}" class="btn btn-secondary">رجوع</a>
    </form>
</div>
@endsection