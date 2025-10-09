@extends('layouts.app')

@section('custom-navbar')
    <div class="collapse navbar-collapse" id="mainNavbar">
        <ul class="navbar-nav ms-auto">
            @if (Auth::user()->role === 'superAdmin')
            <li class="nav-item">
                <a class="nav-link" href="{{ route('users.index') }}">المستخدمين</a>
            </li>
            @endif
            @if(auth()->user()->role === 'admin' and 'superAdmin')
                <li class="nav-item"><a class="nav-link" href="{{ route('admin.dashboard') }}">لوحة المشرف</a></li>
            @endif
            <li class="nav-item">
                <a class="nav-link" href="{{ route('destinations.index') }}">الوجهات</a>
            </li>
            @if (Auth::user()->role === 'superAdmin' and 'admin')
            <li class="nav-item">
                <a class="nav-link" href="{{ route('destinations.my_index') }}">وجهاتي</a>
            </li>
            @endif
            <li class="nav-item">
                <a class="nav-link" href="{{ route('agencies.index') }}">الوكالات</a>
            </li>
            @if (Auth::user()->role === 'superAdmin' and 'admin')
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
    <h1>المستخدمين</h1>
    {{-- <a href="{{ route('users.index') }}" class="btn btn-success mb-3">إضافة مستخدم</a> --}}

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>الاسم</th>
                <th>البريد الإلكتروني</th>
                <th>الدور</th>
                <th>إجراءات</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->role }}</td>
                <td>
                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning btn-sm">تعديل</a>
                </td>
            </tr>
            <tr>
                <td>
                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('هل أنت متأكد من الحذف؟')">حذف</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
