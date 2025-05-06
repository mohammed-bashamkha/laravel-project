<!DOCTYPE html>
<html lang="ar" dir="rtl">
    <link rel="stylesheet" href="{{ asset('css/register_login.css') }}">
<head>
    <title>تسجيل حساب</title>
    @if (session('success'))
    <h4 style="color: green">{{session('success')}}</h4>
    @endif

    @if ($errors->any())
    <h4 style="color: red">{{implode(',', $errors->all())}}</h4>
    @endif
</head>
<body>
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <h2>تسجيل حساب</h2>
        <input type="text" name="name" placeholder="الاسم الكامل" required>
        <input type="email" name="email" placeholder="البريد الإلكتروني" required>
        <input type="password" name="password" placeholder="كلمة المرور" required>
        <button type="submit">تسجيل</button>
        <p><a href="/login">لديك حساب؟ تسجيل الدخول</a></p>
    </form>
</body>
</html>
