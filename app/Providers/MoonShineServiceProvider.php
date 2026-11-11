<?php

declare(strict_types=1);

namespace App\Providers;

use App\MoonShine\Resources\CategoryResource;
use App\MoonShine\Resources\CommentResource;
use App\MoonShine\Resources\PostResource;
use App\MoonShine\Resources\ProjectResource;
use App\MoonShine\Resources\TagResource;
use App\MoonShine\Resources\UserResource;
use Illuminate\Support\ServiceProvider;
use MoonShine\Contracts\Core\DependencyInjection\CoreContract;
use MoonShine\Laravel\Resources\MoonShineUserResource;
use MoonShine\Laravel\Resources\MoonShineUserRoleResource;

class MoonShineServiceProvider extends ServiceProvider
{
    public function boot(CoreContract $core): void
    {
        $core
            ->resources([
                UserResource::class,
                MoonShineUserResource::class,
                MoonShineUserRoleResource::class,
                ProjectResource::class,
                PostResource::class,
                CategoryResource::class,
                TagResource::class,
                CommentResource::class,
            ])
            ->pages([
                ...$core->getConfig()->getPages(),
            ]);
    }
}
