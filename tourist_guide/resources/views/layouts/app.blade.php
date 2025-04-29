<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Travel Agency') }}</title>

    <!-- رابط ملف CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <!-- يمكنك إضافة خطوط عربية جميلة مثلا -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;700&display=swap" rel="stylesheet">
</head>

<body>

    <!-- رأس الصفحة -->
    <header style="background-color: #3498db; padding: 20px; text-align: center;">
        <h1 style="color: #fff;">دليل الوجهات السياحية</h1>
    </header>

    <!-- محتوى الصفحات -->
    <main class="container" style="margin-top: 30px;">
        @yield('content')
    </main>

    <!-- تذييل الصفحة -->
    <footer style="background-color: #f1f1f1; padding: 15px; text-align: center; margin-top: 50px;">
        جميع الحقوق محفوظة &copy; {{ date('Y') }}
    </footer>

</body>
</html>
