<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'post_id' => 'required|exists:posts,id',
            'content' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:comments,id',
        ]);

        // Проверка на авторизованного пользователя
        if (!Auth::check()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $comment = new Comment();
        $comment->post_id = $validated['post_id'];
        $comment->author_id = Auth::id();
        $comment->content = $validated['content'];
        $comment->parent_id = $validated['parent_id'] ?? null;
        $comment->save();

        $comment->load('author'); // Загрузка отношения author

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'comment' => $comment,
            ]);
        }

        return redirect()->back()->with('success', __('Комментарий успешно добавлен!'));
    }
}
