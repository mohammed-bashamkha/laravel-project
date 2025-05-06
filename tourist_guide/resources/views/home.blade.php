<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>الصفحة الرئيسية</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            color: #333;
            direction: rtl;
        }
        header {
            background-color: #007bff;
            color: #fff;
            padding: 15px 0;
            text-align: center;
        }
        nav {
            background-color: #0056b3;
            padding: 10px;
            text-align: center;
        }
        nav a {
            color: #fff;
            text-decoration: none;
            margin: 0 15px;
            font-size: 18px;
        }
        nav a:hover {
            text-decoration: underline;
        }
        .container {
            padding: 20px;
            text-align: center;
        }
        footer {
            background-color: #007bff;
            color: #fff;
            text-align: center;
            padding: 10px 0;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>
<body>
    <header>
        <h1>مرحبًا بكم في دليل السياحة</h1>
    </header>
    <nav>
        <a href="#">الرئيسية</a>
        <a href="#">حول</a>
        <a href="#">الخدمات</a>
        <a href="#">اتصل بنا</a>
        <form action="{{route('logout')}}" method="POST">
            @csrf
            <button type="submit">تسجيل الخروج</button>
         </form>
    </nav>
    <div class="container">
        <h2>اكتشف أفضل الأماكن السياحية</h2>
        <p>نحن هنا لمساعدتك في العثور على أفضل الوجهات السياحية.</p>
    </div>
    <div>
        <h1 style="text-align: center">مرحبًا , {{Auth::check() ? Auth::user()->name : 'ضيف'}}</h1>
            <h3 style="text-align: center">تم تسجيل الدخول بنجاح</h3>
    </div>
    <footer>
        <p>جميع الحقوق محفوظة &copy; 2025</p>
    </footer>
</body>
</html>