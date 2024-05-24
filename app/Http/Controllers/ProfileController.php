<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        $comments = $user->comments()->with('post')->paginate(20);

        if (request()->ajax()) {
            return view('profile.comments', compact('comments'))->render();
        }

        return view('profile.show', compact('user', 'comments'));
    }

    public function updateAvatar(Request $request)
    {
        $request->validate([
            'avatar' => 'nullable|file|image|max:2048',
        ]);

        $user = Auth::user();
        if ($request->hasFile('avatar')) {
            $path = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = $path;
            $user->save();
        }

        return redirect()->back()->with('success', 'Фото профиля обновлено.');
    }
}
