{{-- resources/views/destinations/create.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>إضافة وكالة سفريات جديدة</h1>
    <form action="{{ route('agencies.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">الاسم</label>
            <input type="text" class="form-control" name="name" id="name" required>
        </div>
        <div class="mb-3">
            <label for="url" class="form-label">رابط صفحة الوكالة</label>
            <input type='url' class="form-control" name="url" id="url" required></ع>
        </div>
        <button type="submit" class="btn btn-success">إضافة</button>
        <a href="{{ route('agencies.index') }}" class="btn btn-secondary">رجوع</a>
    </form>
</div>
@endsection