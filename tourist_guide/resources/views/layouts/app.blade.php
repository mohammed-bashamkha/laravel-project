<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>الدليل السياحي</title>

    {{-- Bootstrap RTL --}}
    <link href="{{ asset('css/bootstrap.rtl.min.css') }}" rel="stylesheet">

    {{-- Google Fonts - Cairo --}}
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;700&display=swap" rel="stylesheet">

    {{-- تنسيق عام --}}
    <style>
        body {
            font-family: 'Cairo', sans-serif;
            background-color: #f8f9fa;
        }

        .navbar-brand {
            font-weight: bold;
            font-size: 22px;
        }

        .nav-link {
            font-size: 16px;
        }

        footer {
            background-color: #343a40;
            color: white;
            padding: 15px 0;
            text-align: center;
        }

        .container {
            max-width: 1140px;
        }
    </style>
</head>
<body>

    {{-- Navbar --}}
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">🌍 الدليل السياحي</a>

            {{-- Navbar المخصص من الصفحة --}}
            @hasSection('custom-navbar')
                @yield('custom-navbar')
            @else
                {{-- Navbar الافتراضي --}}
                <div class="collapse navbar-collapse" id="mainNavbar">
                    <ul class="navbar-nav ms-auto">
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
            @endif
        </div>
    </nav>

    {{-- Flash Messages --}}
    <div class="container mt-3">
        @if (session('success'))
            <div class="alert alert-success text-center">{{ session('success') }}</div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger text-center">{{ session('error') }}</div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger text-center">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>

    {{-- المحتوى الرئيسي --}}
    <main class="container py-4">
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="mt-auto">
        <div class="container">
            <small>&copy; {{ date('Y') }} جميع الحقوق محفوظة - مشروع Laravel دليل سياحي</small>
        </div>
    </footer>

    {{-- Bootstrap JS --}}
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    @yield('scripts')


</body>
</html>
