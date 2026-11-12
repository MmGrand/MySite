<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', config('app.name', 'Laravel'))</title>
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    @vite('resources/js/app.js')
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
    <button id="scrollTopBtn" aria-label="{{ __('Наверх') }}" class="site-button fixed bottom-5 right-5 z-50 rounded-full !p-3 text-xl transition-opacity duration-300 opacity-0 hidden">
        <i class="fa fa-arrow-up" aria-hidden="true"></i>
    </button>

    @stack('js')
</body>
</html>
