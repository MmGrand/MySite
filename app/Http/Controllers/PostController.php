<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $tagSlug = $request->query('tag');
        $categorySlug = $request->query('category');
        $tags = Tag::all();
        $categories = Category::all();

        $breadcrumbs = [
            ['title' => 'Главная', 'href' => route('home')],
            ['title' => 'Посты', 'href' => route('posts.index')],
        ];

        $posts = Post::query()->where('is_published', 1);

        if ($categorySlug) {
            $category = Category::where('slug', $categorySlug)->firstOrFail();
            $posts->where('category_id', $category->id);
        }

        if ($tagSlug) {
            $posts->whereHas('tags', function ($query) use ($tagSlug) {
                $query->where('slug', $tagSlug);
            });
        }

        $posts = $posts->orderBy('created_at', 'desc')->paginate(12);

        return view('posts.index', compact('posts', 'tags', 'categories', 'tagSlug', 'categorySlug', 'breadcrumbs'));
    }

    public function show($slug)
    {
        $post = Post::where('slug', $slug)->where('is_published', 1)->with('comments')->firstOrFail();
        $breadcrumbs = [
            ['title' => 'Главная', 'href' => route('home')],
            ['title' => 'Посты', 'href' => route('posts.index')],
            ['title' => $post->title, 'href' => route('posts.show', ['slug' => $slug])],
        ];

        $post->incrementViewsCount();

        $comments = $post->comments;

        return view('posts.show', compact('post', 'breadcrumbs', 'comments'));
    }
}
