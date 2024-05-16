<?php

declare(strict_types=1);

namespace App\Providers;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Project;
use App\Models\Tag;
use App\MoonShine\Resources\CategoryResource;
use App\MoonShine\Resources\CommentResource;
use App\MoonShine\Resources\PostResource;
use App\MoonShine\Resources\ProjectResource;
use App\MoonShine\Resources\TagResource;
use MoonShine\Providers\MoonShineApplicationServiceProvider;
use MoonShine\MoonShine;
use MoonShine\Menu\MenuGroup;
use MoonShine\Menu\MenuItem;
use MoonShine\Resources\MoonShineUserResource;
use MoonShine\Resources\MoonShineUserRoleResource;
use MoonShine\Contracts\Resources\ResourceContract;
use MoonShine\Menu\MenuElement;
use MoonShine\Pages\Page;
use Closure;

class MoonShineServiceProvider extends MoonShineApplicationServiceProvider
{
    /**
     * @return list<ResourceContract>
     */
    protected function resources(): array
    {
        return [];
    }

    /**
     * @return list<Page>
     */
    protected function pages(): array
    {
        return [];
    }

    /**
     * @return Closure|list<MenuElement>
     */
    protected function menu(): array
    {
        return [
            MenuGroup::make(static fn() => __('moonshine::ui.resource.system'), [
               MenuItem::make(
                   static fn() => __('moonshine::ui.resource.admins_title'),
                   new MoonShineUserResource()
               ),
               MenuItem::make(
                   static fn() => __('moonshine::ui.resource.role_title'),
                   new MoonShineUserRoleResource()
               ),
            ]),

            MenuGroup::make('Основное', [
                MenuItem::make('Проекты', new ProjectResource())->icon('heroicons.briefcase')->badge(fn() => Project::query()->count()),
                MenuItem::make('Посты', new PostResource())->icon('heroicons.book-open')->badge(fn() => Post::query()->count()),
                MenuItem::make('Категории', new CategoryResource())->icon('heroicons.view-columns')->badge(fn() => Category::query()->count()),
                MenuItem::make('Тэги', new TagResource())->icon('heroicons.tag')->badge(fn() => Tag::query()->count())
            ])->icon('heroicons.folder'),

            MenuGroup::make('Контент', [
                MenuItem::make('Комментарии', new CommentResource())->icon('heroicons.chat-bubble-left-ellipsis')->badge(fn() => Comment::query()->count()),
            ])->icon('heroicons.folder-arrow-down')
        ];
    }

    /**
     * @return Closure|array{css: string, colors: array, darkColors: array}
     */
    protected function theme(): array
    {
        return [];
    }
}
