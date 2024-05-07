<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        $breadcrumbs = [
            ['title' => 'Главная', 'href' => route('home')],
            ['title' => 'Обо мне', 'href' => route('about')]
        ];

        return view('about', compact('breadcrumbs'));
    }
}
