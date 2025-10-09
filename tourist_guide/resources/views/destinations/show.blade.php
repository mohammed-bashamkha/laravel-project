@extends('layouts.app')

{{-- Navbar مخصص --}}
@section('custom-navbar')
    <div class="collapse navbar-collapse" id="mainNavbar">
        <ul class="navbar-nav ms-auto">
            @if (Auth::user()->role === 'superAdmin')
            <li class="nav-item">
                <a class="nav-link" href="{{ route('users.index') }}">المستخدمين</a>
            </li>
            @endif
            @if(auth()->user()->role === 'admin' or 'superAdmin')
                <li class="nav-item"><a class="nav-link" href="{{ route('admin.dashboard') }}">لوحة المشرف</a></li>
            @endif
            <li class="nav-item">
                <a class="nav-link" href="{{ route('destinations.index') }}">الوجهات</a>
            </li>
            @if (Auth::user()->role === 'superAdmin' and 'admin')
            <li class="nav-item">
                <a class="nav-link" href="{{ route('destinations.my_index') }}">وجهاتي</a>
            </li>
            @endif
            <li class="nav-item">
                <a class="nav-link" href="{{ route('agencies.index') }}">الوكالات</a>
            </li>
            @if (Auth::user()->role === 'superAdmin' and 'admin')
            <li class="nav-item">
                <a class="nav-link" href="{{ route('agencies.my_index') }}">وكالاتي</a>
            </li>
            @endif
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('destinations.favorites') }}">المفضلة ❤️</a>
                </li>
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
@endsection

{{-- محتوى الصفحة --}}
@section('content')
<div class="container py-4">

    {{-- عنوان الوجهة --}}
    <div class="text-center mb-4">
        <h1 class="display-5 text-primary">{{ $destination->name }}</h1>
        <hr class="w-25 mx-auto">
    </div>

    {{-- وصف الوجهة --}}
    <div class="mb-4 text-center">
        <p class="lead">{{ $destination->description }}</p>
    </div>

    {{-- متوسط التقييم --}}
    @if($destination->ratings->count())
        <div class="mb-3 text-center">
            <span class="text-warning fs-5">⭐</span>
            <strong>{{ number_format($destination->averageRating(), 1) }}</strong> من 5
        </div>
    @endif

    {{-- الوكالات المرتبطة --}}
    <div class="mb-5">
        <h5 class="mb-2">الوكالات المرتبطة:</h5>
        @if($destination->agencies->isEmpty())
            <p class="text-muted">لا توجد وكالات مرتبطة بهذه الوجهة.</p>
        @else
            <ul class="list-group">
                @foreach($destination->agencies as $agency)
                    <li class="list-group-item">
                        <a href="{{ $agency->url }}" target="_blank">{{ $agency->name }}</a>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>

    {{-- الصور --}}
    <div class="row mb-4">
        @foreach($destination->images as $image)
            <div class="col-md-3 col-sm-6 mb-3">
                <div class="card shadow-sm h-100">
                    <img src="{{ asset('storage/' . $image->image_path) }}" class="card-img-top rounded" alt="صورة" style="height: 200px; object-fit: cover;">
                </div>
            </div>
        @endforeach
    </div>

    {{-- زر المفضلة --}}
    @auth
    <div class="text-center mb-4">
        <button class="btn btn-outline-danger btn-sm add-favorite" data-id="{{ $destination->id }}">
            ❤️ إضافة إلى المفضلة
        </button>
    </div>
    @endauth

    {{-- نموذج التقييم --}}
    @auth
    <div class="card mb-4">
        <div class="card-body">
            <form method="POST" action="{{ route('ratings.store', $destination->id) }}">
                @csrf
                <div class="mb-3">
                    <label for="stars" class="form-label">قيم الوجهة:</label>
                    <select name="stars" id="stars" class="form-select" required>
                        <option value="">اختر التقييم</option>
                        @for($i = 1; $i <= 5; $i++)
                            <option value="{{ $i }}">{{ $i }} نجمة</option>
                        @endfor
                    </select>
                </div>
                <button type="submit" class="btn btn-warning">إرسال التقييم</button>
            </form>
        </div>
    </div>
    @endauth

    {{-- نموذج التعليق --}}
    @auth
    <div class="card mb-4">
        <div class="card-body">
            <form method="POST" action="{{ route('comments.store', $destination->id) }}">
                @csrf
                <div class="mb-3">
                    <label for="content" class="form-label">أضف تعليقك:</label>
                    <textarea name="content" id="content" rows="3" class="form-control" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">نشر التعليق</button>
            </form>
        </div>
    </div>
    @endauth

    {{-- التعليقات --}}
    @if($destination->comments->count())
    <div class="mb-5">
        <h5>التعليقات:</h5>
        <ul class="list-group">
            @foreach($destination->comments as $comment)
                <li class="list-group-item d-flex justify-content-between align-items-start">
                    <div>
                        <strong>{{ $comment->user->name }}</strong><br>
                        <small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small><br>
                        {{ $comment->content }}
                    </div>
                    @if(auth()->check() && auth()->user()->role === 'admin')
                        <form method="POST" action="{{ route('comments.destroy', $comment->id) }}">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">حذف</button>
                        </form>
                    @endif
                </li>
            @endforeach
        </ul>
    </div>
    @endif

    {{-- زر الرجوع --}}
    <div class="text-center">
        <a href="{{ route('destinations.index') }}" class="btn btn-outline-secondary">⬅ رجوع إلى جميع الوجهات</a>
    </div>

</div>
@endsection

{{-- سكربت المفضلة --}}
@section('scripts')
<script>
document.querySelectorAll('.add-favorite').forEach(button => {
    button.addEventListener('click', function () {
        const destinationId = this.dataset.id;
        const btn = this;

        fetch(`/favorites/add/${destinationId}`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            }
        })
        .then(res => res.json())
        .then(data => {
            btn.classList.remove('btn-outline-danger');
            btn.classList.add('btn-success');
            btn.innerHTML = '✅ تمت الإضافة';
            btn.disabled = true;
        })
        .catch(err => {
            alert('فشل في الإضافة إلى المفضلة');
            console.error(err);
        });
    });
});
</script>
@endsection
