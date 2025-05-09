@extends('layouts.app')

{{-- Navbar مخصص لهذه الصفحة --}}
@section('custom-navbar')
    <div class="collapse navbar-collapse" id="mainNavbar">
        <ul class="navbar-nav ms-auto">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('destinations.index') }}">الوجهات</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('destinations.my_index') }}">وجهاتي</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('agencies.index') }}">الوكالات</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('agencies.my_index') }}">وكالاتي</a>
            </li>
            @auth
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('destinations.favorites') }}">المفضلة ❤️</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown">
                        {{ auth()->user()->name }}
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="userDropdown">
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button class="dropdown-item" type="submit">تسجيل الخروج</button>
                            </form>
                        </li>
                    </ul>
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
    <div class="mb-5 text-center">
        <p class="lead">{{ $destination->description }}</p>
    </div>

    {{-- الوكالات المرتبطة --}}
    <div class="mb-5">
        <h4 class="mb-3">الوكالات المرتبطة:</h4>
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

    {{-- زر إضافة إلى المفضلة --}}
    @auth
        <div class="text-center mb-4">
            <button class="btn btn-outline-danger btn-sm add-favorite" data-id="{{ $destination->id }}">
                ❤️ إضافة إلى المفضلة
            </button>
        </div>
    @endauth

    {{-- زر الرجوع --}}
    <div class="text-center">
        <a href="{{ route('destinations.index') }}" class="btn btn-outline-secondary">⬅ رجوع إلى جميع الوجهات</a>
    </div>
</div>
@endsection

{{-- سكربت Ajax --}}
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
