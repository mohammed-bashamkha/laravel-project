<!DOCTYPE html>
<html>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(to right, #6dd5fa, #2980b9);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            direction: rtl;
        }
        .form-container {
            background: white;
            padding: 30px;
            border-radius: 15px;
            width: 100%;
            max-width: 350px;
            box-shadow: 0 0 15px rgba(0,0,0,0.2);
        }
        h2 {
            text-align: center;
            color: #2980b9;
        }
        input, button {
            width: 100%;
            padding: 12px;
            margin-top: 10px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 15px;
        }
        button {
            background-color: #2980b9;
            color: white;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background-color: #1c5f8a;
        }
        a {
            display: block;
            text-align: center;
            margin-top: 15px;
            color: #2980b9;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
<head>
    <title>تسجيل حساب</title>
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
