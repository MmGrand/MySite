<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Project;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index()
    {
        $projects = Project::get()->take(6);
        $posts = Post::get()->take(6);

        return view('home', compact('projects', 'posts'));
    }
}
