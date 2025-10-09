@extends('layouts.app')

@section('custom-navbar')
    <div class="collapse navbar-collapse" id="mainNavbar">
        <ul class="navbar-nav ms-auto">
            @if (Auth::user()->role === 'superAdmin')
            <li class="nav-item">
                <a class="nav-link" href="{{ route('users.index') }}">المستخدمين</a>
            </li>
            @endif
            @if(auth()->user()->role === 'admin' or 'superAdmin')
                <li class="nav-item"><a class="nav-link" href="{{ route('admin.dashboard') }}">لوحة المشرف</a></li>
            @endif
            <li class="nav-item">
                <a class="nav-link" href="{{ route('destinations.index') }}">الوجهات</a>
            </li>
            @if (Auth::user()->role === 'superAdmin' or 'admin')
            <li class="nav-item">
                <a class="nav-link" href="{{ route('destinations.my_index') }}">وجهاتي</a>
            </li>
            @endif
            <li class="nav-item">
                <a class="nav-link" href="{{ route('agencies.index') }}">الوكالات</a>
            </li>
            @if (Auth::user()->role === 'superAdmin' or 'admin')
            <li class="nav-item">
                <a class="nav-link" href="{{ route('agencies.my_index') }}">وكالاتي</a>
            </li>
            @endif
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('destinations.favorites') }}">المفضلة ❤️</a>
                </li>
            @auth
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="{{route('users.index')}}" role="button" data-bs-toggle="dropdown-menu">
                    {{ auth()->user()->name }}
                </a>
                <li class="nav-item">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="nav-link">تسجيل الخروج</button>
                    </form>
                </li>
            </li>
            @else
                <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">تسجيل الدخول</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">إنشاء حساب</a></li>
            @endauth
        </ul>
    </div>
@endsection

@section('content')
<div class="container">
    <h1 class="mb-4">وكالاتي</h1>
    <a href="{{ route('agencies.create') }}" class="btn btn-success mb-3">إضافة وكالة جديدة</a>
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