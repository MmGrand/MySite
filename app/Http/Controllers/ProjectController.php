<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Tag;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $breadcrumbs = [
            ['title' => 'Главная', 'href' => route('home')],
            ['title' => 'Проекты', 'href' => route('projects.index')]
        ];

        $tagSlug = $request->query('tag');
        $tags = Tag::all();

        if ($tagSlug) {
            $projects = Project::whereHas('tags', function ($query) use ($tagSlug) {
                $query->where('slug', $tagSlug);
            })->paginate(12);
        } else {
            $projects = Project::paginate(12);
        }

        return view('projects.index', compact('projects', 'breadcrumbs', 'tags', 'tagSlug'));
    }
}
