<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $breadcrumbs = [
            ['title' => 'Главная', 'href' => route('home')],
            ['title' => 'Контакты', 'href' => route('contacts')]
        ];

        return view('contacts', compact('breadcrumbs'));
    }
}
