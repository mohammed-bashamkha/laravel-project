<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل حساب</title>

    {{-- Bootstrap RTL --}}
    <link href="{{ asset('css/bootstrap.rtl.min.css') }}" rel="stylesheet">

    {{-- Google Font - Cairo --}}
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

        .register-box {
            background: #ffffff;
            padding: 30px;
            border-radius: 10px;
            width: 100%;
            max-width: 450px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }

        .register-box h2 {
            margin-bottom: 25px;
            font-weight: 700;
            color: #198754;
        }

        .alert {
            font-size: 0.9rem;
        }
    </style>
</head>
<body>

<div class="register-box">
    <h2 class="text-center">تسجيل حساب جديد</h2>

    {{-- الرسائل --}}
    @if (session('success'))
        <div class="alert alert-success text-center">{{ session('success') }}</div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger text-center">
            {{ implode(', ', $errors->all()) }}
        </div>
    @endif

    {{-- النموذج --}}
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">الاسم الكامل</label>
            <input type="text" name="name" id="name" class="form-control" placeholder="أدخل اسمك الكامل" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">البريد الإلكتروني</label>
            <input type="email" name="email" id="email" class="form-control" placeholder="example@example.com" required>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">كلمة المرور</label>
            <input type="password" name="password" id="password" class="form-control" placeholder="********" required>
        </div>

        <div class="d-grid">
            <button type="submit" class="btn btn-success">تسجيل</button>
        </div>

        <div class="text-center mt-3">
            <p>لديك حساب؟ <a href="{{ route('login') }}">تسجيل الدخول</a></p>
        </div>
    </form>
</div>

{{-- Bootstrap JS --}}
<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
