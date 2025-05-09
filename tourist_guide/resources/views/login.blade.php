<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل الدخول</title>

    {{-- Bootstrap RTL --}}
    <link href="{{ asset('css/bootstrap.rtl.min.css') }}" rel="stylesheet">

    {{-- Google Font --}}
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@500;700&display=swap" rel="stylesheet">

    {{-- تنسيق مخصص --}}
    <style>
        body {
            font-family: 'Cairo', sans-serif;
            background: #f1f3f5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-box {
            background: #ffffff;
            padding: 30px;
            border-radius: 10px;
            width: 100%;
            max-width: 400px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }

        .login-box h2 {
            margin-bottom: 25px;
            font-weight: 700;
            color: #0d6efd;
        }

        .form-control:focus {
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
        }

        .alert {
            font-size: 0.9rem;
        }
    </style>
</head>
<body>

<div class="login-box">
    <h2 class="text-center">تسجيل الدخول</h2>

    {{-- تنبيهات --}}
    @if (session('success'))
        <div class="alert alert-success text-center">{{ session('success') }}</div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger text-center">
            {{ implode(', ', $errors->all()) }}
        </div>
    @endif

    {{-- النموذج --}}
    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="mb-3">
            <label for="email" class="form-label">البريد الإلكتروني</label>
            <input type="email" class="form-control" name="email" id="email" placeholder="example@example.com" required>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">كلمة المرور</label>
            <input type="password" class="form-control" name="password" id="password" placeholder="********" required>
        </div>

        <div class="d-grid">
            <button type="submit" class="btn btn-primary">دخول</button>
        </div>

        <div class="text-center mt-3">
            <p>ليس لديك حساب؟ <a href="{{ route('register') }}">سجل الآن</a></p>
        </div>
    </form>
</div>

{{-- Bootstrap JS (اختياري) --}}
<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
