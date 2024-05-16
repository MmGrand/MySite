@extends('layouts.main')

@section('title')
    Обо мне
@endsection

@section('content')
    <x-breadcrumbs :breadcrumbs="$breadcrumbs" />

    <x-content-wrapper class="bg-white">
        <div class="flex items-center justify-center flex-col">
            <img class="lg:w-2/6 md:w-3/6 w-5/6 mb-10 object-cover object-center rounded-full shadow-lg"
                src="{{ asset('images/main_avatar.jpg') }}" alt="avatar">
            <div class="text-center lg:w-2/3 w-full">
                <h1 class="title-font sm:text-4xl text-3xl mb-4 font-medium text-gray-900">
                    {{ __('Привет, я Максим 👋') }}</h1>
                <p class="mb-8 leading-relaxed text-gray-600 body-font">
                    {{ __('Я Fullstack разработчик. Началось всё с того, что в университете я не знал куда мне идти дальше, и я решил разрабатывать сайты. Изучал разные языки программирования, проходил курсы, но пока остановился на PHP и его фреймворке Laravel. Во Frontend направлении выбрал Vue JS. С 2022 года осени работаю, параллельно изучаю разные возможности разработки и прогрессирую с каждым днём.') }}
                </p>
            </div>
        </div>

        <hr class="my-12 border-gray-300">

        <h2 class="text-3xl font-bold text-center mb-4">{{ __('Мой стек разработки 🛠') }}</h2>
        <div class="flex flex-wrap justify-center gap-6 mt-5 bg-white shadow-lg rounded-lg p-6">
            <div class="text-center">
                <i class="fab fa-html5 text-5xl text-orange-600"></i>
                <p class="mt-2 text-gray-600">HTML5</p>
            </div>
            <div class="text-center">
                <i class="fab fa-css3-alt text-5xl text-blue-600"></i>
                <p class="mt-2 text-gray-600">CSS3</p>
            </div>
            <div class="text-center">
                <i class="fab fa-laravel text-5xl text-red-600"></i>
                <p class="mt-2 text-gray-600">Laravel</p>
            </div>
            <div class="text-center">
                <i class="fab fa-vuejs text-5xl text-green-600"></i>
                <p class="mt-2 text-gray-600">Vue.js</p>
            </div>
            <div class="text-center">
                <i class="fab fa-docker text-5xl text-blue-400"></i>
                <p class="mt-2 text-gray-600">Docker</p>
            </div>
            <div class="text-center">
                <i class="fas fa-database text-5xl text-blue-700"></i>
                <p class="mt-2 text-gray-600">MySQL</p>
            </div>
            <div class="text-center">
                <i class="fab fa-git-alt text-5xl text-orange-700"></i>
                <p class="mt-2 text-gray-600">Git</p>
            </div>
        </div>

        <hr class="my-12 border-gray-300">

        <h2 class="text-3xl font-bold text-center mb-4">{{ __('Навыки') }}</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center mt-8">
            <div class="bg-white shadow-lg rounded-lg p-6">
                <h3 class="text-xl font-semibold mb-2 text-blue-600">{{ __('Frontend') }}</h3>
                <p class="text-gray-600">{{ __('HTML, CSS, JavaScript, Vue.js') }}</p>
            </div>
            <div class="bg-white shadow-lg rounded-lg p-6">
                <h3 class="text-xl font-semibold mb-2 text-blue-600">{{ __('Backend') }}</h3>
                <p class="text-gray-600">{{ __('PHP, Laravel') }}</p>
            </div>
            <div class="bg-white shadow-lg rounded-lg p-6">
                <h3 class="text-xl font-semibold mb-2 text-blue-600">{{ __('Инструменты') }}</h3>
                <p class="text-gray-600">{{ __('Docker, Git, MySQL') }}</p>
            </div>
        </div>

        <hr class="my-12 border-gray-300">

        <h2 class="text-3xl font-bold text-center mb-4">{{ __('Опыт работы') }}</h2>
        <div class="bg-white shadow-lg rounded-lg p-6 mt-4">
            <p class="mb-4 text-gray-700">
                {{ __('Мой опыт работы состоит из того, что я в основном работаю с самописным фреймворком на PHP. Большинство времени взаимодействовал с проектом SPA. На Vue js разрабатывал frontend. Там работал с роутингом, хранилищем, подключением других библиотек для удобства, созданием различных страниц и даже подключением SEO. На Backend работал с rest API, платежными системами, разработкой функционала сайта и другими вещами.') }}
            </p>
            <p class="mb-2 text-gray-700">
                {{ __('Параллельно работе изучаю другие возможности разработки, например, Laravel. В моём github присутствуют проекты, где я учился и создавал различные сайты. Также там есть сайт, сделанный только на Vue js с использованием данных, полученных по API.') }}
            </p>
        </div>

        <hr class="my-12 border-gray-300">

        <h2 class="text-3xl font-bold text-center mb-4">{{ __('Социальные сети') }}</h2>
        <div class="flex justify-center space-x-6 bg-white shadow-lg rounded-lg p-6 mt-4">
            <a href="https://barnaul.hh.ru/resume/e74029faff086439720039ed1f654645784e38" target="_blank"
                class="text-red-500 hover:text-red-700">
                <img src="{{ asset('images/min-hh-red.png') }}" alt="HeadHunter" class="w-9 h-9">
            </a>
            <a href="https://github.com/MmGrand" target="_blank" class="text-gray-800 hover:text-gray-900">
                <i class="fab fa-github text-4xl"></i>
            </a>
            <a href="https://instagram.com/__mmgrand__" target="_blank" class="text-pink-500 hover:text-pink-700">
                <i class="fab fa-instagram text-4xl"></i>
            </a>
        </div>

        <hr class="my-12 border-gray-300">

        <h2 class="text-3xl font-bold text-center mb-4">{{ __('Контактная информация') }}</h2>
        <div class="bg-white shadow-lg rounded-lg p-6 mt-8 text-center">
            <p class="text-gray-700 mb-4">
                {{ __('Вы можете связаться со мной через') }}
                <a href="{{ route('contacts') }}" class="text-blue-500 hover:underline">
                    {{ __('контактную страницу') }}
                </a>.
            </p>
        </div>
    </x-content-wrapper>
@endsection
