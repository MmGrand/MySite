<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', config('app.name', 'Laravel'))</title>
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    @vite('resources/css/app.css')
    @vite('resources/css/alert.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/fontawesome.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css" />
    @stack('css')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body class="flex flex-col min-h-screen">
    @include('includes.header')
    <x-alert />
    <main class="flex-grow">
        @yield('content')
    </main>
    @include('includes.footer')
    <button id="scrollTopBtn" class="fixed bottom-4 right-4 z-50 bg-blue-500 hover:bg-blue-700 text-white text-2xl py-3 px-4 rounded-full shadow-lg transition-opacity duration-300 opacity-0 hidden">
        <i class="fa fa-arrow-up" aria-hidden="true"></i>
    </button>

    @vite('resources/js/menu.js')
    @vite('resources/js/app.js')
    @stack('js')
</body>
</html>
