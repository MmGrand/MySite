<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'post_id' => 'required|exists:posts,id',
            'author' => 'required|string|max:50',
            'content' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:comments,id',
        ]);

        $comment = Comment::create($validated);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'comment' => $comment->load('children'),
            ]);
        }

        return redirect()->back()->with('success', __('Комментарий успешно добавлен!'));
    }
}
