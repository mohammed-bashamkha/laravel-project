<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
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

    // فقط المشرف يستطيع الحذف
    if (Auth::user()->role === 'admin') {
        $comment->delete();
        return redirect()->back()->with('success', 'تم حذف التعليق');
    }

    abort(403);
}

}
