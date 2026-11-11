<?php

declare(strict_types=1);

namespace App\MoonShine\Pages;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Project;
use App\Models\Tag;
use App\Models\User;
use MoonShine\Laravel\Pages\Page;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Components\Layout\Column;
use MoonShine\UI\Components\Layout\Grid;
use MoonShine\UI\Components\Metrics\Wrapped\ValueMetric;

class Dashboard extends Page
{
    protected string $title = 'АдминПанель';

    protected function components(): iterable
    {
        return [
            Grid::make([
                Column::make([
                    Box::make([
                        ValueMetric::make('Количество проектов')->value(Project::query()->count())->icon('heroicons.briefcase'),
                    ])
                ])->columnSpan(6),
                Column::make([
                    Box::make([
                        ValueMetric::make('Количество постов')->value(Post::query()->count())->icon('heroicons.book-open'),
                    ])
                ])->columnSpan(6),
                Column::make([
                    Box::make([
                        ValueMetric::make('Количество категорий')->value(Category::query()->count())->icon('heroicons.view-columns'),
                    ])
                ])->columnSpan(6),
                Column::make([
                    Box::make([
                        ValueMetric::make('Количество тэгов')->value(Tag::query()->count())->icon('heroicons.tag'),
                    ])
                ])->columnSpan(6),
                Column::make([
                    Box::make([
                        ValueMetric::make('Количество комментариев')->value(Comment::query()->count())->icon('heroicons.chat-bubble-left-ellipsis'),
                    ])
                ])->columnSpan(6),
                Column::make([
                    Box::make([
                        ValueMetric::make('Количество пользователей')->value(User::query()->count())->icon('heroicons.users'),
                    ])
                ])->columnSpan(6),
            ])
        ];
    }
}
