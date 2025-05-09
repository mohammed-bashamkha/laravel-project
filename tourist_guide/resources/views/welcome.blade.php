@extends('layouts.app')

@section('content')
<div class="container py-5">

    {{-- العنوان --}}
    <div class="text-center mb-5">
        <h1 class="display-4 fw-bold text-primary">مرحبًا بك في الدليل السياحي 🌍</h1>
        <p class="lead text-muted">اكتشف أجمل الوجهات السياحية حول العالم وانطلق في مغامرتك!</p>
    </div>

    {{-- تحفيز التسجيل
    @guest
    <div class="alert alert-warning text-center">
        <strong>تنبيه:</strong> يجب <a href="{{ route('login') }}">تسجيل الدخول</a> أو <a href="{{ route('register') }}">إنشاء حساب</a> لتتمكن من استعراض الوجهات كاملة وإضافة المفضلة.
    </div>
    @endguest --}}

    {{-- عرض الوجهات --}}
    <h3 class="text-center mb-4">وجهات مختارة</h3>
    <div class="row">
        @foreach($destinations as $destination)
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm">
                    @if($destination->images->first())
                        <img src="{{ asset('storage/' . $destination->images->first()->image_path) }}" class="card-img-top" alt="صورة وجهة" style="height: 200px; object-fit: cover;">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $destination->name }}</h5>
                        <p class="card-text text-muted">{{ $destination->country }}</p>
                        <p class="card-text text-muted">{{ $destination->fragment }}</p>
                        <a href="{{ route('destinations.show', $destination->id) }}" class="btn btn-outline-primary btn-sm">عرض التفاصيل</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    {{-- زر تسجيل دخول أسفل الصفحة --}}
    @guest
    <div class="text-center mt-5">
        <a href="{{ route('login') }}" class="btn btn-primary btn-lg px-5">تسجيل الدخول</a>
        <a href="{{ route('register') }}" class="btn btn-outline-dark btn-lg px-5">إنشاء حساب</a>
    </div>
    @endguest
</div>
@endsection
