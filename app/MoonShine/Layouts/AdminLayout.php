<?php

declare(strict_types=1);

namespace App\MoonShine\Layouts;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Project;
use App\Models\Tag;
use App\Models\User;
use App\MoonShine\Resources\CategoryResource;
use App\MoonShine\Resources\CommentResource;
use App\MoonShine\Resources\PostResource;
use App\MoonShine\Resources\ProjectResource;
use App\MoonShine\Resources\TagResource;
use App\MoonShine\Resources\UserResource;
use MoonShine\Laravel\Layouts\AppLayout;
use MoonShine\Laravel\Resources\MoonShineUserResource;
use MoonShine\Laravel\Resources\MoonShineUserRoleResource;
use MoonShine\MenuManager\MenuGroup;
use MoonShine\MenuManager\MenuItem;

class AdminLayout extends AppLayout
{
    protected function menu(): array
    {
        return [
            MenuGroup::make(__('moonshine::ui.resource.system'), [
                MenuItem::make(UserResource::class, 'Пользователи')
                    ->icon('heroicons.users')
                    ->badge(fn () => User::query()->count()),
                MenuItem::make(MoonShineUserResource::class),
                MenuItem::make(MoonShineUserRoleResource::class),
            ]),
            MenuGroup::make('Основное', [
                MenuItem::make(ProjectResource::class, 'Проекты')
                    ->icon('heroicons.briefcase')
                    ->badge(fn () => Project::query()->count()),
                MenuItem::make(PostResource::class, 'Посты')
                    ->icon('heroicons.book-open')
                    ->badge(fn () => Post::query()->count()),
                MenuItem::make(CategoryResource::class, 'Категории')
                    ->icon('heroicons.view-columns')
                    ->badge(fn () => Category::query()->count()),
                MenuItem::make(TagResource::class, 'Тэги')
                    ->icon('heroicons.tag')
                    ->badge(fn () => Tag::query()->count()),
            ])->icon('heroicons.folder'),
            MenuGroup::make('Контент', [
                MenuItem::make(CommentResource::class, 'Комментарии')
                    ->icon('heroicons.chat-bubble-left-ellipsis')
                    ->badge(fn () => Comment::query()->count()),
            ])->icon('heroicons.folder-arrow-down'),
        ];
    }
}
