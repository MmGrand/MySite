<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $breadcrumbs = [
            ['title' => 'Главная', 'href' => route('home')],
            ['title' => 'Проекты', 'href' => route('projects')]
        ];

        $projects = Project::all();

        return view('projects', compact('projects', 'breadcrumbs'));
    }
}
