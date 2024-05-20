<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Project;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index(Request $request)
    {
        $projects = Project::where('is_published', 1)->orderBy('created_at', 'desc')->take(6)->get();
        $posts = Post::where('is_published', 1)->orderBy('created_at', 'desc')->take(6)->get();

        return view('home', compact('projects', 'posts'));
    }
}
