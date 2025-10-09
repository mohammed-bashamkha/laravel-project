<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function index()
{
    $comments = Comment::with('user', 'destination')->latest()->paginate(10);
    return view('admin.comments.index', compact('comments'));
}

    public function store(Request $request, $destination_id)
{
    $request->validate([
        'content' => 'required|string|max:1000',
    ]);

    Comment::create([
        'user_id' => Auth::user()->id,
        'destination_id' => $destination_id,
        'content' => $request->content,
    ]);

    return redirect()->back()->with('success', 'تم إضافة التعليق بنجاح');
}

public function destroy($id)
{
    $comment = Comment::findOrFail($id);
    if (Auth::user()->role === 'admin' and 'superAdmin') {
        $comment->delete();
        return redirect()->back()->with('success', 'تم حذف التعليق');
    }

    abort(403);
}

}
