@extends('layouts.main')

@section('title')
    Обо мне
@endsection

@section('content')
    <x-breadcrumbs :breadcrumbs="$breadcrumbs" />

    <x-content-wrapper class="bg-white">
        <div class="flex items-center justify-center flex-col text-center py-12">
            <img class="lg:w-2/6 md:w-3/6 w-5/6 mb-10 object-cover object-center rounded-full shadow-xl transform transition duration-500 hover:scale-110 hover:rotate-3"
                src="{{ asset('images/main_avatar.jpg') }}" alt="avatar">
            <div class="lg:w-2/3 w-full">
                <h1 class="title-font sm:text-4xl text-3xl mb-4 font-bold text-gray-900">
                    {{ __('Привет, я Максим 👋') }}</h1>
                <p class="mb-8 leading-relaxed text-gray-600 body-font">
                    {{ __('Я Fullstack разработчик. Началось всё с того, что в университете я не знал куда мне идти дальше, и я решил разрабатывать сайты. Изучал разные языки программирования, проходил курсы, но пока остановился на PHP и его фреймворке Laravel. Во Frontend направлении выбрал Vue JS. С 2022 года осени работаю, параллельно изучаю разные возможности разработки и прогрессирую с каждым днём.') }}
                </p>
            </div>
        </div>

        <hr class="my-12 border-gray-300">

        <h2 class="text-3xl font-bold text-center mb-4">{{ __('Мой стек разработки 🛠') }}</h2>
        <div class="flex flex-wrap justify-center gap-6 mt-5 bg-gradient-to-r from-gray-100 to-gray-200 shadow-lg rounded-lg p-6">
            @foreach ([
                ['icon' => 'fab fa-html5', 'color' => 'text-orange-600', 'name' => 'HTML5'],
                ['icon' => 'fab fa-css3-alt', 'color' => 'text-blue-600', 'name' => 'CSS3'],
                ['icon' => 'fab fa-laravel', 'color' => 'text-red-600', 'name' => 'Laravel'],
                ['icon' => 'fab fa-vuejs', 'color' => 'text-green-600', 'name' => 'Vue.js'],
                ['icon' => 'fab fa-docker', 'color' => 'text-blue-400', 'name' => 'Docker'],
                ['icon' => 'fas fa-database', 'color' => 'text-blue-700', 'name' => 'MySQL'],
                ['icon' => 'fab fa-git-alt', 'color' => 'text-orange-700', 'name' => 'Git']
            ] as $tech)
                <div class="text-center">
                    <i class="{{ $tech['icon'] }} text-5xl {{ $tech['color'] }} transition duration-500 transform hover:scale-110"></i>
                    <p class="mt-2 text-gray-600">{{ $tech['name'] }}</p>
                </div>
            @endforeach
        </div>

        <hr class="my-12 border-gray-300">

        <h2 class="text-3xl font-bold text-center mb-4">{{ __('Навыки') }}</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center mt-8">
            @foreach ([
                ['title' => 'Frontend', 'description' => 'HTML, CSS, JavaScript, Vue.js', 'color' => 'text-blue-600'],
                ['title' => 'Backend', 'description' => 'PHP, Laravel', 'color' => 'text-green-600'],
                ['title' => 'Инструменты', 'description' => 'Docker, Git, MySQL', 'color' => 'text-red-600']
            ] as $skill)
                <div class="bg-gradient-to-br from-gray-100 to-gray-200 shadow-lg rounded-lg p-6 transform transition duration-500 hover:scale-105 hover:bg-gradient-to-tr hover:from-gray-200 hover:to-gray-300">
                    <h3 class="text-xl font-semibold mb-2 {{ $skill['color'] }}">{{ __($skill['title']) }}</h3>
                    <p class="text-gray-600">{{ __($skill['description']) }}</p>
                </div>
            @endforeach
        </div>

        <hr class="my-12 border-gray-300">

        <h2 class="text-3xl font-bold text-center mb-4">{{ __('Опыт работы') }}</h2>
        <div class="bg-gradient-to-r from-white via-gray-100 to-white shadow-lg rounded-lg p-6 mt-4 transform transition duration-500 hover:scale-105 hover:bg-gradient-to-br">
            <p class="mb-4 text-gray-700">
                {{ __('Мой опыт работы состоит из того, что я в основном работаю с самописным фреймворком на PHP. Большинство времени взаимодействовал с проектом SPA. На Vue js разрабатывал frontend. Там работал с роутингом, хранилищем, подключением других библиотек для удобства, созданием различных страниц и даже подключением SEO. На Backend работал с rest API, платежными системами, разработкой функционала сайта и другими вещами.') }}
            </p>
            <p class="mb-2 text-gray-700">
                {{ __('Параллельно работе изучаю другие возможности разработки, например, Laravel. В моём github присутствуют проекты, где я учился и создавал различные сайты. Также там есть сайт, сделанный только на Vue js с использованием данных, полученных по API.') }}
            </p>
        </div>

        <hr class="my-12 border-gray-300">

        <h2 class="text-3xl font-bold text-center mb-4">{{ __('Социальные сети') }}</h2>
        <div class="flex justify-center space-x-6 bg-gradient-to-r from-white via-gray-100 to-white shadow-lg rounded-lg p-6 mt-4">
            <a href="https://barnaul.hh.ru/resume/e74029faff086439720039ed1f654645784e38" target="_blank"
                class="text-red-500 hover:text-red-700 transform hover:scale-110 transition-transform duration-300">
                <img src="{{ asset('images/min-hh-red.png') }}" alt="HeadHunter" class="w-9 h-9">
            </a>
            <a href="https://github.com/MmGrand" target="_blank" class="text-gray-800 hover:text-gray-900 transform hover:scale-110 transition-transform duration-300">
                <i class="fab fa-github text-4xl"></i>
            </a>
            <a href="https://instagram.com/__mmgrand__" target="_blank" class="text-pink-500 hover:text-pink-700 transform hover:scale-110 transition-transform duration-300">
                <i class="fab fa-instagram text-4xl"></i>
            </a>
        </div>

        <hr class="my-12 border-gray-300">

        <h2 class="text-3xl font-bold text-center mb-4">{{ __('Контактная информация') }}</h2>
        <div class="bg-gradient-to-r from-white via-gray-100 to-white shadow-lg rounded-lg p-6 mt-8 text-center transform transition duration-500 hover:scale-105">
            <p class="text-gray-700 mb-4">
                {{ __('Вы можете связаться со мной через') }}
                <a href="{{ route('contacts') }}" class="text-blue-500 hover:underline">
                    {{ __('контактную страницу') }}
                </a>.
            </p>
        </div>
    </x-content-wrapper>

@endsection
