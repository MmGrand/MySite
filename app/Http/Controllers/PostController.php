<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $breadcrumbs = [
            ['title' => 'Главная', 'href' => route('home')],
            ['title' => 'Посты', 'href' => route('posts')]
        ];

        $posts = Post::all();

        return view('posts', compact('posts', 'breadcrumbs'));
    }
}
