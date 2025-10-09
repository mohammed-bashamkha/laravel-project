@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h1 class="text-center text-primary mb-4">إدارة التعليقات</h1>

    @if(session('success'))
        <div class="alert alert-success text-center">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered table-striped text-center align-middle">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>المستخدم</th>
                    <th>الوجهة</th>
                    <th>التعليق</th>
                    <th>التاريخ</th>
                    <th>حذف</th>
                </tr>
            </thead>
            <tbody>
                @forelse($comments as $comment)
                    <tr>
                        <td>{{ $loop->iteration + ($comments->currentPage() - 1) * $comments->perPage() }}</td>
                        <td>{{ $comment->user->name }}</td>
                        <td>{{ $comment->destination->name }}</td>
                        <td>{{ $comment->content }}</td>
                        <td>{{ $comment->created_at->diffForHumans() }}</td>
                        <td>
                            <form method="POST" action="{{ route('comments.destroy', $comment->id) }}" onsubmit="return confirm('هل تريد حذف هذا التعليق؟');">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">حذف</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6">لا توجد تعليقات حالياً.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- روابط التصفح --}}
    <div class="d-flex justify-content-center">
        {{ $comments->links() }}
    </div>
</div>
@endsection
