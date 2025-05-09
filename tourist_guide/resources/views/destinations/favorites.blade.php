@extends('layouts.app')

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

@section('content')
<div class="container py-5">
    <h2 class="mb-4 text-center">الوجهات المفضلة لديك ❤️</h2>

    <div class="row" id="favorites-container">
        @forelse($favorites as $destination)
            <div class="col-md-4 mb-4" id="fav-{{ $destination->id }}">
                <div class="card h-100 shadow-sm">
                    @if($destination->images->first())
                        <img src="{{ asset('storage/' . $destination->images->first()->image_path) }}" class="card-img-top" alt="صورة" style="height: 200px; object-fit: cover;">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $destination->name }}</h5>
                        <p class="card-text text-muted">{{ $destination->country }}</p>
                        <a href="{{ route('destinations.show', $destination->id) }}" class="btn btn-outline-primary btn-sm">عرض التفاصيل</a>
                        <button class="btn btn-danger btn-sm float-end remove-favorite" data-id="{{ $destination->id }}">🗑 إزالة</button>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-center text-muted">لا توجد وجهات مفضلة حتى الآن.</p>
        @endforelse
    </div>
</div>
@endsection

@section('scripts')
<script>
document.querySelectorAll('.remove-favorite').forEach(button => {
    button.addEventListener('click', function () {
        const id = this.dataset.id;

        fetch(`/favorites/remove/${id}`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            }
        }).then(res => res.json())
          .then(data => {
              document.getElementById('fav-' + id).remove();
          }).catch(error => alert('فشل الحذف من المفضلة'));
    });
});
</script>
@endsection
