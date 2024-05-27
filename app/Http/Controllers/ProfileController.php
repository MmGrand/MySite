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
            'avatar' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $user = Auth::user();
        if ($request->hasFile('avatar')) {
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = $avatarPath;
            $user->save();

            return back()->with('success', 'Аватар успешно обновлен.');
        }

        return back()->withErrors(['avatar' => 'Пожалуйста, выберите допустимое изображение.']);
    }
}
