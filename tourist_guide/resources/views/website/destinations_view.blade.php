<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>اكتشف أجمل الوجهات السياحية</title>

    <!-- Bootstrap RTL -->
    <link href="{{ asset('css/bootstrap.rtl.min.css') }}" rel="stylesheet">

    <!-- Google Fonts - Cairo (اختياري) -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Cairo', sans-serif;
            background-color: #f8f9fa;
        }

        .hero {
            background-image: url("image.jpeg");
            background-size: cover;
            background-position: center;
            height: 300px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-shadow: 0 0 10px rgba(0,0,0,0.7);
        }

        .card img {
            height: 200px;
            object-fit: cover;
        }
    </style>
</head>
<body>

    {{-- رسائل الجلسة --}}
    <div class="container mt-3">
        @if (session('success'))
            <div class="alert alert-success text-end">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger text-end">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>

    <!-- الغلاف -->
    <div class="hero">
        <h1 class="fw-bold display-5">اكتشف أجمل الوجهات السياحية</h1>
    </div>

    <!-- الوجهات -->
    <div class="container my-5">
        <div class="row justify-content-center text-end">
            @foreach($destinations as $destination)
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm rounded-4">
                        @if($destination->images->first())
                            <img src="{{ asset('storage/' . $destination->images->first()->image_path) }}" class="card-img-top rounded-top-4" alt="صورة وجهة">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $destination->name }}</h5>
                            <p class="text-muted">{{ $destination->country }}</p>
                            <p class="card-text">{{ $destination->fragment ?? Str::limit($destination->description, 100) }}</p>
                            <a href="{{ route('destinations.show', $destination->id) }}" class="btn btn-outline-primary btn-sm">اعرف المزيد</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
