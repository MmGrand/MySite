<?php

declare(strict_types=1);

use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use MoonShine\ColorManager\Palettes\PurplePalette;
use MoonShine\Crud\Forms\FiltersForm;
use MoonShine\Crud\Forms\LoginForm;
use MoonShine\Laravel\Exceptions\MoonShineNotFoundException;
use MoonShine\Laravel\Http\Middleware\Authenticate;
use MoonShine\Laravel\Http\Middleware\ChangeLocale;
use MoonShine\Laravel\Models\MoonshineUser;
use MoonShine\Laravel\Pages\ErrorPage;
use MoonShine\Laravel\Pages\LoginPage;
use MoonShine\Laravel\Pages\ProfilePage;

return [
    'title' => env('MOONSHINE_TITLE', 'MoonShine'),
    'logo' => env('MOONSHINE_LOGO', '/vendor/moonshine/logo-small.svg'),
    'logo_small' => env('MOONSHINE_LOGO_SMALL', '/vendor/moonshine/logo-small.svg'),

    'use_migrations' => true,
    'use_notifications' => true,
    'use_database_notifications' => true,
    'use_routes' => true,
    'use_profile' => true,

    'domain' => env('MOONSHINE_URL'),
    'prefix' => env('MOONSHINE_ROUTE_PREFIX', 'admin'),
    'page_prefix' => 'page',
    'resource_prefix' => 'resource',
    'home_route' => 'moonshine.index',

    'not_found_exception' => MoonShineNotFoundException::class,

    'middleware' => [
        ConvertEmptyStringsToNull::class,
        EncryptCookies::class,
        AddQueuedCookiesToResponse::class,
        StartSession::class,
        AuthenticateSession::class,
        ShareErrorsFromSession::class,
        VerifyCsrfToken::class,
        SubstituteBindings::class,
        ChangeLocale::class,
    ],

    'disk' => 'public',
    'disk_options' => [],
    'cache' => 'file',

    'auth' => [
        'enabled' => true,
        'guard' => 'moonshine',
        'model' => MoonshineUser::class,
        'middleware' => [
            Authenticate::class,
        ],
        'pipelines' => [],
    ],

    'user_fields' => [
        'username' => 'email',
        'password' => 'password',
        'name' => 'name',
        'avatar' => 'avatar',
    ],

    'layout' => App\MoonShine\Layouts\AdminLayout::class,
    'palette' => PurplePalette::class,

    'forms' => [
        'login' => LoginForm::class,
        'filters' => FiltersForm::class,
    ],

    'pages' => [
        'dashboard' => App\MoonShine\Pages\Dashboard::class,
        'profile' => ProfilePage::class,
        'login' => LoginPage::class,
        'error' => ErrorPage::class,
    ],

    'locale' => 'en',
    'locale_key' => ChangeLocale::KEY,
    'locales' => [
        'en',
        'ru',
    ],
];
