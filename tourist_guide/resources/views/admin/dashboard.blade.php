@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h1 class="mb-4 text-center text-primary">لوحة تحكم المشرف</h1>

    {{-- الإحصائيات --}}
    <div class="row g-3 mb-5">

        <div class="col-md-4">
            <div class="card border-start border-4 border-success shadow-sm">
                <div class="card-body text-center">
                    <h5 class="card-title text-success">عدد المستخدمين</h5>
                    <h2 class="fw-bold">{{ \App\Models\User::count() }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-start border-4 border-primary shadow-sm">
                <div class="card-body text-center">
                    <h5 class="card-title text-primary">عدد الوجهات</h5>
                    <h2 class="fw-bold">{{ \App\Models\Destination::count() }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-start border-4 border-dark shadow-sm">
                <div class="card-body text-center">
                    <h5 class="card-title text-dark">عدد الوكالات</h5>
                    <h2 class="fw-bold">{{ \App\Models\Agency::count() }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card border-start border-4 border-info shadow-sm">
                <div class="card-body text-center">
                    <h5 class="card-title text-info">عدد التعليقات</h5>
                    <h2 class="fw-bold">{{ \App\Models\Comment::count() }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card border-start border-4 border-warning shadow-sm">
                <div class="card-body text-center">
                    <h5 class="card-title text-warning">إجمالي التقييمات</h5>
                    <h2 class="fw-bold">{{ \App\Models\Rating::sum('stars') }}</h2>
                </div>
            </div>
        </div>

    </div>

    {{-- روابط الإدارة --}}
    <div class="row g-4">
        <div class="col-md-4">
            <div class="card bg-primary text-white shadow-sm">
                <div class="card-body text-center">
                    <h5 class="card-title">إدارة الوجهات</h5>
                    <a href="{{ route('destinations.index') }}" class="btn btn-light mt-2">عرض الوجهات</a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card bg-success text-white shadow-sm">
                <div class="card-body text-center">
                    <h5 class="card-title">إدارة المستخدمين</h5>
                    <a href="{{ route('users.index') }}" class="btn btn-light mt-2">عرض المستخدمين</a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card bg-dark text-white shadow-sm">
                <div class="card-body text-center">
                    <h5 class="card-title">إدارة الوكالات</h5>
                    <a href="{{ route('agencies.index') }}" class="btn btn-light mt-2">عرض الوكالات</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-danger text-white shadow-sm">
                <div class="card-body text-center">
                    <h5 class="card-title">إدارة التعليقات</h5>
                    <a href="{{ route('comments.index') }}" class="btn btn-light mt-2">عرض التعليقات</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
