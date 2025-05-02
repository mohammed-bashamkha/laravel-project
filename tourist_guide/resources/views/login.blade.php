<!DOCTYPE html>
<html>
    <link rel="stylesheet" href="{{ asset('css/register_login.css') }}">
<head>
    <title>تسجيل الدخول</title>
</head>
<body>
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <h2>تسجيل الدخول</h2>
        <input type="email" name="email" placeholder="البريد الإلكتروني" required>
        <input type="password" name="password" placeholder="كلمة المرور" required>
        <button type="submit">دخول</button>
        <p><a href="/register">مستخدم جديد؟ سجل الآن</a></p>
    </form>
</body>
</html>
