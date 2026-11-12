@extends('layouts.main')

@section('title')
    Обо мне
@endsection

@section('content')
    <x-breadcrumbs :breadcrumbs="$breadcrumbs" />

    <x-content-wrapper>
        <div class="site-panel relative mx-auto flex max-w-5xl flex-col items-center gap-8 overflow-hidden p-6 text-center md:flex-row md:p-10 md:text-left">
            <div class="site-avatar-ring shrink-0">
            <img class="h-40 w-40 rounded-full object-cover shadow-xl md:h-52 md:w-52"
                src="{{ asset('images/main_avatar.jpg') }}" alt="{{ __('Максим') }}">
            </div>
            <div class="w-full">
                <p class="site-kicker mb-3">{{ __('Знакомство') }}</p>
                <h1 class="title-font mb-4 text-3xl font-bold tracking-tight text-white sm:text-4xl">
                    {{ __('Привет, я Максим 👋') }}</h1>
                <p class="site-muted body-font leading-relaxed">
                    {{ __('Я Fullstack разработчик. Началось всё с того, что в университете я не знал куда мне идти дальше, и я решил разрабатывать сайты. Изучал разные языки программирования, проходил курсы, но пока остановился на PHP и его фреймворке Laravel. Во Frontend направлении выбрал Vue JS. С 2022 года осени работаю, параллельно изучаю разные возможности разработки и прогрессирую с каждым днём.') }}
                </p>
            </div>
        </div>

        <hr class="site-divider my-12">

        <h2 class="mb-4 text-center text-3xl font-bold tracking-tight text-white">{{ __('Мой стек разработки 🛠') }}</h2>
        <div class="site-panel mt-5 flex flex-wrap justify-center gap-8 p-6 md:p-8">
            @foreach ([
                ['icon' => 'fab fa-html5', 'color' => 'text-orange-300', 'name' => 'HTML5'],
                ['icon' => 'fab fa-css3-alt', 'color' => 'text-sky-300', 'name' => 'CSS3'],
                ['icon' => 'fab fa-laravel', 'color' => 'text-red-400', 'name' => 'Laravel'],
                ['icon' => 'fab fa-vuejs', 'color' => 'text-emerald-300', 'name' => 'Vue.js'],
                ['icon' => 'fab fa-docker', 'color' => 'text-blue-300', 'name' => 'Docker'],
                ['icon' => 'fas fa-database', 'color' => 'text-indigo-300', 'name' => 'MySQL'],
                ['icon' => 'fab fa-git-alt', 'color' => 'text-orange-300', 'name' => 'Git']
            ] as $tech)
                <div class="min-w-20 text-center">
                    <i class="{{ $tech['icon'] }} text-4xl {{ $tech['color'] }} transition duration-300 hover:scale-110"></i>
                    <p class="site-muted mt-3 text-sm">{{ $tech['name'] }}</p>
                </div>
            @endforeach
        </div>

        <hr class="site-divider my-12">

        <h2 class="mb-4 text-center text-3xl font-bold tracking-tight text-white">{{ __('Навыки') }}</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center mt-8">
            @foreach ([
                ['title' => 'Frontend', 'description' => 'HTML, CSS, JavaScript, Vue.js', 'color' => 'text-sky-300'],
                ['title' => 'Backend', 'description' => 'PHP, Laravel', 'color' => 'text-emerald-300'],
                ['title' => 'Инструменты', 'description' => 'Docker, Git, MySQL', 'color' => 'text-rose-300']
            ] as $skill)
                <div class="site-card site-card-interactive p-6">
                    <h3 class="mb-2 text-xl font-semibold {{ $skill['color'] }}">{{ __($skill['title']) }}</h3>
                    <p class="site-muted">{{ __($skill['description']) }}</p>
                </div>
            @endforeach
        </div>

        <hr class="site-divider my-12">

        <h2 class="mb-4 text-center text-3xl font-bold tracking-tight text-white">{{ __('Опыт работы') }}</h2>
        <div class="site-panel mt-4 p-6 md:p-8">
            <p class="site-muted mb-4">
                {{ __('Мой опыт работы состоит из того, что я в основном работаю с самописным фреймворком на PHP. Большинство времени взаимодействовал с проектом SPA. На Vue js разрабатывал frontend. Там работал с роутингом, хранилищем, подключением других библиотек для удобства, созданием различных страниц и даже подключением SEO. На Backend работал с rest API, платежными системами, разработкой функционала сайта и другими вещами.') }}
            </p>
            <p class="site-muted mb-2">
                {{ __('Параллельно работе изучаю другие возможности разработки, например, Laravel. В моём github присутствуют проекты, где я учился и создавал различные сайты. Также там есть сайт, сделанный только на Vue js с использованием данных, полученных по API.') }}
            </p>
        </div>

        <hr class="site-divider my-12">

        <h2 class="mb-4 text-center text-3xl font-bold tracking-tight text-white">{{ __('Социальные сети') }}</h2>
        <div class="site-panel mt-4 flex justify-center gap-7 p-6">
            <a href="https://hh.ru/resume/e74029faff086439720039ed1f654645784e38" target="_blank" rel="noopener noreferrer"
                aria-label="HeadHunter" class="text-red-400 hover:text-red-300 transform hover:scale-110 transition-transform duration-300">
                <img src="{{ asset('images/min-hh-red.png') }}" alt="HeadHunter" class="w-9 h-9">
            </a>
            <a href="https://github.com/MmGrand" target="_blank" rel="noopener noreferrer" aria-label="GitHub" class="text-slate-200 hover:text-white transform hover:scale-110 transition-transform duration-300">
                <i class="fab fa-github text-4xl"></i>
            </a>
        </div>

        <hr class="site-divider my-12">

        <h2 class="mb-4 text-center text-3xl font-bold tracking-tight text-white">{{ __('Контактная информация') }}</h2>
        <div class="site-panel mt-8 p-6 text-center">
            <p class="site-muted mb-4">
                {{ __('Вы можете связаться со мной через') }}
                <a href="{{ route('contacts') }}" class="site-link">
                    {{ __('контактную страницу') }}
                </a>.
            </p>
        </div>
    </x-content-wrapper>

@endsection
