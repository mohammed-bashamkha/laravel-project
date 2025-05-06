<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>الدليل السياحي</title>

    {{-- Bootstrap CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css" rel="stylesheet" integrity="sha384-ENjdO4Dr2bkBIFxQpeo7F9gU3c1uTOnxM3zv3Z4pFNez3URy9Bv1WTRiQZ5n3M5Q" crossorigin="anonymous">

    {{-- خط عربي (اختياري) --}}
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;700&display=swap" rel="stylesheet">

    {{-- ملف CSS مخصص --}}
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <style>
        body {
            font-family: 'Cairo', sans-serif;
            background-color: #f4f4f4;
        }
        .navbar {
            margin-bottom: 30px;
        }
    </style>
</head>
<body>

    {{-- شريط التنقل --}}
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">الرئيسية</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navMenu">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('destinations.index') }}">الوجهات</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('destinations.my_index') }}">وجهاتي</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('agencies.index') }}">وكالات السفر</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('agencies.my_index') }}">وكالاتي</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    {{-- محتوى الصفحة --}}
    <main class="py-4">
        @yield('content')
    </main>

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+4+nqPzF6nXSKk63CnP5t4ZOkvfY/" crossorigin="anonymous"></script>

</body>
</html>
