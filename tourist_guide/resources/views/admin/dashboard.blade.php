@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h1 class="mb-4 text-center text-primary">لوحة تحكم المشرف</h1>

    {{-- الإحصائيات --}}
    <div class="row g-3 mb-5">
        <div class="col-md-4">
            <div class="card text-bg-success shadow-sm">
                <div class="card-body text-center">
                    <h5 class="card-title">عدد المستخدمين</h5>
                    <h2>{{ \App\Models\User::count() }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-bg-primary shadow-sm">
                <div class="card-body text-center">
                    <h5 class="card-title">عدد الوجهات</h5>
                    <h2>{{ \App\Models\Destination::count() }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-bg-dark shadow-sm">
                <div class="card-body text-center">
                    <h5 class="card-title">عدد الوكالات</h5>
                    <h2>{{ \App\Models\Agency::count() }}</h2>
                </div>
            </div>
        </div>
    </div>

    {{-- روابط الإدارة --}}
    <div class="row g-4">
        <div class="col-md-4">
            <div class="card text-bg-primary shadow-sm">
                <div class="card-body text-center">
                    <h5 class="card-title">إدارة الوجهات</h5>
                    <a href="{{ route('destinations.index') }}" class="btn btn-light mt-2">عرض الوجهات</a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-bg-success shadow-sm">
                <div class="card-body text-center">
                    <h5 class="card-title">إدارة المستخدمين</h5>
                    <a href="{{ route('users.index') }}" class="btn btn-light mt-2">عرض المستخدمين</a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-bg-dark shadow-sm">
                <div class="card-body text-center">
                    <h5 class="card-title">إدارة الوكالات</h5>
                    <a href="{{ route('agencies.index') }}" class="btn btn-light mt-2">عرض الوكالات</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
