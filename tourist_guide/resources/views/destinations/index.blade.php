{{-- resources/views/destinations/index.blade.php --}}
@extends('layouts.app')

@section('custom-navbar')
    <div class="collapse navbar-collapse" id="mainNavbar">
        <ul class="navbar-nav ms-auto">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('destinations.index') }}">الوجهات</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('destinations.my_index') }}">وجهاتي</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('agencies.index') }}">الوكالات</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('agencies.my_index') }}">وكالاتي</a>
            </li>
            @auth
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('destinations.favorites') }}">المفضلة ❤️</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown">
                        {{ auth()->user()->name }}
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="userDropdown">
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button class="dropdown-item" type="submit">تسجيل الخروج</button>
                            </form>
                        </li>
                    </ul>
                </li>
            @else
                <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">تسجيل الدخول</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">إنشاء حساب</a></li>
            @endauth
        </ul>
    </div>
@endsection

@if (session('success'))
    <h4 style="color: green">{{session('success')}}</h4>
    @endif

    @if ($errors->any())
    <h4 style="color: red">{{implode(',', $errors->all())}}</h4>
    @endif

@section('content')
<div class="container">
    <h1 class="mb-4">الوجهات السياحية</h1>
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
                        <p class="card-text">{{ $destination->fragment }}</p>
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


